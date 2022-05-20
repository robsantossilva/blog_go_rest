<?php

namespace Core\Domain\Blog\Factory;

use Core\Domain\Blog\Validator\CommentSymfonyValidator;
use Core\Domain\SharedCore\Validator\ValidatorInterface;

class CommentValidatorFactory
{
    static public function create(): ValidatorInterface
    {
        return new CommentSymfonyValidator();
    }
}
