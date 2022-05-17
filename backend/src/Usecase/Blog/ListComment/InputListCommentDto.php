<?php

namespace Core\Usecase\Blog\ListComment;

class InputListCommentDto
{
    public function __construct(
        public int $page = 1,
        public bool $publicList = false
    ) {
    }
}
