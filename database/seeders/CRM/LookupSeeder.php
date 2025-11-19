<?php

namespace Database\Seeders\CRM;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LookupSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        /** ---------------------------
         *  NOMINAL CODES
         * --------------------------- */
        DB::table('nominal_codes')->truncate();
        DB::table('nominal_codes')->insert([
            ['code' => '4000', 'description' => 'Sales Revenue', 'created_at' => $now, 'updated_at' => $now],
            ['code' => '4001', 'description' => 'Service Income', 'created_at' => $now, 'updated_at' => $now],
            ['code' => '5000', 'description' => 'Cost of Goods Sold', 'created_at' => $now, 'updated_at' => $now],
            ['code' => '6000', 'description' => 'Administrative Expenses', 'created_at' => $now, 'updated_at' => $now],
            ['code' => '7000', 'description' => 'Marketing Expenses', 'created_at' => $now, 'updated_at' => $now],
        ]);

        /** ---------------------------
         *  PROJECT CODES
         * --------------------------- */
        DB::table('project_codes')->truncate();
        DB::table('project_codes')->insert([
            ['code' => 'PRJ-001', 'description' => 'ERP Implementation', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'PRJ-002', 'description' => 'Website Revamp', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'PRJ-003', 'description' => 'Mobile App Development', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'PRJ-004', 'description' => 'CRM Migration', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'PRJ-005', 'description' => 'Internal Training Program', 'created_at' => $now, 'updated_at' => $now],
        ]);

        /** ---------------------------
         *  SOURCES
         * --------------------------- */
        DB::table('sources')->truncate();
        DB::table('sources')->insert([
            ['code' => 'SRC-001', 'name' => 'Google Ads', 'contact' => 'Marketing Team', 'email' => 'ads@company.com', 'telephone' => '+1-202-555-0111', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'SRC-002', 'name' => 'Referral', 'contact' => 'Customer Referral', 'email' => 'referrals@company.com', 'telephone' => '+1-202-555-0134', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'SRC-003', 'name' => 'LinkedIn Campaign', 'contact' => 'Digital Marketing', 'email' => 'linkedin@company.com', 'telephone' => '+1-202-555-0165', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'SRC-004', 'name' => 'Website Contact Form', 'contact' => 'Sales Team', 'email' => 'sales@company.com', 'telephone' => '+1-202-555-0188', 'created_at' => $now, 'updated_at' => $now],
        ]);

        /** ---------------------------
         *  DEPARTMENTS
         * --------------------------- */
        DB::table('departments')->truncate();
        DB::table('departments')->insert([
            ['code' => 'D001', 'description' => 'Sales Department', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'D002', 'description' => 'Finance Department', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'D003', 'description' => 'Human Resources', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'D004', 'description' => 'Information Technology', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'D005', 'description' => 'Operations', 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}
