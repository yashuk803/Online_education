<?php

namespace App\Lesson\Service;

use App\Lesson\Collection;
use App\Lesson\LessonMapper;
use App\Lesson\LessonModel;
use App\Lesson\Repository\LessonRepositoryInterface;

final class LessonPresentationService implements LessonPresentationServiceInterface
{

    private $lessonRepository;

    public function __construct(LessonRepositoryInterface $lessonRepository)
    {
        $this->lessonRepository = $lessonRepository;
    }

    public function getAll(): Collection
    {
        $lessons = $this->lessonRepository->findAll();
        $collection = new Collection();

        foreach ($lessons as $course) {
            $collection->addLesson(
                LessonMapper::entityToModel($course)
            );
        }

        return $collection;
    }

    public function findByCourse($id): LessonModel
    {
        $courses = $this->lessonRepository->findByCourse($id);

        return   LessonMapper::entityToModel($courses);
    }
}
