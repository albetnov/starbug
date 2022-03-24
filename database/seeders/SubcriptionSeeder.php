<?php

namespace Database\Seeders;

use App\Models\Subcriptions;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubcriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Subcriptions::create([
            'name' => 'Bronze',
            'discount' => '10',
            'price' => '20000',
            'status' => 'applecible'
        ]);

        Subcriptions::create([
            'name' => 'Silver',
            'discount' => '15',
            'price' => '200000',
            'status' => 'applecible'
        ]);

        Subcriptions::create([
            'name' => 'Gold',
            'discount' => '20',
            'price' => '350000',
            'status' => 'applecible'
        ]);
    }
}
