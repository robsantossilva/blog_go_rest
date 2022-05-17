<?php

namespace Tests\Unit\Usecase\Blog\CreatePost;

use Core\Domain\Blog\Entity\Post;
use Core\Domain\Blog\Repository\PostRepositoryInterface;
use Core\Usecase\Blog\CreatePost\CreatePostUsecase;
use Core\Usecase\Blog\CreatePost\InputCreatePostDto;
use Core\Usecase\Blog\CreatePost\OutputCreatePostDto;
use Tests\TestCase;

class CreatePostUsecaseUnitTest extends TestCase
{
    public function testCreatePost()
    {

        $postRepository = $this->getMockBuilder(PostRepositoryInterface::class)
            ->setMethods(['create', 'findAll'])
            ->getMock();
        $postRepository
            ->expects($this->once())
            ->method('create')
            ->withAnyParameters()
            ->willReturn(new Post(
                id: "1",
                user_id: "2",
                title: "Iniciando com PHP",
                body: "PHP é uma linguagem que roda do lado servidor"
            ));

        /**
         * @var PostRepositoryInterface $postRepository
         */
        $createPostUseCase = new CreatePostUsecase($postRepository);

        $input = new InputCreatePostDto(
            user_id: "2",
            title: "Iniciando com PHP",
            body: "PHP é uma linguagem que roda do lado servidor"
        );

        $output = $createPostUseCase->execute($input);

        $this->assertInstanceOf(OutputCreatePostDto::class, $output);
        $this->assertNotEmpty($output->id);
        $this->assertEquals("2", $output->user_id);
        $this->assertEquals("Iniciando com PHP", $output->title);
        $this->assertEquals("PHP é uma linguagem que roda do lado servidor", $output->body);
    }
}
