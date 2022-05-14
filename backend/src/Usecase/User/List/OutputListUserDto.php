<?php

namespace Core\Usecase\User\List;

use Core\Domain\User\Entity\User;

class UserDto
{
    public function __construct(
        public string $id,
        public string $name,
        public string $email,
        public string $gender,
        public string $status,
    ) {
    }
}

class OutputListUserDto
{
    /**
     * @param User[] $users
     * @return UserDto[]
     */
    static public function usersDto(array $users): array
    {

        /**
         * @var User $user
         */
        return array_map(function ($user) {

            return new UserDto(
                id: $user->id,
                name: $user->name,
                email: $user->email,
                gender: $user->gender,
                status: $user->status
            );
        }, $users);
    }
}
