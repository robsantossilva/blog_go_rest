<?php

namespace Core\Infrastructure\Blog\Repository;

use Core\Domain\Blog\Entity\Comment;
use Core\Domain\Blog\Repository\CommentRepositoryInterface;

class CommentRepository implements CommentRepositoryInterface
{
    public function create(Comment $post): Comment
    {
        return new Comment();
    }

    /**
     * @return Comment[]
     */
    public function findAll(int $page, bool $publicList): array
    {
        return [];
    }
}
