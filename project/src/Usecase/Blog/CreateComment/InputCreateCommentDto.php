<?php

namespace Core\Usecase\Blog\CreateComment;

class InputCreateCommentDto
{
    public function __construct(
        public string $post_id,
        public string $name,
        public string $email,
        public string $body,
    ) {
    }
}
