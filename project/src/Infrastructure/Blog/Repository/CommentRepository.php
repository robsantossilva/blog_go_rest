<?php

namespace Core\Infrastructure\Blog\Repository;

use App\Clients\GoRestClient;
use Core\Domain\Blog\Entity\Comment;
use Core\Domain\Blog\Repository\CommentRepositoryInterface;
use GuzzleHttp\RequestOptions;

class CommentRepository implements CommentRepositoryInterface
{
    public function create(Comment $comment): Comment
    {
        $client = new GoRestClient();
        $prefix = GoRestClient::prefix() ?? '';

        $response = $client->post("posts/{$comment->post_id}/comments", [
            RequestOptions::JSON => [
                'name' => $prefix . $comment->name,
                'email' => $comment->email,
                'body' => $comment->body
            ]
        ]);

        if ($response->getBody()) {
            $c = json_decode($response->getBody()->getContents(), true);

            return new Comment(
                id: $c['id'],
                post_id: $c['post_id'],
                name: str_replace($prefix, "", $c['name']),
                email: $c['email'],
                body: $c['body']
            );
        }
        return new Comment();
    }

    /**
     * @return Comment[]
     */
    public function findAll(string $postId, int $page = 1, bool $publicList = true): array
    {
        $client = new GoRestClient();
        $prefix = GoRestClient::prefix() ?? '';

        if ($prefix && $publicList == false) {
            $response = $client->request('GET', "posts/{$postId}/comments?name={$prefix}");
        } else {
            $response = $client->request('GET', "posts/{$postId}/comments");
        }

        $comments = [];

        if ($response->getBody()) {
            $data = json_decode($response->getBody()->getContents(), true);
            $comments = array_map(function ($c) use ($prefix) {

                return new Comment(
                    id: $c['id'],
                    post_id: $c['post_id'],
                    name: str_replace($prefix, "", $c['name']),
                    email: $c['email'],
                    body: $c['body']
                );
            }, $data);
        }

        return $comments;
    }

    public function delete(string $commentId): void
    {
        $client = new GoRestClient();
        $client->delete("comments/{$commentId}");
    }
}
