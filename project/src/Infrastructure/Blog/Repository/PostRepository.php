<?php

namespace Core\Infrastructure\Blog\Repository;

use App\Clients\GoRestClient;
use Core\Domain\Blog\Entity\Post;
use Core\Domain\Blog\Repository\PostRepositoryInterface;
use GuzzleHttp\RequestOptions;

class PostRepository implements PostRepositoryInterface
{
    public function create(Post $post): Post
    {
        $client = new GoRestClient();
        $prefix = GoRestClient::prefix() ?? '';

        $response = $client->post("users/{$post->user_id}/posts", [
            RequestOptions::JSON => [
                'title' => $prefix . $post->title,
                'body' => $post->body
            ]
        ]);

        if ($response->getBody()) {
            $p = json_decode($response->getBody()->getContents(), true);

            return new Post(
                id: $p['id'],
                user_id: $p['user_id'],
                title: str_replace($prefix, "", $p['title']),
                body: $p['body']
            );
        }

        return new Post();
    }

    /**
     * @return Post[]
     */
    public function findAll(int $page = 1, string $userId = '', bool $publicList = false): array
    {

        $client = new GoRestClient();
        $prefix = GoRestClient::prefix() ?? '';



        if ($prefix && $publicList == false && $userId == '') {
            $response = $client->request('GET', "posts?title={$prefix}");
        } else if ($prefix && $publicList == false && $userId != '') {
            $response = $client->request('GET', "users/{$userId}/posts?title={$prefix}");
        } else if ($publicList == true && $userId != '') {
            $response = $client->request('GET', "users/{$userId}/posts");
        } else {
            $response = $client->request('GET', 'posts');
        }

        $posts = [];

        if ($response->getBody()) {
            $data = json_decode($response->getBody()->getContents(), true);
            $posts = array_map(function ($p) use ($prefix) {

                return new Post(
                    id: $p['id'],
                    user_id: $p['user_id'],
                    title: str_replace($prefix, "", $p['title']),
                    body: $p['body']
                );
            }, $data);
        }

        return $posts;
    }
}
