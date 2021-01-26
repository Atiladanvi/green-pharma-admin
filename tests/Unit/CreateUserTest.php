<?php

namespace Tests\Unit;

use App\CreateUser;
use App\Models\User;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class CreateUserTest extends TestCase
{
    public function test_create()
    {
        // factory user data
        $userData = User::factory()->make()->toArray();

        // set password because it's hidden by User class
        $userData['password'] = Str::random(8);

        // Create user admin
        $user = (new CreateUser())->create($userData, Role::findByName(User::$ADMIN));

        $this->assertInstanceOf(
            \App\Models\User::class,
            $user
        );
    }
}
