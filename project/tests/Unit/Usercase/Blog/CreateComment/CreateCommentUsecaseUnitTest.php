<?php

namespace Tests\Unit\Usecase\Blog\CreateComment;

use Core\Domain\Blog\Entity\Comment;
use Core\Domain\Blog\Repository\CommentRepositoryInterface;
use Core\Usecase\Blog\CreateComment\CreateCommentUsecase;
use Core\Usecase\Blog\CreateComment\InputCreateCommentDto;
use Core\Usecase\Blog\CreateComment\OutputCreateCommentDto;
use Tests\TestCase;

class CreateCommentUsecaseUnitTest extends TestCase
{
    public function testCreateComment()
    {

        $postRepository = $this->getMockBuilder(CommentRepositoryInterface::class)
            ->setMethods(['create', 'findAll', 'delete'])
            ->getMock();
        $postRepository
            ->expects($this->once())
            ->method('create')
            ->withAnyParameters()
            ->willReturn(new Comment(
                id: "1",
                post_id: "2",
                name: "Robson Silva",
                email: "teste@teste.com",
                body: "Comentário de Post"
            ));

        /**
         * @var CommentRepositoryInterface $postRepository
         */
        $createCommentUseCase = new CreateCommentUsecase($postRepository);

        $input = new InputCreateCommentDto(
            post_id: "2",
            name: "Robson Silva",
            email: "teste@teste.com",
            body: "Comentário de Post"
        );

        $output = $createCommentUseCase->execute($input);

        $this->assertInstanceOf(OutputCreateCommentDto::class, $output);
        $this->assertNotEmpty($output->id);
        $this->assertEquals("2", $output->post_id);
        $this->assertEquals("Robson Silva", $output->name);
        $this->assertEquals("teste@teste.com", $output->email);
        $this->assertEquals("Comentário de Post", $output->body);
    }
}
