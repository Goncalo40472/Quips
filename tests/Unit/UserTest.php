<?php

namespace Tests\Unit;

use App\Models\User;
use PHPUnit\Framework\TestCase;

final class UserTest extends TestCase
{

    /* Test if the name is the same as the one inserted */

    /*public function testUserHasWrongName()
    {
        $user = new User([
            'name' => 'Mary Ann',
        ]);

        $this->assertEquals('John Doe', $user->name);
    }*/


    public function testUserHasName()
    {
        $user = new User([
            'name' => 'John Doe',
        ]);

        $this->assertEquals('John Doe', $user->name);
    }

    /* Test if the email is the same as the one inserted */

    /*public function testUserHasWrongEmail()
    {
        $user = new User([
            'email' => 'maryAnn@gmail.com',
        ]);

        $this->assertEquals('johnDoe@gmail.com', $user->email);
    }*/

    public function testUserHasEmail()
    {
        $user = new User([
            'email' => 'johnDoe@gmail.com',
        ]);

        $this->assertEquals('johnDoe@gmail.com', $user->email);

    }

    /* Test if the NIF is the same as the one inserted */

    /*public function testUserHasWrongNIF()
    {
        $user = new User([
            'nif' => '123456789',
        ]);

        $this->assertEquals('987654321', $user->nif);
    }*/

    public function testUserHasNIF()
    {
        $user = new User([
            'nif' => '123456789',
        ]);

        $this->assertEquals('123456789', $user->nif);
    }

    /* Test if the cellphone is the same as the one inserted */

    /*public function testUserHasWrongCellphone()
    {
        $user = new User([
            'cellphone' => '123456789',
        ]);

        $this->assertEquals('987654321', $user->cellphone);
    }*/

    public function testUserHasCellphone()
    {
        $user = new User([
            'cellphone' => '123456789',
        ]);

        $this->assertEquals('123456789', $user->cellphone);
    }

    /* Test if the password is the same as the one inserted */

    /*public function testUserHasWrongPassword()
    {
        $user = new User([
            'password' => 'password',
        ]);

        $this->assertEquals('123456789', $user->password);
    }*/

    public function testUserHasPassword()
    {
        $user = new User([
            'password' => 'password',
        ]);

        $this->assertEquals('password', $user->password);

    }

    /* Test if the type is the same as the one inserted */

    /*public function testUserHasWrongType()
    {
        $user = new User([
            'type' => 0,
        ]);

        $this->assertEquals(1, $user->type);
    }*/

    public function testUserHasType()
    {
        $user = new User([
            'type' => 0,
        ]);

        $this->assertEquals(0, $user->type);
    }

    /* Test the creation of a user */

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