<?php

namespace Database\Seeders;

use App\Models\Customers;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Customers::create([
            'name' => 'Asep Surasep',
            'id_subcription' => 1,
            'status' => 'active'
        ]);

        Customers::create([
            'name' => 'Asiong Kasiong',
            'id_subcription' => 2,
            'status' => 'active'
        ]);
    }
}
