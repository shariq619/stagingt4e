<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use App\Services\Email\Context\TemplateVariableRegistry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\EmailTrigger;
use App\Models\EmailTemplate;
use App\Models\EmailTemplateVersion;
use App\Models\EmailTemplateTranslation;
use App\Models\EmailMapping;
use App\Http\Requests\Crm\Email\StoreTriggerRequest;
use App\Http\Requests\Crm\Email\StoreTemplateRequest;
use App\Http\Requests\Crm\Email\StoreDraftTemplateRequest;
use App\Http\Requests\Crm\Email\UpdateTemplateRequest;
use App\Http\Requests\Crm\Email\StoreMappingRequest;
use App\Http\Requests\Crm\Email\UploadAssetRequest;
use Illuminate\Support\Str;

class EmailAdminController extends Controller
{
    public function index()
    {
        return view('crm.email.index');
    }

    public function triggers()
    {
        $triggers = EmailTrigger::orderBy('created_at', 'desc')->get();
        return response()->json($triggers);
    }

    public function storeTrigger(StoreTriggerRequest $request)
    {
        $payload = $request->getPayload();
        $trigger = EmailTrigger::create($payload);
        return response()->json($trigger, 201);
    }

    public function destroyTrigger($id)
    {
        EmailTrigger::whereKey($id)->delete();
        return response()->json(['ok' => true]);
    }

    public function templates(Request $request)
    {
        $onlyDraft = $request->boolean('draft');

        $q = EmailTemplate::with(['currentVersion.translations'])
            ->orderBy('created_at', 'desc');

        if ($onlyDraft) {
            $q->where('is_draft', 1);
        }

        $templates = $q->get()->map(function ($tpl) {
            $current = $tpl->currentVersion;
            return [
                'id' => $tpl->id,
                'code' => $tpl->code,
                'category' => $tpl->category,
                'active' => (bool)$tpl->active,
                'is_draft' => (bool)$tpl->is_draft,
                'current_version' => $current ? [
                    'id' => $current->id,
                    'version' => $current->version,
                    'is_current' => (bool)$current->is_current,
                    'attachments' => $current->attachments ?: [],
                    'translations' => $current->translations->map(function ($tr) {
                        return [
                            'locale' => $tr->locale,
                            'subject' => $tr->subject,
                        ];
                    })->values(),
                ] : null,
            ];
        });

        return response()->json($templates);
    }

    public function storeTemplate(StoreTemplateRequest $request)
    {
        $payload  = $request->getPayload();
        $logoUrl  = url('crm/assets/img/logo.png');

        $defaultLayoutHtml = <<<HTML
<div style="font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,'Helvetica Neue',Arial,sans-serif;background-color:#ffffff;color:#1f2937;font-size:16px;line-height:1.5;padding:24px;">
    <div style="max-width:1200px;margin:0 auto;">
        <div style="background:#ffffff;border:1px solid #e5e7eb;border-radius:12px;box-shadow:0 20px 40px rgba(0,0,0,.07);overflow:hidden;">
            <div style="padding:24px;">
                {{content}}
            </div>
            <div style="border-top:1px solid #e5e7eb;background:#f9fafb;padding:16px;text-align:center;">
                <div style="font-size:12px;line-height:1.4;color:#6b7280;font-weight:500;">
                    <div>Training4Employment CRM</div>
                    <div>Automated notification</div>
                </div>
                <div style="margin-top:12px;">
                    <img src="{$logoUrl}"
                         alt="Training4Employment"
                         style="height:32px;opacity:0.8;"/>
                </div>
            </div>
        </div>
        <div style="text-align:center;font-size:11px;line-height:1.4;color:#9ca3af;margin-top:16px;">
            You are receiving this email because you interacted with Training4Employment services.
        </div>
    </div>
</div>
HTML;

        $defaultLayoutText = <<<TEXT
{{content}}

--
Training4Employment CRM
Automated notification
TEXT;

        return DB::transaction(function () use ($payload, $defaultLayoutHtml, $defaultLayoutText) {
            $templateData = $payload['template'];
            $templateData['created_by_id'] = Auth::id();

            $template = EmailTemplate::create($templateData);

            $versionMeta = $payload['version']['meta'] ?? [];
            if (!is_array($versionMeta)) {
                $versionMeta = [];
            }

            $user = Auth::user();
            $versionMeta['created_by_name']  = $user ? ($user->name ?: 'System') : ($versionMeta['created_by_name'] ?? 'System');
            $versionMeta['created_by_email'] = $user ? ($user->email ?: null) : ($versionMeta['created_by_email'] ?? null);

            $version = EmailTemplateVersion::create([
                'template_id' => $template->id,
                'version'     => $payload['version']['version'],
                'is_current'  => $payload['version']['is_current'],
                'layout_html' => $defaultLayoutHtml,
                'layout_text' => $defaultLayoutText,
                'meta'        => $versionMeta,
                'attachments' => $payload['version']['attachments'],
            ]);

            $trHtml = $payload['translation']['html_body'] ?? '';
            $trText = $payload['translation']['text_body'] ?? null;
            if ($trHtml !== '') {
                $trText = $this->htmlToText($trHtml);
            }

            EmailTemplateTranslation::create([
                'template_version_id' => $version->id,
                'locale'              => $payload['translation']['locale'],
                'subject'             => $payload['translation']['subject'],
                'html_body'           => $trHtml,
                'text_body'           => $trText,
            ]);

            return response()->json(
                $template->load('currentVersion.translations'),
                201
            );
        });
    }

    public function storeDraft(StoreDraftTemplateRequest $request)
    {
        $payload = $request->getPayload();

        return DB::transaction(function () use ($payload) {
            $templateData = $payload['template'];
            $templateData['created_by_id'] = Auth::id();

            $template = EmailTemplate::create($templateData);

            $layoutHtml = $payload['version']['layout_html'] ?? null;
            $layoutText = $payload['version']['layout_text'] ?? null;
            if ($layoutHtml) {
                $layoutText = $this->htmlToText($layoutHtml);
            }

            $version = EmailTemplateVersion::create([
                'template_id' => $template->id,
                'version' => $payload['version']['version'],
                'is_current' => $payload['version']['is_current'],
                'layout_html' => $layoutHtml,
                'layout_text' => $layoutText,
                'meta' => $payload['version']['meta'],
                'attachments' => $payload['version']['attachments'],
            ]);

            $trHtml = $payload['translation']['html_body'] ?? '';
            $trText = $payload['translation']['text_body'] ?? null;
            if ($trHtml !== '') {
                $trText = $this->htmlToText($trHtml);
            }

            EmailTemplateTranslation::create([
                'template_version_id' => $version->id,
                'locale' => $payload['translation']['locale'],
                'subject' => $payload['translation']['subject'],
                'html_body' => $trHtml,
                'text_body' => $trText,
            ]);

            return response()->json(
                $template->load('currentVersion.translations'),
                201
            );
        });
    }

    public function updateTemplate($id, UpdateTemplateRequest $request)
    {
        $template = EmailTemplate::findOrFail($id);
        $data     = $request->validated();

        $activeBool = array_key_exists('active', $data)
            ? filter_var($data['active'], FILTER_VALIDATE_BOOLEAN)
            : null;

        $draftBool = array_key_exists('is_draft', $data)
            ? filter_var($data['is_draft'], FILTER_VALIDATE_BOOLEAN)
            : null;

        $tplUpdates = array_filter([
            'category' => $data['category'] ?? null,
            'active'   => $activeBool,
            'is_draft' => $draftBool,
        ], static function ($v) {
            return !is_null($v);
        });

        $meta = [
            'to'               => $data['to_recipients'] ?? [],
            'cc'               => $data['cc_recipients'] ?? [],
            'bcc'              => $data['bcc_recipients'] ?? [],
            'from_name'        => $data['from_name'] ?? '',
            'from_email'       => $data['from_email'] ?? '',
            'created_by_name'  => Auth::user()->name ?? 'System',
            'created_by_email' => Auth::user()->email ?? 'no-reply@t4e-hub.co.uk',
            'data_source'      => $data['data_source'] ?? '',
            'merge_field'      => $data['merge_field'] ?? '',
            'newsletter_name'  => $data['newsletter_name'] ?? '',
        ];

        $current = $template->currentVersion;

        $normalizedAttachments = collect($data['attachments'] ?? [])
            ->map(function (array $att) {
                $nameOriginal = trim($att['original_name'] ?? $att['name'] ?? $att['nameStored'] ?? '');
                $url          = $att['url'] ?? '';
                if ($nameOriginal === '' || $url === '') {
                    return null;
                }
                $size       = isset($att['size']) ? (string) $att['size'] : '';
                $nameStored = $att['nameStored'] ?? $att['name'] ?? null;
                if (!$nameStored) {
                    $ext       = pathinfo($nameOriginal, PATHINFO_EXTENSION);
                    $base      = pathinfo($nameOriginal, PATHINFO_FILENAME);
                    $slugBase  = Str::slug($base) ?: 'attachment';
                    $nameStored = $slugBase . ($ext ? ('.' . $ext) : '');
                }
                return [
                    'url'          => $url,
                    'size'         => $size,
                    'nameStored'   => $nameStored,
                    'nameOriginal' => $nameOriginal,
                ];
            })
            ->filter()
            ->values()
            ->all();

        return DB::transaction(function () use ($template, $tplUpdates, $data, $meta, $current, $normalizedAttachments) {

            if (!empty($tplUpdates)) {
                $template->update($tplUpdates);
            }

            if (!$current) {
                $layoutHtmlNew = $data['layout_html'] ?? null;
                $layoutTextNew = $data['layout_text'] ?? null;
                if ($layoutHtmlNew) {
                    $layoutTextNew = $this->htmlToText($layoutHtmlNew);
                }
                $current = EmailTemplateVersion::create([
                    'template_id'  => $template->id,
                    'version'      => 1,
                    'is_current'   => 1,
                    'layout_html'  => $layoutHtmlNew,
                    'layout_text'  => $layoutTextNew,
                    'attachments'  => $normalizedAttachments,
                    'meta'         => $meta,
                ]);
            } else {
                $verUpdates = [];

                if (array_key_exists('layout_html', $data)) {
                    $verUpdates['layout_html'] = $data['layout_html'];
                }

                if (array_key_exists('layout_text', $data)) {
                    $verUpdates['layout_text'] = $data['layout_text'];
                } elseif (array_key_exists('layout_html', $data) && !empty($data['layout_html'])) {
                    $verUpdates['layout_text'] = $this->htmlToText($data['layout_html']);
                }

                if (array_key_exists('attachments', $data)) {
                    $verUpdates['attachments'] = $normalizedAttachments;
                }

                $verUpdates['meta'] = $meta;

                if (!empty($verUpdates)) {
                    $current->update($verUpdates);
                }
            }

            $htmlBody = $data['html_body'] ?? '';
            $textBody = $data['text_body'] ?? null;

            if ($htmlBody !== '') {
                $textBody = $this->htmlToText($htmlBody);
            }

            EmailTemplateTranslation::updateOrCreate(
                [
                    'template_version_id' => $current->id,
                    'locale'              => $data['locale'] ?? 'en',
                ],
                [
                    'subject'   => $data['subject'] ?? '',
                    'html_body' => $htmlBody,
                    'text_body' => $textBody,
                ]
            );

            return response()->json(
                $template->load('currentVersion.translations')
            );
        });
    }


    public function publishDraft($id)
    {
        $template = EmailTemplate::findOrFail($id);

        $template->update([
            'is_draft' => false,
            'active' => true,
        ]);

        return response()->json([
            'ok' => true,
            'template' => $template->fresh()->load('currentVersion.translations')
        ]);
    }

    public function destroyTemplate($id)
    {
        $template = EmailTemplate::findOrFail($id);

        return DB::transaction(function () use ($template) {
            $versions = $template->versions()->get();
            foreach ($versions as $v) {
                $v->translations()->delete();
            }
            $template->versions()->delete();
            $template->delete();

            return response()->json(['ok' => true]);
        });
    }

    public function showTemplate($templateId)
    {
        $tpl = EmailTemplate::with(['currentVersion.translations'])->findOrFail($templateId);

        $currentVersion = $tpl->currentVersion;
        $translation = null;

        if ($currentVersion) {
            $translation = $currentVersion->translations
                ->firstWhere('locale', 'en')
                ?? $currentVersion->translations->first();
        }

        $subject = $translation ? ($translation->subject ?? '') : '';
        $html_body = $translation ? ($translation->html_body ?? '') : '';
        $text_body = $translation ? ($translation->text_body ?? '') : '';
        $attachments = $currentVersion && $currentVersion->attachments ? $currentVersion->attachments : [];
        $layout_html = $currentVersion ? ($currentVersion->layout_html ?? '') : '';
        $layout_text = $currentVersion ? ($currentVersion->layout_text ?? '') : '';

        $meta = $currentVersion && is_array($currentVersion->meta) ? $currentVersion->meta : [];

        $to = isset($meta['to']) && is_array($meta['to']) ? $meta['to'] : [];
        $cc = isset($meta['cc']) && is_array($meta['cc']) ? $meta['cc'] : [];
        $bcc = isset($meta['bcc']) && is_array($meta['bcc']) ? $meta['bcc'] : [];

        return response()->json([
            'id' => $tpl->id,
            'code' => $tpl->code,
            'category' => $tpl->category,
            'active' => (bool)$tpl->active,
            'is_draft' => (bool)$tpl->is_draft,
            'subject' => $subject,
            'html_body' => $html_body,
            'text_body' => $text_body,
            'layout_html' => $layout_html,
            'layout_text' => $layout_text,
            'from_name' => $meta['from_name'] ?? 'Training 4 Employment',
            'from_email' => $meta['from_email'] ?? 'bookings@training4employment.co.uk',
            'created_by_name' => Auth::user()->name ?? 'System',
            'created_by_email' => Auth::user()->email ?? 'no-reply@t4e-hub.co.uk',
            'attachments' => $attachments,
            'to' => $to,
            'cc' => $cc,
            'bcc' => $bcc,
        ]);
    }

    public function composer($templateId)
    {
        $tpl = EmailTemplate::with(['currentVersion.translations'])->findOrFail($templateId);

        return view('crm.email.composer', [
            'templateId' => $tpl->id
        ]);
    }

    public function sendTest($templateId)
    {
        return response()->json([
            'ok' => true,
            'message' => 'Test send queued'
        ]);
    }

    public function uploadAsset(UploadAssetRequest $request)
    {
        $file         = $request->file('file');
        $originalName = $file->getClientOriginalName();
        $mime         = $file->getClientMimeType();
        $bytes        = $file->getSize();

        $path = $file->store('email-assets', ['disk' => 'public']);
        $url  = Storage::disk('public')->url($path);

        $kb = $bytes > 0 ? round($bytes / 1024) . ' KB' : $bytes . ' bytes';

        return response()->json([
            'name'          => basename($path),
            'original_name' => $originalName,
            'url'           => $url,
            'path'          => $path,
            'size'          => $kb,
            'mime'          => $mime,
            'disk'          => 'public',
        ], 201);
    }


    public function mappings()
    {
        $mappings = EmailMapping::with(['trigger', 'template', 'conditions'])
            ->orderBy('priority')
            ->get();

        return response()->json($mappings);
    }

    public function storeMapping(StoreMappingRequest $request)
    {
        $payload = $request->getPayload();

        $mapping = EmailMapping::create([
            'trigger_id' => $payload['trigger_id'],
            'template_id' => $payload['template_id'],
            'scope' => $payload['scope'],
            'course_category' => $payload['course_category'],
            'course_id' => $payload['course_id'],
            'recipients' => $payload['recipients'],
            'enabled' => (bool)$payload['enabled'],
            'priority' => $payload['priority'],
        ]);

        if (!empty($payload['learner_status'])) {
            $mapping->conditions()->create([
                'key' => 'enrollment.status',
                'operator' => 'eq',
                'value' => $payload['learner_status'],
            ]);
        }

        return response()->json(
            $mapping->load(['trigger', 'template', 'conditions']),
            201
        );
    }

    public function destroyMapping($id)
    {
        EmailMapping::whereKey($id)->delete();
        return response()->json(['ok' => true]);
    }

    public function learnerStatuses()
    {
        return response()->json($this->getLearnerStatuses());
    }

    public function triggerKeyOptions(Request $request)
    {
        $statuses = $this->getLearnerStatuses();

        $statusKeys = array_map(function ($s) {
            $slug = strtolower(trim(preg_replace('/[^a-z0-9]+/i', '-', $s), '-'));
            return [
                'id'    => 'course.status.changed.' . $slug,
                'text'  => 'course.status.changed.' . $slug . ' (' . $s . ')',
                'group' => 'Course Status',
            ];
        }, $statuses);

        $timeKeys = [
            ['id' => 'course.reminder.start.3d',   'text' => 'course.reminder.start.3d',   'group' => 'Time-based'],
            ['id' => 'course.reminder.start.1d',   'text' => 'course.reminder.start.1d',   'group' => 'Time-based'],
            ['id' => 'learner.birthday',           'text' => 'learner.birthday',           'group' => 'Time-based'],
            ['id' => 'license.expiry.90d',         'text' => 'license.expiry.90d',         'group' => 'Time-based'],
            ['id' => 'license.expiry.60d',         'text' => 'license.expiry.60d',         'group' => 'Time-based'],
            ['id' => 'license.expiry.30d',         'text' => 'license.expiry.30d',         'group' => 'Time-based'],
        ];

        $all = array_merge($statusKeys, $timeKeys);

        $q = trim((string)$request->get('q', ''));
        if ($q !== '') {
            $qq = strtolower($q);
            $all = array_values(array_filter($all, function ($row) use ($qq) {
                return strpos(strtolower($row['id']), $qq) !== false
                    || strpos(strtolower($row['text']), $qq) !== false;
            }));
        }

        $grouped = [];
        foreach ($all as $row) {
            $g = $row['group'];
            if (!isset($grouped[$g])) {
                $grouped[$g] = [
                    'text'     => $g,
                    'children' => [],
                ];
            }
            $grouped[$g]['children'][] = [
                'id'   => $row['id'],
                'text' => $row['text'],
            ];
        }

        return response()->json(array_values($grouped));
    }

    public function templateVariables(Request $request)
    {
        $registry = app(TemplateVariableRegistry::class);
        $q = strtolower(trim($request->get('q', '')));
        $groups = $registry->placeholdersForUI();

        if ($q === '') {
            return response()->json($groups);
        }

        $out = [];
        foreach ($groups as $g) {
            $label = (string)($g['text'] ?? '');
            $children = is_array($g['children'] ?? null) ? $g['children'] : [];

            if (stripos($label, $q) !== false) {
                $out[] = [
                    'text' => $label,
                    'children' => $children,
                ];
                continue;
            }

            $matchedKids = [];
            foreach ($children as $c) {
                $t = (string)($c['text'] ?? $c['id'] ?? '');
                if (stripos($t, $q) !== false) {
                    $matchedKids[] = [
                        'id' => (string)($c['id'] ?? ''),
                        'text' => (string)($c['text'] ?? $c['id'] ?? ''),
                    ];
                }
            }

            if (!empty($matchedKids)) {
                $out[] = [
                    'text' => $label,
                    'children' => $matchedKids,
                ];
            }
        }

        return response()->json($out);
    }

    protected function getLearnerStatuses()
    {
        return [
            'Cancelled',
            'Confirmed',
            'Drop-Out',
            'Failed',
            'HSA Resit',
            'No Show',
            'Non-Attendance',
            'Passed',
            'Provisional',
            'Transferred',
        ];
    }

    protected function htmlToText(?string $html): ?string
    {
        if ($html === null || $html === '') {
            return $html;
        }

        $text = preg_replace('~<\s*br\s*/?\s*>~i', "\n", $html);
        $text = preg_replace('~<\s*/p\s*>~i', "\n\n", $text);
        $text = preg_replace('~<\s*/h[1-6]\s*>~i', "\n\n", $text);
        $text = preg_replace('~<\s*li\s*>~i', "- ", $text);

        $text = strip_tags($text);
        $text = html_entity_decode($text, ENT_QUOTES | ENT_HTML5, 'UTF-8');

        $text = preg_replace("/\r\n|\r|\n/", "\n", $text);
        $text = preg_replace("/[ \t]+/", ' ', $text);

        $lines = array_map('trim', explode("\n", $text));
        $lines = array_filter($lines, fn ($line) => $line !== '');

        return implode("\n", $lines);
    }
}
