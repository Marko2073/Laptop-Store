<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreditCardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $usercard = [
            [
                'card_number' => '1234-5678-9101-3333',
                'expiration_date' => '12/24',
                'cvv' => '123',
                'card_name' => 'Visa',
                'user_id' => 1,
            ],
            [
                'card_number' => '1234-5678-9101-5555',
                'expiration_date' => '12/24',
                'cvv' => '123',
                'card_name' => 'MasterCard',
                'user_id' => 2,
            ],
            [
                'card_number' => '1234-5678-9101-7777',
                'expiration_date' => '12/24',
                'cvv' => '123',
                'card_name' => 'American Express',
                'user_id' => 2,
            ],
        ];
        \App\Models\Credit_card::insert($usercard);
    }
}
