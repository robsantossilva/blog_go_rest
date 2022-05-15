<?php

namespace Core\Usecase\Blog\CreatePost;

class OutputCreatePostDto
{
    public function __construct(
        public string $id,
        public string $user_id,
        public string $title,
        public string $body,
    ) {
    }
}
