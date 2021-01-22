<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsSeeder extends Seeder
{
    static $ADD_REPORT = 'add report';

    static $LIST_REPORT = 'list report';

    public function run()
    {
        $role = Role::create(['name' => User::$ADMINISTRADOR]);
        $permission = Permission::create(['name' => self::$ADD_REPORT]);
        $role->givePermissionTo($permission);

        $role2 = Role::create(['name' => User::$ANALISTA]);
        $permission2 = Permission::create(['name' => self::$LIST_REPORT]);
        $role2->givePermissionTo($permission2);
    }
}
