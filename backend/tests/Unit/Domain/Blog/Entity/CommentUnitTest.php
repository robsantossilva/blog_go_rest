<?php

namespace Tests\Unit\Domain\Blog\Entity;

use Core\Domain\Blog\Entity\Comment;
use Tests\TestCase;

class CommentUnitTest extends TestCase
{
    public function testCommentAttributes()
    {
        $comment = new Comment(
            id: "1",
            post_id: "2",
            name: "Robert Downey Jr.",
            email: "robert@gmail.com",
            body: "Eu sou o Homem de Ferro",
        );

        $this->assertEquals("1", $comment->id);
        $this->assertEquals("2", $comment->post_id);
        $this->assertEquals("Robert Downey Jr.", $comment->name);
        $this->assertEquals("robert@gmail.com", $comment->email);
        $this->assertEquals("Eu sou o Homem de Ferro", $comment->body);
    }

    public function testCommentException()
    {
        $message = "comment: Id is required, ";
        $message .= "comment: PostId is required, ";
        $message .= "comment: Name is required, ";
        $message .= "comment: Email is required, ";
        $message .= "comment: Body is required";

        try {
            new Comment();
            $this->assertTrue(false);
        } catch (\Throwable $th) {
            $this->assertEquals($message, $th->getMessage());
        }
    }
}
