<?php

namespace Database\Seeders\CRM;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\FrontOrder;
use App\Models\FrontOrderDetails;
use App\Models\FrontPayment;
use App\Models\ProductInvoice;
use App\Models\ProductInvoiceLine;
use App\Models\ProductInvoicePayment;
use App\Models\PaymentAuditLog;

class TruncateProductInvoicesSeeder extends Seeder
{
    public function run()
    {
        if (!app()->environment('local')) {
            $this->command->warn('⚠️ Seeder skipped: not running in local environment.');
            return;
        }

        $localIps = ['127.0.0.1', '::1'];
        $currentIp = $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1';
        if (!in_array($currentIp, $localIps)) {
            $this->command->warn("⚠️ Seeder skipped: not running from localhost (IP: {$currentIp}).");
            return;
        }

        if (!$this->command->confirm('❗ Are you sure you want to truncate all related tables? This cannot be undone.', false)) {
            $this->command->info('Seeder cancelled by user.');
            return;
        }

        try {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');

            ProductInvoicePayment::truncate();
            ProductInvoiceLine::truncate();
            ProductInvoice::truncate();
            FrontPayment::truncate();
            FrontOrderDetails::truncate();
            FrontOrder::truncate();
            PaymentAuditLog::truncate();
            DB::table('cohort_user')->truncate();
            DB::table('cohort_reassignments')->truncate();
            DB::table('email_sends')->truncate();
            DB::table('email_send_events')->truncate();
            DB::table('email_idempotency')->truncate();
            DB::table('cohort_miscellounoses')->truncate();
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');

            $this->command->info('✅ Tables truncated successfully!');
        } catch (\Exception $e) {
            $this->command->error('❌ Error truncating tables: ' . $e->getMessage());
        }
    }
}
