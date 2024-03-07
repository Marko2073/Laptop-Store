<?php

namespace Database\Seeders;

use App\Models\ModelSpec;
use App\Models\Specification;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products= ModelSpec::all();
        $names= Specification::all()->where('parent_id', null);


        foreach ($products as $product) {

            foreach ($names as $name) {
                $specifications= Specification::all()->where('parent_id', $name->id);
                $spec_id= $specifications->random()->id;
                DB::table('specifications_individually')->insert([
                    'model_specification_id' => $product->id,
                    'specification_id' => $spec_id,

                ]);
            }
            $prices = range(549, 1199, 50);
            $price1 = $prices[array_rand($prices)];

            $priceDifference = range(50, 200,10);
            $price2 = $price1 + array_rand($priceDifference);

            $id=DB::table('prices')->insertGetId([
                'model_specification_id' => $product->id,
                'price' => $price1,
                'date_from' => date('Y-m-d', strtotime('-1 day')),
                'date_to' => date('Y-m-d', strtotime('+1 year')),
                'created_at' => date('Y-m-d H:i:s'),

            ]);
            $i = rand(0,1);
            if($i){
                DB::table('prices')->insert([
                    'model_specification_id' => $product->id,
                    'price' => $price2,
                    'date_from' => date('Y-m-d', strtotime('-2 year')),
                    'date_to' => date('Y-m-d', strtotime('-1 day')),

                ]);

            }
        }

    }
}
