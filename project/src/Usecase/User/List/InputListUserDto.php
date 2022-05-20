<?php

namespace Core\Usecase\User\List;

class InputListUserDto
{
    public function __construct(
        public int $page = 1
    ) {
    }
}
