<?php

namespace Core\Infrastructure\Blog\Repository;

use Core\Domain\Blog\Entity\Post;
use Core\Domain\Blog\Repository\PostRepositoryInterface;
use GuzzleHttp\Client;

class PostRepository implements PostRepositoryInterface
{
    public function create(Post $post): Post
    {
        return new Post();
    }

    /**
     * @return Post[]
     */
    public function findAll(int $page, bool $publicList): array
    {
        $prefix = 'aW5pY2ll_';

        $client = new Client([
            'base_uri'        => 'http://www.foo.com/1.0/',
            'headers' => []
        ]);

        return [];
    }
}
