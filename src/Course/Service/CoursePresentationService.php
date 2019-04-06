<?php

namespace App\Course\Service;

use App\Course\CourseMapper;
use App\Course\Collection;
use App\Course\Repository\CourseRepositoryInterface;

final class CoursePresentationService implements CoursePresentationServiceInterface
{
    private $courseRepository;

    public function __construct(CourseRepositoryInterface $courseRepository)
    {
        $this->courseRepository = $courseRepository;
    }
    public function getAll(): Collection
    {
        $courses = $this->courseRepository->findAll();
        $collection = new Collection();

        foreach ($courses as $course) {
            $collection->addCourse(
                CourseMapper::entityToModel($course)
            );
        }

        return $collection;
    }

    public function findByUser($userId): Collection
    {
        $courses = $this->courseRepository->findByUser($userId);

        $collection = new Collection();

        foreach ($courses as $course) {
            $collection->addCourse(
                CourseMapper::entityToModel($course)
            );
        }

        return $collection;
    }

    public function findById($id)
    {
        $courses = $this->courseRepository->findById($id);

        return   CourseMapper::entityToModel($courses);
    }

    public function getLastFiveCourses(): Collection
    {
        $courses = $this->courseRepository->findFiveLastCourse();

        $collection = new Collection();

        foreach ($courses as $course) {
            $collection->addCourse(
                CourseMapper::entityToModel($course)
            );
        }

        return $collection;
    }
}
