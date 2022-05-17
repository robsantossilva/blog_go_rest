<?php

namespace Tests\Unit\Usecase\Blog\ListPost;

use Core\Domain\Blog\Entity\Post;
use Core\Domain\Blog\Repository\PostRepositoryInterface;
use Core\Usecase\Blog\ListPost\InputListPostDto;
use Core\Usecase\Blog\ListPost\ListPostUsecase;
use Core\Usecase\Blog\ListPost\PostDto;
use Tests\TestCase;

class ListPostUsecaseUnitTest extends TestCase
{
    public function testListPost()
    {

        $input = new InputListPostDto();

        $postRepository = $this->getMockBuilder(PostRepositoryInterface::class)
            ->setMethods(['create', 'findAll'])
            ->getMock();
        $postRepository
            ->expects($this->once())
            ->method('findAll')
            ->with($input->page)
            ->willReturn([
                new Post(
                    id: "1",
                    user_id: "2",
                    title: "Iniciando com PHP",
                    body: "PHP é uma linguagem que roda do lado servidor"
                )
            ]);

        /**
         * @var PostRepositoryInterface $postRepository
         */
        $listPostUseCase = new ListPostUsecase($postRepository);

        $output = $listPostUseCase->execute($input);

        $this->assertInstanceOf(PostDto::class, $output[0]);
        $this->assertNotEmpty($output[0]->id);
        $this->assertEquals("2", $output[0]->user_id);
        $this->assertEquals("Iniciando com PHP", $output[0]->title);
        $this->assertEquals("PHP é uma linguagem que roda do lado servidor", $output[0]->body);
    }
}
