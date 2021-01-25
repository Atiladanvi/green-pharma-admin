<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Warehouse;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class WareHousesSeeder extends Seeder
{
    public function run()
    {
        Warehouse::create(['name' => 'GREEN PHARMA PA', 'uf' => 'PA']);
    }
}
