<?php

namespace Core\Domain\User\Repository;

use Core\Domain\SharedCore\Repository\RepositoryInterface;
use Core\Domain\User\Entity\User;

interface UserRepositoryInterface extends RepositoryInterface
{
    public function create(User $user): User;

    /**
     * @return User[]
     */
    public function findAll(int $page, bool $publicList = true): array;
}
