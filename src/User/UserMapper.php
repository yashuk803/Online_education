<?php

namespace App\User;

use App\Entity\User;

final class UserMapper
{
    public static function entityToModel(User $entity): UserModel
    {
        $model = new UserModel(
            $entity->getId(),
            $entity->getEmail(),
            $entity->getRoles(),
            $entity->getPassword(),
            $entity->getCreatedAt()

        );

        return $model;
    }
}
