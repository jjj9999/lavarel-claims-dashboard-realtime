<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MetricsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        for ($i = 0; $i < 6; $i++) {
            DB::table('metrics')->insert([
                'leads_acquired' => rand(10, 50),
                'sales_today' => rand(500, 3000),
                'created_at' => now()->subMonths($i)->startOfMonth(),
                'updated_at' => now()->subMonths($i)->startOfMonth(),
            ]);
        }
    }
}
