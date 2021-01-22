<?php

namespace App;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CreateUserWithTenant
{
    protected $tenant;

    protected $user;

    public function create(array $data) : User
    {
        DB::transaction(function () use ($data){

            $this->tenant = Tenant::create();

            $this->user = User::create([
                'tenant_id' => $this->tenant->id,
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password'])
            ]);

            $this->user->assignRole(User::$ADMINISTRADOR);

        });

        return $this->user;
    }
}
