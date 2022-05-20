<?php

namespace Core\Usecase\Blog\CreateComment;

class OutputCreateCommentDto
{
    public function __construct(
        public string $id,
        public string $post_id,
        public string $name,
        public string $email,
        public string $body,
    ) {
    }
}
