<?php

namespace App;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateMember
{
    protected $tenant;

    protected $user;

    public function create(array $data) : User
    {
        $this->user = User::create([
            'tenant_id' => tenant()->id,
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);

        $this->user->assignRole(User::$ANALYST);

        return $this->user;
    }
}
