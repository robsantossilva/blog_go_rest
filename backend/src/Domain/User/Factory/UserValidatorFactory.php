<?php

namespace Core\Domain\User\Factory;

use Core\Domain\User\Validator\UserSymfonyValidator;
use Core\Domain\SharedCore\Validator\ValidatorInterface;

class UserValidatorFactory
{
    static public function create(): ValidatorInterface
    {
        return new UserSymfonyValidator();
    }
}
