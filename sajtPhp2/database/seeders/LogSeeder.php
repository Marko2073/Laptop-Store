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
            'update user',
            'add card',
            'update card',
            'contact',
        ];

        foreach ($logTypes as $logType) {
            DB::table('log_type')->insert([
                'name' => $logType,
            ]);
        }

    }
}
