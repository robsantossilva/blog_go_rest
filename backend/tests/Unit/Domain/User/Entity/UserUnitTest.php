<?php

namespace Tests\Unit\Domain\User\Entity;

use Core\Domain\User\Entity\User;
use Tests\TestCase;

class UserUnitTest extends TestCase
{
    public function testUserAttributes()
    {
        $user = new User(
            id: "1",
            name: "Robert Downey Jr.",
            email: "robert@gmail.com",
            gender: "male",
            status: "active",
        );

        $this->assertEquals("1", $user->id);
        $this->assertEquals("Robert Downey Jr.", $user->name);
        $this->assertEquals("robert@gmail.com", $user->email);
        $this->assertEquals("male", $user->gender);
        $this->assertEquals("active", $user->status);
    }

    public function testUserException()
    {
        $message = "user: Id is required, ";
        $message .= "user: Name is required, ";
        $message .= "user: Email is required, ";
        $message .= "user: Gender is required, ";
        $message .= "user: Status is required";

        try {
            new User();
            $this->assertTrue(false);
        } catch (\Throwable $th) {
            $this->assertEquals($message, $th->getMessage());
        }
    }
}
