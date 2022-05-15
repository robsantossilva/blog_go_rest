<?php

namespace Core\Usecase\Blog\CreatePost;

class InputCreatePostDto
{
    public function __construct(
        public string $user_id,
        public string $title,
        public string $body,
    ) {
    }
}
