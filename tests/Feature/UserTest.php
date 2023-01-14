<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Support\Str;

final class UserTest extends TestCase
{

    public function testSaveUserDB()
    {

        $user = new User([
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'nif' => fake()->unique()->randomNumber(9),
            'cellphone' => fake()->phoneNumber(),
            'type' => fake()->numberBetween(0, 1),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);

        $user->save();
        $this->assertDatabaseHas('users', $user->toArray());

    }

}