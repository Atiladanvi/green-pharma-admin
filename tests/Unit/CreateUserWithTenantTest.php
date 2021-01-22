<?php

namespace Tests\Unit;

use App\CreateUserWithTenant;
use App\Models\User;
use Illuminate\Support\Str;
use Tests\TestCase;

class CreateUserWithTenantTest extends TestCase
{

    public function test_create()
    {
        // factory user data
        $userData = User::factory()->make()->toArray();

        // set password because it's hidden by model definition
        $userData['password'] = Str::random(8);

        // Create user with tenant
        $user = (new CreateUserWithTenant())->create($userData);

        $this->assertInstanceOf(
            \App\Models\User::class,
            $user
        );
    }
}
