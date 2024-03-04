<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            BrandSeeder::class,
            SpecificationSeeder::class,
            ProductSeeder::class,
            PictureSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            MenuSeeder::class,
            CreditCardSeeder::class,
            LogSeeder::class,

        ]);
    }
}
