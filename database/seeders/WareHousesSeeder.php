<?php

namespace Database\Seeders;

use App\Models\Warehouse;
use Illuminate\Database\Seeder;

class WareHousesSeeder extends Seeder
{
    public function run()
    {
        Warehouse::insert([
            ['name' => 'GREEN PHARMA PA', 'uf' => 'PA'],
            ['name' => 'GREEN PHARMA MG', 'uf' => 'MG'],
            ['name' => 'GREEN PHARMA BA', 'uf' => 'BA'],
            ['name' => 'GREEN PHARMA PE', 'uf' => 'PE']
        ]);
    }
}
