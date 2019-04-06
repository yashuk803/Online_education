<?php

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
