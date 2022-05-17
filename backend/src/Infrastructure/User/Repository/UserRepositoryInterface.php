<?php

namespace Core\Infrastructure\User\Repository;

use Core\Domain\User\Entity\User;
use Core\Domain\User\Repository\UserRepositoryInterface;
use GuzzleHttp\Client;

class UserRepository implements UserRepositoryInterface
{
    public function create(User $user): User
    {
        return new User();
    }

    /**
     * @return User[]
     */
    public function findAll(int $page): array
    {
        $prefix = 'aW5pY2ll_';

        $client = new Client([
            'base_uri'        => 'https://gorest.co.in/public/v2/',
            'headers' => [
                'Authorization' => 'Bearer e3a4b4e2854628f89c9a9d9fb057cf01cf39441e45a7000003fdd7b14c359a53'
            ]
        ]);

        $response = $client->get('users');

        return [];
    }
}
