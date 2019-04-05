<?php


namespace App\Lesson\Repository;

use App\Lesson\Collection;

interface LessonRepositoryInterface
{
    public function findAll();
    public function findByCourse(int $courseId);
    public function findById(int $id);
}
