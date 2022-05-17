<?php

namespace Core\Usecase\Blog\ListPost;

use Core\Domain\Blog\Repository\PostRepositoryInterface;

class ListPostUsecase
{
    public function __construct(
        protected PostRepositoryInterface $repository
    ) {
    }


    /**
     * @return PostDto[]
     */
    public function execute(InputListPostDto $input): array
    {

        $usersPersistent = $this->repository->findAll($input->page, $input->publicList);


        return OutputListPostDto::usersDto($usersPersistent);
    }
}
