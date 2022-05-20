<?php

namespace Tests\Unit\Infrastructure\Comment\Repository;

use Core\Domain\Blog\Entity\Comment;
use Core\Infrastructure\Blog\Repository\CommentRepository;
use Ramsey\Uuid\Uuid;
use Tests\TestCase;

class CommentRepositoryUnitTest extends TestCase
{

    public function testCreateComment()
    {
        $repository = new CommentRepository();

        $faker = \Faker\Factory::create();

        $name = $faker->text(100);
        $email = $faker->email();
        $body = $faker->text(500);

        $comment = $repository->create(new Comment(
            id: Uuid::uuid4()->toString(),
            post_id: "1234",
            name: $name,
            email: $email,
            body: $body,
        ));

        $this->assertNotEmpty($comment->id);
        $this->assertNotEmpty($comment->post_id);
        $this->assertEquals($name, $comment->name);
        $this->assertEquals($email, $comment->email);
        $this->assertEquals($body, $comment->body);
    }

    public function testFindAllComments()
    {
        $repository = new CommentRepository();

        $comments = $repository->findAll("1234");

        $this->assertNotEmpty($comments[0]->id);
        $this->assertNotEmpty($comments[0]->post_id);
        $this->assertNotEmpty($comments[0]->name);
        $this->assertNotEmpty($comments[0]->email);
        $this->assertNotEmpty($comments[0]->body);
    }
}
