<?php

namespace Tests\Unit\Infrastructure\User\Repository;

use Core\Domain\User\Entity\User;
use Core\Infrastructure\User\Repository\UserRepository;
use Ramsey\Uuid\Uuid;
use Tests\TestCase;

class UserRepositoryUnitTest extends TestCase
{

    public function testCreateUser()
    {
        $repository = new UserRepository();

        $genderArr = ['male', 'female'];
        $statusArr = ['active', 'inactive'];

        $faker = \Faker\Factory::create();

        $gender = $genderArr[rand(0, 1)];
        $name = $faker->firstName($gender) . " " . $faker->lastName();
        $email = $faker->email();
        $status = $statusArr[rand(0, 1)];

        $user = $repository->create(new User(
            id: Uuid::uuid4()->toString(),
            name: $name,
            email: $email,
            gender: $gender,
            status: $status,
        ));

        $this->assertNotEmpty($user->id);
        $this->assertEquals($name, $user->name);
        $this->assertEquals($email, $user->email);
        $this->assertEquals($gender, $user->gender);
        $this->assertEquals($status, $user->status);
    }

    public function testFindAllUsers()
    {
        $repository = new UserRepository();

        $users = $repository->findAll();

        $this->assertNotEmpty($users[0]->id);
        $this->assertNotEmpty($users[0]->name);
        $this->assertNotEmpty($users[0]->email);
        $this->assertNotEmpty($users[0]->gender);
        $this->assertNotEmpty($users[0]->status);
    }
}
