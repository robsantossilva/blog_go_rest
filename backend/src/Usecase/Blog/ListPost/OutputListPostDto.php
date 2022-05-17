<?php

namespace Core\Usecase\Blog\ListPost;

use Core\Domain\Post\Entity\Post;

class PostDto
{
    public function __construct(
        public string $id,
        public string $user_id,
        public string $title,
        public string $body,
    ) {
    }
}

class OutputListPostDto
{
    /**
     * @param Post[] $posts
     * @return PostDto[]
     */
    static public function usersDto(array $posts): array
    {

        /**
         * @var Post $post
         */
        return array_map(function ($post) {

            return new PostDto(
                id: $post->id,
                user_id: $post->user_id,
                title: $post->title,
                body: $post->body,
            );
        }, $posts);
    }
}
