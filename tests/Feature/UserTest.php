<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

final class UserTest extends TestCase
{

    public function testCreateUser()
    {
        $user = new User([
            'name' => 'John Doe',
            'email' => 'jonhDoe@gmail.com',
            'password' => 'password',
            'cellphone' => '123456789',
            'nif' => '123456789',
            'type' => 0,
        ]);

        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals('John Doe', $user->name);
        $this->assertEquals('jonhDoe@gmail.com', $user->email);
        $this->assertEquals('password', $user->password);
        $this->assertEquals('123456789', $user->cellphone);
        $this->assertEquals('123456789', $user->nif);
        $this->assertEquals(0, $user->type);
    }

}