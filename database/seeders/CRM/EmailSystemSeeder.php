<?php

namespace Database\Seeders\CRM;

use App\Models\EmailMapping;
use App\Models\EmailProvider;
use App\Models\EmailTemplate;
use App\Models\EmailTemplateTranslation;
use App\Models\EmailTemplateVersion;
use App\Models\EmailTrigger;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class EmailSystemSeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();

        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        if (Schema::hasTable('email_mappings')) {
            DB::table('email_mappings')->truncate();
        }
        if (Schema::hasTable('email_template_translations')) {
            DB::table('email_template_translations')->truncate();
        }
        if (Schema::hasTable('email_template_versions')) {
            DB::table('email_template_versions')->truncate();
        }
        if (Schema::hasTable('email_templates')) {
            DB::table('email_templates')->truncate();
        }
        if (Schema::hasTable('email_triggers')) {
            DB::table('email_triggers')->truncate();
        }
        if (Schema::hasTable('email_providers')) {
            DB::table('email_providers')->truncate();
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $provider = null;
        if (Schema::hasTable('email_providers')) {
            $provider = EmailProvider::create([
                'key'    => 'smtp',
                'name'   => 'SMTP',
                'config' => [],
            ]);
        }

        $learnerStatuses = [
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

        $triggerSeed = [
            ['key' => 'course.reminder.start.3d',   'entity' => 'Course', 'type' => 'time',   'active' => 1],
        ];

        foreach ($learnerStatuses as $statusText) {
            $slug = strtolower(trim(preg_replace('/[^a-z0-9]+/i', '-', $statusText), '-'));
            $triggerSeed[] = [
                'key'    => 'course.status.changed.' . $slug,
                'entity' => 'Course',
                'type'   => 'status',
                'active' => 1,
            ];
        }

        $triggersByKey = [];
        foreach ($triggerSeed as $t) {
            $trigger = EmailTrigger::create([
                'key'    => $t['key'],
                'entity' => $t['entity'],
                'type'   => $t['type'],
                'active' => $t['active'],
            ]);
            $triggersByKey[$trigger->key] = $trigger;
        }

        $logoUrl = url('crm/assets/img/logo.png');

        $layoutHtmlWrapper = <<<HTML
<div style="font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,'Helvetica Neue',Arial,sans-serif;background-color:#ffffff;color:#1f2937;font-size:16px;line-height:1.5;padding:24px;">
    <div style="max-width:600px;margin:0 auto;">
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

        $layoutTextWrapper = <<<TEXT
{{content}}

--
Training4Employment CRM
Automated notification
TEXT;

        $templateSeed = [
            [
                'code'    => 'course.confirmed',
                'category'=> 'transactional',
                'active'  => 1,
                'subject' => 'Your course {{course.name}} is confirmed',
                'html'    => '<h2 style="margin:0 0 12px 0;font-size:18px;font-weight:600;color:#111827;">Hello {{user.name}},</h2><p style="margin:0 0 8px 0;">Your course <strong>{{course.name}}</strong> starting on {{course.cohort_start_date_time}} is now <span style="color:#10b981;font-weight:600;">confirmed</span>.</p><p style="margin:16px 0 0 0;font-size:14px;line-height:1.5;color:#4b5563;">Status: {{course.status}}</p>',
                'text'    => 'Hello {{user.name}}, your course {{course.name}} starting on {{course.cohort_start_date_time}} is confirmed. Status: {{course.status}}.',
            ],
            [
                'code'    => 'course.reminder.3d',
                'category'=> 'transactional',
                'active'  => 1,
                'subject' => 'Reminder: {{course.name}} starts in 3 days',
                'html'    => '<p style="margin:0 0 8px 0;">Hi {{user.name}},</p><p style="margin:0 0 8px 0;">This is a reminder that <strong>{{course.name}}</strong> starts on <strong>{{course.cohort_start_date_time}}</strong>.</p><p style="margin:16px 0 0 0;font-size:14px;line-height:1.5;color:#4b5563;">Please arrive 10 minutes early for registration.</p>',
                'text'    => 'Hi {{user.name}}, {{course.name}} starts on {{course.cohort_start_date_time}}. Please arrive 10 minutes early.',
            ],
            [
                'code'    => 'course.status.generic',
                'category'=> 'transactional',
                'active'  => 1,
                'subject' => 'Course {{course.name}} status: {{course.status}}',
                'html'    => '<p style="margin:0 0 8px 0;">Hi {{user.name}},</p><p style="margin:0 0 8px 0;">The status for <strong>{{course.name}}</strong> changed to <strong>{{course.status}}</strong>.</p><p style="margin:16px 0 0 0;font-size:14px;line-height:1.5;color:#4b5563;">If you have questions, reply to this email.</p>',
                'text'    => 'Hi {{user.name}}, status for {{course.name}} changed to {{course.status}}.',
            ],
        ];

        $templatesByCode = [];
        foreach ($templateSeed as $tplData) {
            $template = EmailTemplate::create([
                'code'     => $tplData['code'],
                'category' => $tplData['category'],
                'active'   => $tplData['active'],
                'is_draft' => 0,
            ]);

            $version = EmailTemplateVersion::create([
                'template_id'  => $template->id,
                'version'      => 1,
                'is_current'   => 1,
                'layout_html'  => $layoutHtmlWrapper,
                'layout_text'  => $layoutTextWrapper,
                'attachments'  => [],
                'meta' => [
                    'cc'               => [],
                    'bcc'              => [],
                    'from_name'        => 'Training4Employment',
                    'from_email'       => 'no-reply@t4e-hub.co.uk',
                    'created_by_name'  => 'System',
                    'created_by_email' => 'no-reply@t4e-hub.co.uk',
                    'data_source'      => 'TrainingCourse',
                    'merge_field'      => null,
                    'newsletter_name'  => $tplData['code'] . ' newsletter',
                ],
            ]);

            EmailTemplateTranslation::create([
                'template_version_id' => $version->id,
                'locale'              => 'en',
                'subject'             => $tplData['subject'],
                'html_body'           => $tplData['html'],
                'text_body'           => $tplData['text'],
            ]);

            $templatesByCode[$template->code] = $template;
        }

        $mapRows = [];

        if (isset($triggersByKey['course.status.changed.confirmed'], $templatesByCode['course.confirmed'])) {
            $mapRows[] = [
                'trigger_id'       => $triggersByKey['course.status.changed.confirmed']->id,
                'template_id'      => $templatesByCode['course.confirmed']->id,
                'scope'            => 'global',
                'course_category'  => null,
                'course_id'        => null,
                'priority'         => 10,
                'enabled'          => 1,
                'recipients'       => [
                    ['role' => 'user'],
                    ['role' => 'admin'],
                ],
            ];
        }

        if (isset($triggersByKey['course.reminder.start.3d'], $templatesByCode['course.reminder.3d'])) {
            $mapRows[] = [
                'trigger_id'       => $triggersByKey['course.reminder.start.3d']->id,
                'template_id'      => $templatesByCode['course.reminder.3d']->id,
                'scope'            => 'global',
                'course_category'  => null,
                'course_id'        => null,
                'priority'         => 20,
                'enabled'          => 1,
                'recipients'       => [
                    ['role' => 'user'],
                ],
            ];
        }

        foreach ($learnerStatuses as $statusText) {
            $slug = strtolower(trim(preg_replace('/[^a-z0-9]+/i', '-', $statusText), '-'));
            $triggerKey = 'course.status.changed.' . $slug;
            if (isset($triggersByKey[$triggerKey]) && isset($templatesByCode['course.status.generic'])) {
                $mapRows[] = [
                    'trigger_id'       => $triggersByKey[$triggerKey]->id,
                    'template_id'      => $templatesByCode['course.status.generic']->id,
                    'scope'            => 'global',
                    'course_category'  => null,
                    'course_id'        => null,
                    'priority'         => 50,
                    'enabled'          => 1,
                    'recipients'       => [
                        ['role' => 'user'],
                    ],
                ];
            }
        }

        foreach ($mapRows as $row) {
            EmailMapping::create([
                'trigger_id'      => $row['trigger_id'],
                'template_id'     => $row['template_id'],
                'scope'           => $row['scope'],
                'course_category' => $row['course_category'],
                'course_id'       => $row['course_id'],
                'priority'        => $row['priority'],
                'enabled'         => $row['enabled'],
                'recipients'      => $row['recipients'],
            ]);
        }
    }
}
