<?php

/*
 * This file is part of Symfony DEMO Online Education Application.
 * (c) Tarantsova Mariia <yashuk803@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Course;

use App\Entity\Course;

final class CourseMapper
{
    public static function entityToModel(Course $entity): CourseModel
    {
        $model = new CourseModel(
            $entity->getId(),
            $entity->getName(),
            $entity->getCost(),
            $entity->getAccessType(),
            $entity->getPublicationDate(),
            $entity->getUser()->getId()

        );

        $model->setDescription($entity->getDescription());
        $model->setShortDescription($entity->getShortDescription());
        $model->setVideo($entity->getVideo());
        $model->setFirstName($entity->getUser()->getFirstName());

        return $model;
    }
}
