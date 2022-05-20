<?php

namespace Core\Domain\User\Entity;

use Core\Domain\User\Factory\UserValidatorFactory;
use Core\Domain\SharedCore\Entity\EntityAbstract;
use Core\Domain\SharedCore\Notification\Notification;
use Core\Domain\SharedCore\Notification\NotificationException;

class User extends EntityAbstract
{
    public function __construct(
        protected string $id = '',
        protected string $name = '',
        protected string $email = '',
        protected string $gender = '',
        protected string $status = '',
    ) {
        parent::__construct(new Notification());

        $this->validate();
    }

    public function validate()
    {
        UserValidatorFactory::create()->Validate($this);

        if ($this->notification->hasErrors()) {
            throw new NotificationException($this->notification->getErrors());
        }
    }
}
