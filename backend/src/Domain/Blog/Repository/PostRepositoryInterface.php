<?php

namespace Core\Domain\Blog\Repository;

use Core\Domain\SharedCore\Repository\RepositoryInterface;
use Core\Domain\Blog\Entity\Post;

interface PostRepositoryInterface extends RepositoryInterface
{
    public function create(Post $post): Post;
}
