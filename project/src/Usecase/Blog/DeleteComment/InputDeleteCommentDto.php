<?php

namespace Core\Usecase\Blog\DeleteComment;

class InputDeleteCommentDto
{
    public function __construct(
        public string $comment_id
    ) {
    }
}
