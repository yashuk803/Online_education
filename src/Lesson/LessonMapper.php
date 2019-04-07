<?php

/*
 * This file is part of Symfony DEMO Online Education Application.
 * (c) Tarantsova Mariia <yashuk803@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Lesson;

use App\Entity\Lesson;

class LessonMapper
{
    public static function entityToModel(Lesson $entity): LessonModel
    {
        $model = new LessonModel(
            $entity->getId(),
            $entity->getName(),
            $entity->getCreatedAt(),
            $entity->getCourse()->getId()

        );

        $model->setDescription($entity->getDescription());
        $model->setVideo($entity->getVideo());
        $model->setVideoFile($entity->getVideoFile());

        return $model;
    }
}
