<?php
namespace App\Course;
use App\Entity\Course;
final class CourseMapper
{
    public static function entityToModel(Course $entity): CourseModel
    {
        $model = new CourseModel(
            $entity->getId(),
            $entity->getAccessType(),
            $entity->getCost(),
            $entity->getName(),
            $entity->getPublicationDate()

        );
        $model->setDescription($entity->getDescription());
        return $model;

    }
}
