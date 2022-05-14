<?php

namespace Core\Usecase\User\Create;

use Core\Domain\User\Entity\User;
use Core\Domain\User\Repository\UserRepositoryInterface;
use Ramsey\Uuid\Uuid;

class CreateUserUsecase
{
    public function __construct(
        protected UserRepositoryInterface $repository
    ) {
    }
    public function execute(InputCreateUserDto $input): OutputCreateUserDto
    {
        $user = new User(
            id: Uuid::uuid4()->toString(),
            name: $input->name,
            email: $input->email,
            gender: $input->gender,
            status: $input->status
        );

        $userPersistent = $this->repository->create($user);

        return new OutputCreateUserDto(
            id: $userPersistent->id,
            name: $userPersistent->name,
            email: $userPersistent->email,
            gender: $userPersistent->gender,
            status: $userPersistent->status
        );
    }
}
