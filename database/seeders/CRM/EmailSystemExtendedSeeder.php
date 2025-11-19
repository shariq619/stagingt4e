<?php

namespace Database\Seeders\CRM;

use App\Models\EmailMapping;
use App\Models\EmailTemplate;
use App\Models\EmailTemplateTranslation;
use App\Models\EmailTemplateVersion;
use App\Models\EmailTrigger;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmailSystemExtendedSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $triggerSeed = [
            ['key' => 'learner.birthday',           'entity' => 'Learner',    'type' => 'time',   'active' => 1],
            ['key' => 'license.expiry.90d',         'entity' => 'Enrollment', 'type' => 'time',   'active' => 1],
            ['key' => 'license.expiry.60d',         'entity' => 'Enrollment', 'type' => 'time',   'active' => 1],
            ['key' => 'license.expiry.30d',         'entity' => 'Enrollment', 'type' => 'time',   'active' => 1],
        ];

        $triggersByKey = [];
        foreach ($triggerSeed as $t) {
            $triggersByKey[$t['key']] = EmailTrigger::create($t);
        }

        $layoutHtmlWrapper = <<<HTML
<div style="font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,'Helvetica Neue',Arial,sans-serif;background:#ffffff;color:#1f2937;font-size:16px;line-height:1.5;padding:24px;">
    <div style="max-width:600px;margin:0 auto;">
        <div style="border:1px solid #e5e7eb;border-radius:12px;box-shadow:0 10px 25px rgba(0,0,0,.07);overflow:hidden;">
            <div style="padding:24px;">{{content}}</div>
            <div style="border-top:1px solid #e5e7eb;background:#f9fafb;padding:16px;text-align:center;">
                <div style="font-size:12px;color:#6b7280;font-weight:500;">
                    Training4Employment CRM – Automated notification
                </div>
            </div>
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
                'code'    => 'learner.birthday',
                'category'=> 'transactional',
                'active'  => 1,
                'subject' => 'Happy Birthday, {{user.name}}!',
                'html'    => '<p>Hi {{user.name}},</p><p>All of us at <strong>Training4Employment</strong> wish you a very happy birthday 🎉</p><p>May this year bring success and happiness your way.</p>',
                'text'    => 'Hi {{user.name}}, happy birthday from Training4Employment.',
            ],
            [
                'code'    => 'course.reminder.1d',
                'category'=> 'transactional',
                'active'  => 1,
                'subject' => 'Reminder: {{course.name}} starts tomorrow',
                'html'    => '<p>Hi {{user.name}},</p><p>This is a friendly reminder that your course <strong>{{course.name}}</strong> starts tomorrow ({{course.cohort_start_date_time}}).</p><p>Please check your joining instructions for venue and timing details.</p>',
                'text'    => 'Hi {{user.name}}, your course {{course.name}} starts tomorrow ({{course.cohort_start_date_time}}).',
            ],
            [
                'code'    => 'license.reminder.90d',
                'category'=> 'transactional',
                'active'  => 1,
                'subject' => 'Reminder: Your licence expires in 90 days',
                'html'    => '<p>Hi {{user.name}},</p><p>Your licence for <strong>{{course.name}}</strong> is due to expire on <strong>{{extras.license_expiry_date}}</strong>.</p><p>You have around 90 days remaining to renew or refresh your training.</p>',
                'text'    => 'Hi {{user.name}}, your licence for {{course.name}} expires on {{extras.license_expiry_date}} (90 days remaining).',
            ],
            [
                'code'    => 'license.reminder.60d',
                'category'=> 'transactional',
                'active'  => 1,
                'subject' => 'Reminder: Your licence expires in 60 days',
                'html'    => '<p>Hi {{user.name}},</p><p>Your licence for <strong>{{course.name}}</strong> is due to expire on <strong>{{extras.license_expiry_date}}</strong>.</p><p>Please plan to renew within the next 60 days to stay compliant.</p>',
                'text'    => 'Hi {{user.name}}, your licence for {{course.name}} expires on {{extras.license_expiry_date}} (60 days remaining).',
            ],
            [
                'code'    => 'license.reminder.30d',
                'category'=> 'transactional',
                'active'  => 1,
                'subject' => 'Important: Your licence expires in 30 days',
                'html'    => '<p>Hi {{user.name}},</p><p>Your licence for <strong>{{course.name}}</strong> will expire on <strong>{{extras.license_expiry_date}}</strong>.</p><p>This is your 30-day reminder. Please renew as soon as possible to avoid any interruption.</p>',
                'text'    => 'Hi {{user.name}}, your licence for {{course.name}} expires on {{extras.license_expiry_date}} (30 days remaining).',
            ],
        ];

        $templatesByCode = [];
        foreach ($templateSeed as $tpl) {
            $template = EmailTemplate::create([
                'code'     => $tpl['code'],
                'category' => $tpl['category'],
                'active'   => $tpl['active'],
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
                ],
            ]);

            EmailTemplateTranslation::create([
                'template_version_id' => $version->id,
                'locale'              => 'en',
                'subject'             => $tpl['subject'],
                'html_body'           => $tpl['html'],
                'text_body'           => $tpl['text'],
            ]);

            $templatesByCode[$tpl['code']] = $template;
        }

        $mapRows = [];

        if (isset($triggersByKey['learner.birthday'], $templatesByCode['learner.birthday'])) {
            $mapRows[] = [
                'trigger_id'  => $triggersByKey['learner.birthday']->id,
                'template_id' => $templatesByCode['learner.birthday']->id,
                'scope'       => 'global',
                'priority'    => 10,
                'enabled'     => 1,
                'recipients'  => [['role' => 'user']],
            ];
        }

        if (isset($triggersByKey['course.reminder.start.1d'], $templatesByCode['course.reminder.1d'])) {
            $mapRows[] = [
                'trigger_id'  => $triggersByKey['course.reminder.start.1d']->id,
                'template_id' => $templatesByCode['course.reminder.1d']->id,
                'scope'       => 'global',
                'priority'    => 21,
                'enabled'     => 1,
                'recipients'  => [['role' => 'user']],
            ];
        }

        foreach ([90, 60, 30] as $days) {
            $triggerKey = "license.expiry.{$days}d";
            $tplCode    = "license.reminder.{$days}d";
            if (isset($triggersByKey[$triggerKey], $templatesByCode[$tplCode])) {
                $mapRows[] = [
                    'trigger_id'  => $triggersByKey[$triggerKey]->id,
                    'template_id' => $templatesByCode[$tplCode]->id,
                    'scope'       => 'global',
                    'priority'    => 30 + (90 - $days) / 10,
                    'enabled'     => 1,
                    'recipients'  => [['role' => 'user']],
                ];
            }
        }

        foreach ($mapRows as $row) {
            EmailMapping::create($row);
        }
    }
}
