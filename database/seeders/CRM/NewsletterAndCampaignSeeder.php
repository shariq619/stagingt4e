<?php

namespace Database\Seeders\CRM;

use App\Models\Newsletter;
use App\Models\NewsletterCampaign;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class NewsletterAndCampaignSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();
        $now = now();

        if ($this->command && ! $this->command->confirm('Truncate newsletters, campaigns & recipients tables?')) {
            $this->command->info('Skipping.');
            return;
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        if (Schema::hasTable('newsletter_campaign_recipients')) {
            DB::table('newsletter_campaign_recipients')->truncate();
        }
        if (Schema::hasTable('newsletter_campaigns')) {
            DB::table('newsletter_campaigns')->truncate();
        }
        if (Schema::hasTable('newsletters')) {
            DB::table('newsletters')->truncate();
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        if (! $this->command->confirm('Do you want to SEED dummy data also?')) {
            $this->command->info('Tables truncated only.');
            return;
        }

        $newsletterSeed = [
            ['title'=>'Training Reminder','subject'=>'Stay On Track – Your Upcoming Training Session'],
            ['title'=>'Certification Update','subject'=>'Your Course Certificate Is Ready'],
            ['title'=>'Exclusive Offer','subject'=>'Save 20% On Your Next Enrollment'],
            ['title'=>'Important Notice','subject'=>'Exam Schedule & Center Information'],
            ['title'=>'Monthly Digest','subject'=>'Highlights from Training4Employment – ' . $now->format('F')],
        ];

        $createdNewsletters = [];
        foreach ($newsletterSeed as $n) {
            $html = '<h2>'.$n['subject'].'</h2><p>'.$faker->paragraph(4).'</p><p><strong>Thank you,</strong><br>Team T4E</p>';
            $text = $this->htmlToText($html);

            $created = Newsletter::query()->create([
                'title'=>$n['title'],'subject'=>$n['subject'],
                'html_body'=>$html,'text_body'=>$text,
                'layout_html'=>"<div style='font-family:sans-serif;color:#111827;font-size:14px;line-height:1.6'>{{content}}</div>",
                'layout_text'=>"{{content}}",
                'from_name'=>$faker->name(),'from_email'=>'noreply@training4employment.com',
                'created_by_name'=>'Seeder','created_by_email'=>'seeder@training4employment.com',
                'merge_field'=>null,'to_recipients'=>[],'cc_recipients'=>[],'bcc_recipients'=>[],
                'attachments'=>[],'active'=>true,
                'created_at'=>$now,'updated_at'=>$now,
            ]);

            $createdNewsletters[] = $created;
        }

        $sources = [
            'LearnerDelegates'=>User::role('Learner')->whereNotNull('email')->where('email','<>','')->pluck('email'),
            'Customers'=>User::role('Corporate Client')->whereNotNull('email')->where('email','<>','')->pluck('email'),
            'Trainers'=>User::role('trainer')->whereNotNull('email')->where('email','<>','')->pluck('email'),
            'Admins'=>User::role('Super Admin')->whereNotNull('email')->where('email','<>','')->pluck('email'),
        ];

        $groupPool = ['Main Batch','Test Group','Follow-Up','Pilot Set','Re-Engagement','Archived'];
        $senderPool = [
            ['Training Team','training@training4employment.com'],
            ['Support Desk','support@training4employment.com'],
            ['No Reply','noreply@training4employment.com'],
            ['Operations','ops@training4employment.com'],
        ];

        $campaignCount = 0;
        $recipientCount = 0;

        foreach ($sources as $dataSource => $emails) {
            $emails = $emails->map(fn($e)=>strtolower(trim($e)))
                ->filter(fn($e)=>$e!=='' && filter_var($e,FILTER_VALIDATE_EMAIL))
                ->unique()->values();

            if ($emails->isEmpty()) continue;

            foreach ($createdNewsletters as $nl) {
                $groups = collect($groupPool)->shuffle()->take(rand(2,3))->values();

                foreach ($groups as $g) {
                    [$sName,$sEmail] = $senderPool[array_rand($senderPool)];

                    $campaignEmails = $emails->shuffle()->take(min(30,$emails->count()))->values();
                    $count = $campaignEmails->count();

                    $campaign = NewsletterCampaign::query()->create([
                        'newsletter_id'=>$nl->id,'data_source'=>$dataSource,
                        'group_name'=>$g,'sender_name'=>$sName,'sender_email'=>$sEmail,
                        'subject_snapshot'=>$nl->subject,
                        'html_snapshot'=>$nl->html_body,
                        'text_snapshot'=>$this->htmlToText($nl->html_body),
                        'recipients_count'=>$count,
                        'sent_at'=>null,'created_at'=>$now,'updated_at'=>$now,
                    ]);

                    $campaignCount++;

                    if ($count > 0) {
                        $rows = $campaignEmails->map(function($email) use ($campaign,$faker,$now){
                            return [
                                'campaign_id'=>$campaign->id,'name'=>$faker->name(),
                                'email'=>$email,'status'=>'pending',
                                'created_at'=>$now,'updated_at'=>$now,
                            ];
                        })->all();

                        DB::table('newsletter_campaign_recipients')->insert($rows);
                        $recipientCount += $count;
                    }
                }
            }
        }

        $this->command->info('Seeded '.count($createdNewsletters).' newsletters, '.$campaignCount.' campaigns and '.$recipientCount.' recipients.');
    }

    protected function htmlToText(?string $html): ?string
    {
        if (!$html) return $html;

        $text = preg_replace('~<\s*br\s*/?\s*>~i',"\n",$html);
        $text = preg_replace('~<\s*/p\s*>~i',"\n\n",$text);
        $text = preg_replace('~<\s*/h[1-6]\s*>~i',"\n\n",$text);
        $text = preg_replace('~<\s*li\s*>~i',"- ",$text);

        $text = strip_tags($text);
        $text = html_entity_decode($text,ENT_QUOTES|ENT_HTML5,'UTF-8');

        $text = preg_replace("/\r\n|\r|\n/","\n",$text);
        $text = preg_replace("/[ \t]+/",' ',$text);

        $lines = array_filter(array_map('trim',explode("\n",$text)));

        return implode("\n",$lines);
    }
}
