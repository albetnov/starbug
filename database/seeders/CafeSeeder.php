<?php

namespace Database\Seeders;

use App\Models\Cafe;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CafeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Cafe::create([
            'name' => config('app.name'),
            'address' => 'Jl. Mana Saja Blok U No. 9',
            'show_lp' => 'true'
        ]);
    }
}
