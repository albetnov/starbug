<?php

namespace Database\Seeders;

use App\Models\Table;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Table::create([
            'name' => 'SM-001',
            'seat' => '2',
            'status' => 'useable',
        ]);
        Table::create([
            'name' => 'SM-002',
            'seat' => '2',
            'status' => 'useable',
        ]);
        Table::create([
            'name' => 'SM-003',
            'seat' => '2',
            'status' => 'useable',
        ]);
        Table::create([
            'name' => 'SM-004',
            'seat' => '2',
            'status' => 'useable',
        ]);
        Table::create([
            'name' => 'SM-005',
            'seat' => '2',
            'status' => 'useable',
        ]);
    }
}
