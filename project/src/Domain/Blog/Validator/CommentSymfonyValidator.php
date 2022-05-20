<?php

namespace Core\Domain\Blog\Validator;

use Core\Domain\SharedCore\Entity\EntityAbstract;
use Core\Domain\SharedCore\Notification\NotificationErrorProps;
use Core\Domain\SharedCore\Validator\ValidatorInterface;
use Core\Domain\Video\Entity\Video;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Validation;

class CommentSymfonyValidator implements ValidatorInterface
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
            ->validate($entity->post_id, [
                new NotBlank(null, "PostId is required")
            ]);

        $arrayValidations[] = Validation::createValidator()
            ->validate($entity->name, [
                new NotBlank(null, "Name is required")
            ]);

        $arrayValidations[] = Validation::createValidator()
            ->validate($entity->email, [
                new NotBlank(null, "Email is required")
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
                        context: 'comment'
                    );

                    $entity->notification->addError($errorProps);
                }
            }
        }
    }
}
