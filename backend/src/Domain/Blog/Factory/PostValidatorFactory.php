<?php

namespace Core\Domain\Blog\Factory;

use Core\Domain\Blog\Validator\PostSymfonyValidator;
use Core\Domain\SharedCore\Validator\ValidatorInterface;

class PostValidatorFactory
{
    static public function create(): ValidatorInterface
    {
        return new PostSymfonyValidator();
    }
}
