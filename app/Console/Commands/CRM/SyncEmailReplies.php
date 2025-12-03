<?php

namespace App\Console\Commands\CRM;

use Illuminate\Console\Command;
use App\Services\ImapReplySyncService;

class SyncEmailReplies extends Command
{
    protected $signature = 'emails:sync-replies';
    protected $description = 'Sync inbound email replies via IMAP into email threads';

    public function handle(ImapReplySyncService $service): int
    {
        $service->sync();
        return self::SUCCESS;
    }
}
