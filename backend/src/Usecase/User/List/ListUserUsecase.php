<?php

namespace Core\Usecase\User\List;

use Core\Domain\User\Repository\UserRepositoryInterface;
use Core\Usecase\User\List\OutputListUserDto;
use Core\Usecase\User\List\InputListUserDto as ListInputListUserDto;

class ListUserUsecase
{
    public function __construct(
        protected UserRepositoryInterface $repository
    ) {
    }


    /**
     * @return UserDto[]
     */
    public function execute(ListInputListUserDto $input): array
    {

        $usersPersistent = $this->repository->findAll($input->page);


        return OutputListUserDto::usersDto($usersPersistent);
    }
}
