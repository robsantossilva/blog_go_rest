<?php

namespace Tests\Unit\Usecase\User\Create;

use Core\Domain\User\Entity\User;
use Core\Domain\User\Repository\UserRepositoryInterface;
use Core\Usecase\User\Create\CreateUserUsecase;
use Core\Usecase\User\Create\InputCreateUserDto;
use Core\Usecase\User\Create\OutputCreateUserDto;
use Ramsey\Uuid\Uuid;
use Tests\TestCase;

class CreateUserUsecaseUnitTest extends TestCase
{
    public function testCreateUser()
    {

        $userRepository = $this->getMockBuilder(UserRepositoryInterface::class)
            ->setMethods(['create', 'findAll'])
            ->getMock();
        $userRepository
            ->expects($this->once())
            ->method('create')
            ->withAnyParameters()
            ->willReturn(new User(
                id: Uuid::uuid4()->toString(),
                name: "Robert Downey Jr.",
                email: "robert@gmail.com",
                gender: "male",
                status: "active",
            ));

        /**
         * @var UserRepositoryInterface $userRepository
         */
        $createUserUseCase = new CreateUserUsecase($userRepository);

        $input = new InputCreateUserDto(
            name: "Robert Downey Jr.",
            email: "robert@gmail.com",
            gender: "male",
            status: "active",
        );

        $output = $createUserUseCase->execute($input);

        $this->assertInstanceOf(OutputCreateUserDto::class, $output);
        $this->assertNotEmpty($output->id);
        $this->assertEquals("Robert Downey Jr.", $output->name);
        $this->assertEquals("robert@gmail.com", $output->email);
        $this->assertEquals("male", $output->gender);
        $this->assertEquals("active", $output->status);
    }
}
