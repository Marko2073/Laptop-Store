<?php

namespace Database\Seeders;

use Faker\Guesser\Name;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class SpecificationSeeder extends Seeder
{

    public function run(): void
    {
        $specifications =
            [['name'=>'Display' , 'values'=>['15.6 inch', '14 inch', '13.3 inch', '17.3 inch']],
            ['name'=>'Processor' , 'values'=>['Intel Core i7', 'Intel Core i5', 'Intel Core i3', 'AMD Ryzen 7', 'AMD Ryzen 5', 'AMD Ryzen 3']],
            ['name'=>'Memory' , 'values'=>['8GB', '16GB', '32GB', '64GB']],
            ['name'=>'Storage' , 'values'=>['128GB SSD', '256GB SSD', '512GB SSD', '1TB HDD', '2TB HDD']],
            ['name'=>'Graphics' , 'values'=>['NVIDIA GeForce GTX 1650', 'NVIDIA GeForce GTX 1660 Ti', 'NVIDIA GeForce RTX 2060', 'NVIDIA GeForce RTX 2070', 'NVIDIA GeForce RTX 2080']],
            ['name'=>'Operating System' , 'values'=>['Windows 10', 'Windows 10 Pro', 'Linux', 'FreeDOS']],
            ['name'=>'Battery' , 'values'=>['3-cell', '4-cell', '6-cell', '8-cell']],
            ['name'=>'Weight' , 'values'=>['1.5 kg', '1.8 kg', '2 kg', '2.5 kg']],
            ['name'=>'Color' , 'values'=>['Black', 'Silver', 'White', 'Blue', 'Red', 'Green']],
            ['name'=>'Warranty' , 'values'=>['1 year', '2 years', '3 years', '5 years']],
            ['name'=>'New arrivals' , 'values'=>['Yes', 'No']]
            ];

        foreach ($specifications as $s) {
            $id = DB::table('specifications')->insertGetId([
                'name' => $s['name']
            ]);
            foreach ($s['values'] as $v) {
                DB::table('specifications')->insert([
                    'name' => $v,
                    'parent_id' => $id
                ]);

            }
        }







    }
}
