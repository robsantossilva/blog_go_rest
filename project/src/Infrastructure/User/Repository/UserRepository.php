<?php

namespace Core\Infrastructure\User\Repository;

use App\Clients\GoRestClient;
use Core\Domain\User\Entity\User;
use Core\Domain\User\Repository\UserRepositoryInterface;
use GuzzleHttp\RequestOptions;

class UserRepository implements UserRepositoryInterface
{
    public function create(User $user): User
    {
        $client = new GoRestClient();
        $prefix = GoRestClient::prefix() ?? '';

        $response = $client->post('users', [
            RequestOptions::JSON => [
                'name' => $prefix . $user->name,
                'email' => $user->email,
                'gender' => $user->gender,
                'status' => $user->status,
            ]
        ]);

        if ($response->getBody()) {
            $u = json_decode($response->getBody()->getContents(), true);

            return new User(
                id: $u['id'],
                name: str_replace($prefix, "", $u['name']),
                email: $u['email'],
                gender: $u['gender'],
                status: $u['status']
            );
        }

        return new User();
    }

    /**
     * @return User[]
     */
    public function findAll(int $page = 1, bool $publicList = false): array
    {

        $client = new GoRestClient();
        $prefix = GoRestClient::prefix() ?? '';

        if ($prefix && $publicList == false) {
            $response = $client->request('GET', "users?name={$prefix}");
        } else {
            $response = $client->request('GET', 'users');
        }

        $users = [];

        if ($response->getBody()) {
            $data = json_decode($response->getBody()->getContents(), true);
            $users = array_map(function ($u) use ($prefix) {

                return new User(
                    id: $u['id'],
                    name: str_replace($prefix, "", $u['name']),
                    email: $u['email'],
                    gender: $u['gender'],
                    status: $u['status']
                );
            }, $data);
        }

        return $users;
    }
}
