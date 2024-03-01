<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $laptops = [
            ['brand'=>'Acer',
                'model'=> [
                    'Aspire',
                    'Predator',
                    'Swift']
            ],
            ['brand'=>'Apple', 'model'=> ['Macbook Air', 'Macbook Pro']],
            ['brand'=>'Asus', 'model'=> ['Zenbook', 'VivoBook', 'ROG']],
            ['brand'=>'Dell', 'model'=> ['Inspiron', 'XPS', 'Alienware']],
            ['brand'=>'HP', 'model'=> ['Pavilion', 'Envy', 'Spectre']],
            ['brand'=>'Lenovo', 'model'=> ['IdeaPad', 'ThinkPad', 'Legion']],
            ['brand'=>'Microsoft', 'model'=> ['Surface Laptop', 'Surface Book']],
            ['brand'=>'MSI', 'model'=> ['GS', 'GE', 'GP']],
            ['brand'=>'Razer', 'model'=> ['Blade', 'Blade Stealth']],
            ['brand'=>'Samsung', 'model'=> ['Notebook', 'Galaxy Book']],
            ['brand'=>'Toshiba', 'model'=> ['Satellite', 'Portege']],
        ];
        foreach ($laptops as $l) {
            $id=DB::table('brands')->insertGetId([
                'name' => $l['brand']
            ]);
            foreach ( $l['model'] as $m) {
                $model_id=DB::table('models')->insertGetId([
                    'name' => $m,
                    'brand_id' => $id
                ]);
                for ($j = 0; $j < rand(1,2); $j++) {
                    DB::table('model_specification')->insert([
                        'model_id' => $model_id,
                        'stockQuantity' => rand(1, 100),

                    ]);
                }
            }



        }
    }
}
