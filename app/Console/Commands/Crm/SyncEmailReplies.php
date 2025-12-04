<?php

namespace App\Console\Commands\Crm;

use App\Services\Crm\ImapReplySyncService;
use Illuminate\Console\Command;

class SyncEmailReplies extends Command
{
    protected $signature = 'emails:sync-replies';
    protected $description = 'Sync inbound email replies via IMAP into email threads';

    public function handle(ImapReplySyncService $service): int
    {
        $service->syncAll();
        return self::SUCCESS;
    }
}
