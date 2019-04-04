<?php

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
        $model->setVideoFile($entity->getVideoFile());

        return $model;
    }
}
