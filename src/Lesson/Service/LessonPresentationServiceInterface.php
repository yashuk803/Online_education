<?php


namespace App\Lesson\Service;


use App\Lesson\Collection;
use App\Lesson\LessonModel;

interface LessonPresentationServiceInterface
{
    public function getAll(): Collection;

    public function findByCourse($id): LessonModel;
}
