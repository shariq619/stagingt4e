<?php

namespace App\Services;


use App\Models\EmailLog;
use App\Mail\DynamicEmail;
use App\Models\EmailMapping;
use App\Models\EmailTrigger;
use App\Models\EmailTemplate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class EmailSendingService
{
    /**
     * Fire email based on event type and params.
     * @param string $eventType (status|reminder|trainer_assigned)
     * @param array $params (should include user, course, status, etc as needed)
     */
    public function fire($eventType, $params)
    {
        $trigger = EmailTrigger::where('type', $eventType);
        if ($eventType === 'status' && isset($params['status'])) {
            $trigger->where('status', $params['status']);
        } elseif ($eventType === 'reminder' && isset($params['reminder_type'])) {
            $trigger->where('reminder_type', $params['reminder_type']);
        } elseif ($eventType === 'trainer_assigned') {
            $trigger->where('trainer_assigned', true);
        }
        $triggers = $trigger->get();
        if ($triggers->isEmpty()) {
            return 'No trigger found.';
        }

        $results = [];
        foreach ($triggers as $trigger) {
            $template = EmailTemplate::with('attachments')->find($trigger->email_template_id);
            if (!$template) {
                $results[] = 'No template found for trigger ID ' . $trigger->id;
                continue;
            }

            // 1. Extract variables from template body and subject
            $allVars = [];
            preg_match_all('/\{(\w+)\}/', $template->body . $template->subject, $matches);
            if (!empty($matches[1])) {
                $allVars = array_unique($matches[1]);
            }
            $allVarsBraced = array_map(function ($v) {
                return '{' . $v . '}';
            }, $allVars);
            $mappings = EmailMapping::whereIn('template_code', $allVarsBraced)->get()->keyBy('template_code');

            $replacements = [];
            foreach ($allVarsBraced as $var) {
                $column = isset($mappings[$var]) ? $mappings[$var]->column_name : null;
                $db = DB::table($mappings[$var]->table_name)->where('id', $params['mailable_id'])->first();
                $replacements[$var] = $column ? $db->$column : '';
            }
            $body = strtr($template->body, $replacements);
            $subject = strtr($template->subject, $replacements);
            try {
                $attachments = $template->attachments;
                if ($attachments instanceof \Illuminate\Support\Collection) {
                    $attachments = $attachments->all();
                } elseif (!is_array($attachments)) {
                    $attachments = $attachments ? [$attachments] : [];
                }
                $flatAttachments = [];
                foreach ($attachments as $att) {
                    if (is_array($att) && isset($att[0]) && (is_array($att[0]) || is_object($att[0]))) {
                        foreach ($att as $subAtt) {
                            $flatAttachments[] = $subAtt;
                        }
                    } else {
                        $flatAttachments[] = $att;
                    }
                }
                Mail::to($params['email'])->send(new DynamicEmail(
                    $body,
                    $subject,
                    $template->from_email,
                    $flatAttachments
                ));
            } catch (\Exception $e) {
                // $results[] = $e;
                $results[] = 'Failed to send: ' . $e->getMessage();
                continue;
            }

            EmailLog::create([
                'to' => $params['email'],
                'subject' => $subject,
                'body' => $body,
                'template_id' => $template->id,
                'trigger_id' => $trigger->id,
                'mailable_type' => $params['mailable_type'] ?? null,
                'mailable_id' => $params['mailable_id'] ?? null,
                'sent_at' => now(),
            ]);

            $results[] = "Email sent to {$params['email']} (trigger ID {$trigger->id})";
        }
        return $results;
    }
}
