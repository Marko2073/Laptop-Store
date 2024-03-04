<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class PictureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $faker=Faker::create();
        $products = DB::table('models')
            ->join('brands', 'models.brand_id', '=', 'brands.id')
            ->join('model_specification', 'models.id', '=', 'model_specification.model_id')
            ->select('models.*', 'brands.name as brand_name', 'model_specification.id as model_specification_id')
            ->get();
        foreach ($products as $product) {
            for($i=0; $i<rand(4,5); $i++){
            $id = DB::table('pictures')->insertGetId([
                'path' => $faker->imageUrl(320, 240, $product->brand_name . ' ' . $product->name, false),
                'model_specification_id' => $product->model_specification_id,

            ]);
            }
        }

    }
}
