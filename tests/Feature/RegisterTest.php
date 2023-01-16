<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\WithoutMiddleware;

final class RegisterTest extends TestCase
{

    /* Test if the user can access the register form */

    public function testCanGetRegister()
    {
        $response = $this->get('/register');

        $response->assertStatus(200);

    }

    /* Test if the user can register */

    public function testUserCanRegister()
    {
        $response = $this->post('/register', [
            'name' => 'John Doe',
            'email' => 'johnDoe@gmail.com',
            'nif' => '123456789',
            'cellphone' => '912345678',
            'password' => 'password',
            'password_confirmation' => 'password',
            'type' => 0,
        ]);

        $response->assertRedirect('/home');
        $response->assertStatus(302);

    }

    /* Test if the user cannot see the register form when authenticated */

    public function testUserCannotViewRegisterFormWhenAuthenticated()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/register');

        $response->assertRedirect('/home');
        $response->assertStatus(302);

    }
            

}