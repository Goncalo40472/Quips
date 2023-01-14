<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\WithoutMiddleware;

final class LoginTest extends TestCase
{

    /* Test if the user can access the login form */

    public function testCanGetLogin()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);

    }

    /* Test if the user cannot login with incorrect credentials */
    
    public function testUserCannotLoginWithIncorrectPassword()
    {
        $user = User::factory()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        $response->assertRedirect('/login');
        $response->assertStatus(302);
    }

    /* Test if the user cannot login with incorrect email */

    public function testUserCannotLoginWithIncorrectEmail()
    {
        $user = User::factory()->create();

        $response = $this->post('/login', [
            'email' => 'wrong-email@gmail.com',
            'password' => 'password',
        ]);

        $response->assertRedirect('/login');
        $response->assertStatus(302);

    }

    /* Test if the user can login with correct credentials */

    public function testUserCanLoginWithCorrectCredentials()
    {
        
        $user = User::factory()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertRedirect('/home');
        $response->assertStatus(302);

    }

    /* Test if the user cannot see the login form when authenticated */

    public function testUserCannotViewLoginFormWhenAuthenticated()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/login');

        $response->assertRedirect('/home');
        $response->assertStatus(302);

    }

}