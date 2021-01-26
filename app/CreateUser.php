<?php

namespace App;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class CreateUser
{
    protected $tenant;

    protected $user;

    public function create(array $data, Role $role) : User
    {
        DB::transaction(function () use ($data, $role){

            $this->user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password'])
            ]);

            $this->user->assignRole($role);

        });

        return $this->user;
    }
}
