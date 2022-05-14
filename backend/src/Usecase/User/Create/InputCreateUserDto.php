<?php

namespace Core\Usecase\User\Create;

class InputCreateUserDto
{
    public function __construct(
        public string $name,
        public string $email,
        public string $gender,
        public string $status,
    ) {
    }
}
