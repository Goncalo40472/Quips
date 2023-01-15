<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

final class UserTest extends TestCase
{

    public function testGetUsersAsAdmin()
    {

        $user = User::factory()->create([
            'type' => 0,
        ]);

        $response = $this->actingAs($user)->get('/users/show/'.$user->id);

        $response->assertStatus(200);

    }

    public function testShowUserInfo()
    {

        $user = User::factory()->create([
            'type' => 1,
        ]);

        $admin = User::factory()->create([
            'type' => 0,
        ]);

        $response = $this->actingAs($admin)->get('/users/show/'.$user->id);

        $response->assertStatus(200);

    }

    public function testDeleteUser()
    {

        $user = User::factory()->create([
            'type' => 1,
        ]);

        $admin = User::factory()->create([
            'type' => 0,
        ]);

        $response = $this->actingAs($admin)->post('/users/destroy/'.$user->id);

        $response->assertStatus(302);

        $this->assertDatabaseMissing('users', [
            'id' => $user->id,
        ]);

    }

    public function testSeeUserProfile()
    {

        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/profile/'.$user->id);

        $response->assertStatus(200);

    }

}