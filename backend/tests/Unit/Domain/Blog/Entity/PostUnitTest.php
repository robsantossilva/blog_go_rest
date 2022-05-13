<?php

namespace Tests\Unit\Domain\Blog\Entity;

use Core\Domain\Blog\Entity\Post;
use Tests\TestCase;

class PostUnitTest extends TestCase
{
    public function testPostAttributes()
    {
        $post = new Post(
            id: "1",
            user_id: "2",
            title: "Iniciando com PHP",
            body: "PHP é uma linguagem que roda do lado servidor"
        );

        $this->assertEquals("1", $post->id);
        $this->assertEquals("2", $post->user_id);
        $this->assertEquals("Iniciando com PHP", $post->title);
        $this->assertEquals("PHP é uma linguagem que roda do lado servidor", $post->body);
    }

    public function testPostException()
    {
        $message = "post: Id is required, ";
        $message .= "post: UserId is required, ";
        $message .= "post: Title is required, ";
        $message .= "post: Body is required";

        try {
            new Post();
            $this->assertTrue(false);
        } catch (\Throwable $th) {
            $this->assertEquals($message, $th->getMessage());
        }
    }
}
