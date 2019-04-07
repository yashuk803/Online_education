<?php

/*
 * This file is part of Symfony DEMO Onlain Education Application.
 * (c) Tarantsova Mariia <yashuk803@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

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
