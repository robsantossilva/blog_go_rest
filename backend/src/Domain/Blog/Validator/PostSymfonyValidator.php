<?php

namespace Core\Domain\Blog\Validator;

use Core\Domain\SharedCore\Entity\EntityAbstract;
use Core\Domain\SharedCore\Notification\NotificationErrorProps;
use Core\Domain\SharedCore\Validator\ValidatorInterface;
use Core\Domain\Video\Entity\Video;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Validation;

class PostSymfonyValidator implements ValidatorInterface
{
    /**
     * @var Video $entity
     */
    public function Validate(EntityAbstract $entity): void
    {

        $arrayValidations = [];

        $arrayValidations[] = Validation::createValidator()
            ->validate($entity->id, [
                new NotBlank(null, "Id is required")
            ]);

        $arrayValidations[] = Validation::createValidator()
            ->validate($entity->user_id, [
                new NotBlank(null, "UserId is required")
            ]);

        $arrayValidations[] = Validation::createValidator()
            ->validate($entity->title, [
                new NotBlank(null, "Title is required")
            ]);

        $arrayValidations[] = Validation::createValidator()
            ->validate($entity->body, [
                new NotBlank(null, "Body is required")
            ]);


        foreach ($arrayValidations as $validation) {
            if (count($validation)) {
                foreach ($validation as $error) {
                    $errorProps = new NotificationErrorProps(
                        message: $error->getMessage(),
                        context: 'post'
                    );

                    $entity->notification->addError($errorProps);
                }
            }
        }
    }
}
