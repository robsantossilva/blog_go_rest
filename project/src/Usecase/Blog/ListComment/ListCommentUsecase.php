<?php

namespace Core\Usecase\Blog\ListComment;

use Core\Domain\Blog\Repository\CommentRepositoryInterface;

class ListCommentUsecase
{
    public function __construct(
        protected CommentRepositoryInterface $repository
    ) {
    }


    /**
     * @return CommentDto[]
     */
    public function execute(InputListCommentDto $input): array
    {

        $usersPersistent = $this->repository->findAll($input->post_id, $input->page, $input->publicList);


        return OutputListCommentDto::usersDto($usersPersistent);
    }
}
