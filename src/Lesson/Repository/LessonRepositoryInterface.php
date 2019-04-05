<?php


namespace App\Lesson\Repository;

interface LessonRepositoryInterface
{
    public function findAll();
    public function findByCourse(int $courseId);
    public function findById(int $id);
}
