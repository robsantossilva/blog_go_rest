<?php

namespace Core\Domain\Blog\Entity;

use Core\Domain\Blog\Factory\PostValidatorFactory;
use Core\Domain\SharedCore\Entity\EntityAbstract;
use Core\Domain\SharedCore\Notification\Notification;
use Core\Domain\SharedCore\Notification\NotificationException;

class Post extends EntityAbstract
{
    public function __construct(
        protected string $id = '',
        protected string $user_id = '',
        protected string $title = '',
        protected string $body = '',
    ) {
        parent::__construct(new Notification());

        $this->validate();
    }

    public function validate()
    {
        PostValidatorFactory::create()->Validate($this);

        if ($this->notification->hasErrors()) {
            throw new NotificationException($this->notification->getErrors());
        }
    }
}
