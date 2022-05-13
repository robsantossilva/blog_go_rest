<?php

namespace Core\Domain\Blog\Entity;

use Core\Domain\Blog\Factory\CommentValidatorFactory;
use Core\Domain\SharedCore\Entity\EntityAbstract;
use Core\Domain\SharedCore\Notification\Notification;
use Core\Domain\SharedCore\Notification\NotificationException;

class Comment extends EntityAbstract
{
    public function __construct(
        protected string $id = '',
        protected string $post_id = '',
        protected string $name = '',
        protected string $email = '',
        protected string $body = '',
    ) {
        parent::__construct(new Notification());

        $this->validate();
    }

    public function validate()
    {
        CommentValidatorFactory::create()->Validate($this);

        if ($this->notification->hasErrors()) {
            throw new NotificationException($this->notification->getErrors());
        }
    }
}
