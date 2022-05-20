<?php

namespace Core\Domain\Blog\Repository;

use Core\Domain\SharedCore\Repository\RepositoryInterface;
use Core\Domain\Blog\Entity\Comment;

interface CommentRepositoryInterface extends RepositoryInterface
{
    public function create(Comment $post): Comment;

    /**
     * @return Comment[]
     */
    public function findAll(string $postId, int $page, bool $publicList): array;

    public function delete(string $commentId): void;
}
