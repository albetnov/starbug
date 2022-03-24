<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Menu::create([
            'id_category' => 1,
            'name' => 'Makanan Enak',
            'description' => 'Ini adalah menu makanan enak',
            'photo' => '1.jpg',
            'price' => '25000',
            'status' => 'production'
        ]);

        Menu::create([
            'id_category' => 2,
            'name' => 'Minuman Enak',
            'description' => 'Ini adalah menu Minuman enak',
            'photo' => '2.jpg',
            'price' => '5000',
            'status' => 'production'
        ]);
    }
}
