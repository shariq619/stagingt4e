<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('product_invoices', function (Blueprint $t) {
            $t->integer('nominal_code_id')
                ->index()->nullable()
                ->after('order_detail_id');

            $t->integer('project_code_id')
                ->index()->nullable()
                ->after('nominal_code_id');

            $t->integer('source_id')
                ->index()->nullable()
                ->after('project_code_id');

            $t->integer('department_id')
                ->index()->nullable()
                ->after('source_id');
        });
    }

    public function down(): void
    {
        Schema::table('product_invoices', function (Blueprint $t) {
            $t->dropColumn('nominal_code_id');
            $t->dropColumn('project_code_id');
            $t->dropColumn('source_id');
            $t->dropColumn('department_id');
        });
    }
};
