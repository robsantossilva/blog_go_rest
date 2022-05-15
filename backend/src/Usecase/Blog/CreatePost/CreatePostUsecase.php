<?php

namespace Core\Usecase\Blog\CreatePost;

use Core\Domain\Blog\Entity\Post;
use Core\Domain\Blog\Repository\PostRepositoryInterface;
use Ramsey\Uuid\Uuid;

class CreatePostUsecase
{
    public function __construct(
        protected PostRepositoryInterface $repository
    ) {
    }
    public function execute(InputCreatePostDto $input): OutputCreatePostDto
    {
        $user = new Post(
            id: Uuid::uuid4()->toString(),
            user_id: $input->user_id,
            title: $input->title,
            body: $input->body
        );

        $postPersistent = $this->repository->create($user);

        return new OutputCreatePostDto(
            id: $postPersistent->id,
            user_id: $postPersistent->user_id,
            title: $postPersistent->title,
            body: $postPersistent->body
        );
    }
}
