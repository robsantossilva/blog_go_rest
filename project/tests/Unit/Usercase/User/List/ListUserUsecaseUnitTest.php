<?php

namespace Tests\Unit\Usecase\User\List;

use Core\Domain\User\Entity\User;
use Core\Domain\User\Repository\UserRepositoryInterface;
use Core\Usecase\User\List\InputListUserDto;
use Core\Usecase\User\List\ListUserUsecase;
use Core\Usecase\User\List\UserDto;
use Ramsey\Uuid\Uuid;
use Tests\TestCase;

class ListUserUsecaseUnitTest extends TestCase
{
    public function testListUser()
    {

        $input = new InputListUserDto();

        $userRepository = $this->getMockBuilder(UserRepositoryInterface::class)
            ->setMethods(['create', 'findAll'])
            ->getMock();
        $userRepository
            ->expects($this->once())
            ->method('findAll')
            ->with($input->page)
            ->willReturn([
                new User(
                    id: Uuid::uuid4()->toString(),
                    name: "Robert Downey Jr.",
                    email: "robert@gmail.com",
                    gender: "male",
                    status: "active",
                )
            ]);

        /**
         * @var UserRepositoryInterface $userRepository
         */
        $listUserUseCase = new ListUserUsecase($userRepository);

        $output = $listUserUseCase->execute($input);

        $this->assertInstanceOf(UserDto::class, $output[0]);
        $this->assertNotEmpty($output[0]->id);
        $this->assertEquals("Robert Downey Jr.", $output[0]->name);
        $this->assertEquals("robert@gmail.com", $output[0]->email);
        $this->assertEquals("male", $output[0]->gender);
        $this->assertEquals("active", $output[0]->status);
    }
}
