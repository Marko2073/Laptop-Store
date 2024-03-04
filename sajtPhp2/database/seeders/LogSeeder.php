<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $logTypes = [
            'login',
            'register',
            'logout',
            'order',
        ];

        foreach ($logTypes as $logType) {
            DB::table('log_type')->insert([
                'name' => $logType,
            ]);
        }

    }
}
