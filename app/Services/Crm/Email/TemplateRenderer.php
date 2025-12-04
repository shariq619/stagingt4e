<?php

namespace App\Services\Crm\Email;

class TemplateRenderer
{
    public function render($layoutHtml, $layoutText, $subject, $htmlBody, $textBody, array $context)
    {
        $vars = $this->flatten($context);

        $renderedSubject = $this->interpolate($subject, $vars);
        $renderedHtmlBody = $this->interpolate($htmlBody, $vars);
        $renderedTextBody = $this->interpolate($textBody, $vars);

        if ($layoutHtml) {
            $renderedHtmlBody = $this->interpolate($layoutHtml, array_merge($vars, ['content' => $renderedHtmlBody]));
        }
        if ($layoutText) {
            $renderedTextBody = $this->interpolate($layoutText, array_merge($vars, ['content' => $renderedTextBody]));
        }

        return [$renderedSubject, $renderedHtmlBody, $renderedTextBody];
    }

    protected function flatten(array $context, $prefix = '')
    {
        $out = [];
        foreach ($context as $k => $v) {
            $key = $prefix ? $prefix . '.' . $k : $k;
            if (is_array($v)) {
                $out = array_merge($out, $this->flatten($v, $key));
            } else {
                $out[$key] = $v;
            }
        }
        return $out;
    }

    protected function interpolate($template, array $vars)
    {
        if (!$template) return null;

        return preg_replace_callback('/\{\{\s*([a-zA-Z0-9\._]+)\s*\}\}/', function ($matches) use ($vars) {
            $key = $matches[1];
            return isset($vars[$key]) ? $vars[$key] : '';
        }, $template);
    }
}
