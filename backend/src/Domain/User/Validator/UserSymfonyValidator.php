<?php

namespace Core\Domain\User\Validator;

use Core\Domain\SharedCore\Entity\EntityAbstract;
use Core\Domain\SharedCore\Notification\NotificationErrorProps;
use Core\Domain\SharedCore\Validator\ValidatorInterface;

use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Validation;

class UserSymfonyValidator implements ValidatorInterface
{

    public function Validate(EntityAbstract $entity): void
    {

        $arrayValidations = [];

        $arrayValidations[] = Validation::createValidator()
            ->validate($entity->id, [
                new NotBlank(null, "Id is required")
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
            ->validate($entity->gender, [
                new NotBlank(null, "Gender is required")
            ]);

        $arrayValidations[] = Validation::createValidator()
            ->validate($entity->status, [
                new NotBlank(null, "Status is required")
            ]);


        foreach ($arrayValidations as $validation) {
            if (count($validation)) {
                foreach ($validation as $error) {
                    $errorProps = new NotificationErrorProps(
                        message: $error->getMessage(),
                        context: 'user'
                    );

                    $entity->notification->addError($errorProps);
                }
            }
        }
    }
}
