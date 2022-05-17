<?php

namespace Core\Usecase\Blog\ListComment;

use Core\Domain\Comment\Entity\Comment;

class CommentDto
{
    public function __construct(
        public string $id,
        public string $post_id,
        public string $name,
        public string $email,
        public string $body,
    ) {
    }
}

class OutputListCommentDto
{
    /**
     * @param Comment[] $comments
     * @return CommentDto[]
     */
    static public function usersDto(array $comments): array
    {

        /**
         * @var Comment $comment
         */
        return array_map(function ($comment) {

            return new CommentDto(
                id: $comment->id,
                post_id: $comment->post_id,
                name: $comment->name,
                email: $comment->email,
                body: $comment->body,
            );
        }, $comments);
    }
}
