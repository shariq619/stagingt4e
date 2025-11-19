<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use App\Models\Newsletter;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function index()
    {
        return view('crm.newsletters.index');
    }

    public function list()
    {
        return Newsletter::query()
            ->select('id', 'title', 'subject', 'updated_at')
            ->orderByDesc('updated_at')
            ->get()
            ->map(function ($n) {
                return [
                    'id' => $n->id,
                    'title' => $n->title,
                    'subject' => $n->subject,
                    'updated_at' => $n->updated_at->toDateTimeString()
                ];
            });
    }

    public function create()
    {
        $n = Newsletter::create([
            'title' => 'Untitled Newsletter',
            'to_recipients' => [],
            'cc_recipients' => [],
            'bcc_recipients' => [],
            'attachments' => [],
        ]);

        return redirect()->route('crm.newsletters.composer', $n->id);
    }

    public function store(Request $r)
    {
        $htmlBody = $r->input('html_body');
        $textBody = $r->input('text_body');
        if ($htmlBody) {
            $textBody = $this->htmlToText($htmlBody);
        }

        $layoutHtml = $r->input('layout_html');
        $layoutText = $r->input('layout_text');

        $n = Newsletter::create([
            'title' => $r->string('title')->toString(),
            'subject' => $r->string('subject')->toString(),
            'html_body' => $htmlBody,
            'text_body' => $textBody,
            'layout_html' => $layoutHtml,
            'layout_text' => !empty($layoutText) ? $layoutText : "{{content}}",
            'from_name' => $r->string('from_name')->toString(),
            'from_email' => $r->string('from_email')->toString(),
            'created_by_name' => $r->string('created_by_name')->toString(),
            'created_by_email' => $r->string('created_by_email')->toString(),
            'merge_field' => $r->string('merge_field')->toString(),
            'to_recipients' => $r->input('to_recipients', []),
            'cc_recipients' => $r->input('cc_recipients', []),
            'bcc_recipients' => $r->input('bcc_recipients', []),
            'attachments' => $r->input('attachments', []),
            'active' => (bool)$r->input('active', true),
        ]);

        return response()->json(['id' => $n->id]);
    }

    public function update(Request $r, Newsletter $newsletter)
    {
        $htmlBody = $r->input('html_body', $newsletter->html_body);
        $textBody = $r->input('text_body', $newsletter->text_body);
        if ($htmlBody) {
            $textBody = $this->htmlToText($htmlBody);
        }

        $layoutHtml = $r->input('layout_html', $newsletter->layout_html);

        $newsletter->update([
            'title' => $r->input('newsletter_name', $r->input('title', $newsletter->title)),
            'subject' => $r->input('subject', $newsletter->subject),
            'html_body' => $htmlBody,
            'text_body' => $textBody,
            'layout_html' => $layoutHtml,
            'layout_text' => !empty($layoutText) ? $layoutText : "{{content}}",
            'from_name' => $r->input('from_name', $newsletter->from_name),
            'from_email' => $r->input('from_email', $newsletter->from_email),
            'created_by_name' => $r->input('created_by_name', $newsletter->created_by_name),
            'created_by_email' => $r->input('created_by_email', $newsletter->created_by_email),
            'merge_field' => $r->input('merge_field', $newsletter->merge_field),
            'to_recipients' => $r->input('to_recipients', $r->input('to', $newsletter->to_recipients)),
            'cc_recipients' => $r->input('cc_recipients', $r->input('cc', $newsletter->cc_recipients)),
            'bcc_recipients' => $r->input('bcc_recipients', $r->input('bcc', $newsletter->bcc_recipients)),
            'attachments' => $r->input('attachments', $newsletter->attachments),
            'active' => filter_var($r->input('active', $newsletter->active), FILTER_VALIDATE_BOOLEAN),
        ]);

        return response()->json(['ok' => true]);
    }

    public function destroy(Newsletter $newsletter)
    {
        $newsletter->delete();
        return response()->json(['ok' => true]);
    }

    public function composer(Newsletter $newsletter)
    {
        return view('crm.newsletters.composer', ['nlId' => $newsletter->id]);
    }

    public function show(Newsletter $newsletter)
    {
        return [
            'id' => $newsletter->id,
            'newsletter_name' => $newsletter->title,
            'subject' => $newsletter->subject,
            'from_name' => $newsletter->from_name,
            'from_email' => $newsletter->from_email,
            'created_by_name' => $newsletter->created_by_name,
            'created_by_email' => $newsletter->created_by_email,
            'mail_merge_field' => $newsletter->merge_field,
            'to' => $newsletter->to_recipients ?: [],
            'cc' => $newsletter->cc_recipients ?: [],
            'bcc' => $newsletter->bcc_recipients ?: [],
            'attachments' => array_values($newsletter->attachments ?: []),
            'html_body' => $newsletter->html_body,
            'text_body' => $newsletter->text_body,
            'layout_html' => $newsletter->layout_html,
            'layout_text' => $newsletter->layout_text,
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
        $lines = array_filter($lines, fn($line) => $line !== '');

        return implode("\n", $lines);
    }
}
