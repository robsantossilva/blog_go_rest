<?php

namespace Core\Usecase\Blog\CreateComment;

use Core\Domain\Blog\Entity\Comment;
use Core\Domain\Blog\Repository\CommentRepositoryInterface;
use Ramsey\Uuid\Uuid;

class CreateCommentUsecase
{
    public function __construct(
        protected CommentRepositoryInterface $repository
    ) {
    }
    public function execute(InputCreateCommentDto $input): OutputCreateCommentDto
    {
        $user = new Comment(
            id: Uuid::uuid4()->toString(),
            post_id: $input->post_id,
            name: $input->name,
            email: $input->email,
            body: $input->body,
        );

        $commentPersistent = $this->repository->create($user);

        return new OutputCreateCommentDto(
            id: $commentPersistent->id,
            post_id: $commentPersistent->post_id,
            name: $commentPersistent->name,
            email: $commentPersistent->email,
            body: $commentPersistent->body,
        );
    }
}
