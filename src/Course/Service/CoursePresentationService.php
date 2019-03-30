<?php
namespace App\Course\Service;
use App\Course\CourseMapper;
use App\Course\CourseModel;
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
            $collection->addCategory(
                CourseMapper::entityToModel($course)
            );
        }
        return $collection;
    }
}
