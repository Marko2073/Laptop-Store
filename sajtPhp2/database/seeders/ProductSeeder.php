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

            $id=DB::table('prices')->insertGetId([
                'model_specification_id' => $product->id,
                'price' => rand(5, 50),
            ]);
        }

    }
}
