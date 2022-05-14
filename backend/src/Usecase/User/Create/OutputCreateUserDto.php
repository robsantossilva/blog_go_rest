<?php

namespace Core\Usecase\User\Create;

class OutputCreateUserDto
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
