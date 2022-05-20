<?php

namespace Tests\Unit\Usecase\Blog\ListComment;

use Core\Domain\Blog\Entity\Comment;
use Core\Domain\Blog\Repository\CommentRepositoryInterface;
use Core\Usecase\Blog\ListComment\CommentDto;
use Core\Usecase\Blog\ListComment\InputListCommentDto;
use Core\Usecase\Blog\ListComment\ListCommentUsecase;
use Tests\TestCase;

class ListCommentUsecaseUnitTest extends TestCase
{
    public function testListComment()
    {

        $input = new InputListCommentDto("2");

        $commentRepository = $this->getMockBuilder(CommentRepositoryInterface::class)
            ->setMethods(['create', 'findAll'])
            ->getMock();
        $commentRepository
            ->expects($this->once())
            ->method('findAll')
            ->with($input->post_id, $input->page)
            ->willReturn([
                new Comment(
                    id: "1",
                    post_id: "2",
                    name: "Robson Silva",
                    email: "teste@teste.com",
                    body: "Comentário de Post"
                )
            ]);

        /**
         * @var CommentRepositoryInterface $commentRepository
         */
        $listCommentUseCase = new ListCommentUsecase($commentRepository);

        $output = $listCommentUseCase->execute($input);

        $this->assertInstanceOf(CommentDto::class, $output[0]);
        $this->assertNotEmpty($output[0]->id);
        $this->assertEquals("2", $output[0]->post_id);
        $this->assertEquals("Robson Silva", $output[0]->name);
        $this->assertEquals("teste@teste.com", $output[0]->email);
        $this->assertEquals("Comentário de Post", $output[0]->body);
    }
}
