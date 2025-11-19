<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateCohortReassignmentsTableAddInvoiceLineIdAndRenameInvoiceId extends Migration
{
    public function up()
    {
        if (Schema::hasColumn('cohort_reassignments', 'product_invoice_id')) {
            DB::statement('ALTER TABLE cohort_reassignments CHANGE `product_invoice_id` `invoice_id` BIGINT(20) UNSIGNED NULL;');
        }

        if (!Schema::hasColumn('cohort_reassignments', 'invoice_line_id')) {
            DB::statement('ALTER TABLE cohort_reassignments ADD `invoice_line_id` BIGINT(20) UNSIGNED NULL AFTER `invoice_id`;');
        }
    }

    public function down()
    {
        if (Schema::hasColumn('cohort_reassignments', 'invoice_id')) {
            DB::statement('ALTER TABLE cohort_reassignments CHANGE `invoice_id` `product_invoice_id` BIGINT(20) UNSIGNED NULL;');
        }

        if (Schema::hasColumn('cohort_reassignments', 'invoice_line_id')) {
            DB::statement('ALTER TABLE cohort_reassignments DROP COLUMN `invoice_line_id`;');
        }
    }
}
