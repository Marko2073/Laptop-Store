<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $menus = [
            ['name' => 'Home', 'route' => '/'],
            ['name' => 'Shop', 'route' => '/shop'],
            ['name' => 'Contact', 'route' => '/contact'],

        ];

        foreach ($menus as $menu) {
            Menu::create($menu);
        }
    }
}
