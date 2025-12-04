<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use App\Models\FrontOrderDetails;
use App\Models\Newsletter;
use App\Services\Crm\Email\Context\ContextBuilder;
use App\Services\Crm\Email\TemplateRenderer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmailUtilityController extends Controller
{

    public function previewRender(Request $r, Newsletter $newsletter)
    {
        $data = $r->validate([
            'detail_id' => ['nullable', 'integer'],
            'status' => ['nullable', 'string'],
            'extras' => ['nullable', 'array'],
            'context' => ['nullable', 'array'],
        ]);
        $subject = $newsletter->subject;
        $html = $newsletter->html_body;
        $text = $newsletter->text_body;
        $layoutHtml = $newsletter->layout_html;
        $layoutText = $newsletter->layout_text;
        $context = $data['context'] ?? [];
        if (($data['detail_id'] ?? null) && class_exists(FrontOrderDetails::class)) {
            $detail = FrontOrderDetails::find($data['detail_id']);
            if ($detail) {
                $ctx = app(ContextBuilder::class)->build($detail, (string)($data['status'] ?? ''), (array)($data['extras'] ?? []));
                $context = array_merge($ctx, $context);
            }
        }
        [$s, $h, $t] = app(TemplateRenderer::class)->render($layoutHtml, $layoutText, $subject, $html, $text, $context);
        return ['subject' => $s, 'html' => $h, 'text' => $t, 'context_used' => $context];
    }

    public function uploadAsset(Request $r)
    {
        $r->validate(['file' => 'required|file|max:5120']);
        $path = $r->file('file')->store('public/email-assets');
        $url = Storage::url($path);
        return ['name' => basename($path), 'url' => $url, 'size' => $r->file('file')->getSize()];
    }
}
