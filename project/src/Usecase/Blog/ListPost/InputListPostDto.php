<?php

namespace Core\Usecase\Blog\ListPost;

class InputListPostDto
{
    public function __construct(
        public int $page = 1,
        public string $userId = '',
        public bool $publicList = false
    ) {
    }
}
