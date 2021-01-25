<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Support\Str;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    public function test_register()
    {
        // disable middleware, because we are out of the web browser
        $this->withoutMiddleware();

        // factory user data
        $userData = User::factory()->make()->toArray();

        // set password because it's hidden by model definition
        $userData['password'] = Str::random(8);

        // submit data to registration end point
        $response = $this->post('/register', $userData);

        // check if user has been registration and if is redirect to panel after registration
        $response->assertRedirect('/');
    }
}
