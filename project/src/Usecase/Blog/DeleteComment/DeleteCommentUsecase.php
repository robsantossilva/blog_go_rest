<?php

namespace Core\Usecase\Blog\DeleteComment;

use Core\Domain\Blog\Repository\CommentRepositoryInterface;

class DeleteCommentUsecase
{
    public function __construct(
        protected CommentRepositoryInterface $repository
    ) {
    }
    public function execute(InputDeleteCommentDto $input): void
    {
        $this->repository->delete($input->comment_id);
    }
}
