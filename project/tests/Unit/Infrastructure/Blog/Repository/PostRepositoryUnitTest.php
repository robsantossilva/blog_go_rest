<?php

namespace Tests\Unit\Infrastructure\Post\Repository;

use Core\Domain\Blog\Entity\Post;
use Core\Infrastructure\Blog\Repository\PostRepository;
use Ramsey\Uuid\Uuid;
use Tests\TestCase;

class PostRepositoryUnitTest extends TestCase
{

    public function testCreatePost()
    {
        $repository = new PostRepository();

        $faker = \Faker\Factory::create();

        $title = $faker->text(100);
        $body = $faker->text(500);

        $post = $repository->create(new Post(
            id: Uuid::uuid4()->toString(),
            user_id: "1234",
            title: $title,
            body: $body,
        ));

        $this->assertNotEmpty($post->id);
        $this->assertNotEmpty($post->user_id);
        $this->assertEquals($title, $post->title);
        $this->assertEquals($body, $post->body);
    }

    public function testFindAllPosts()
    {
        $repository = new PostRepository();

        $posts = $repository->findAll();

        //$this->assertEquals(20, count($posts));
        $this->assertNotEmpty($posts[0]->id);
        $this->assertNotEmpty($posts[0]->user_id);
        $this->assertNotEmpty($posts[0]->title);
        $this->assertNotEmpty($posts[0]->body);
    }
}
