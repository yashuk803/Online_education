<?php


namespace App\Lesson\Service;

use App\Lesson\Collection;
use App\Lesson\LessonModel;

interface LessonPresentationServiceInterface
{
    public function getAll(): Collection;

    public function findByCourse(int $courseId): Collection;

    public function findById(int $id): LessonModel;
}
