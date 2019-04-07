<?php

/*
 * This file is part of Symfony DEMO Online Education Application.
 * (c) Tarantsova Mariia <yashuk803@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

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

    public function findByCourse(int $courseId): Collection
    {
        $lessons = $this->lessonRepository->findByCourse($courseId);

        $collection = new Collection();

        foreach ($lessons as $course) {
            $collection->addLesson(
                LessonMapper::entityToModel($course)
            );
        }

        return $collection;
    }

    public function findById(int $id): LessonModel
    {
        $lesson = $this->lessonRepository->findById($id);

        return   LessonMapper::entityToModel($lesson);
    }
}
