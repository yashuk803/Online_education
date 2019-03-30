<?php
namespace App\Course\Service;
use App\Course\CourseModel;
use App\Course\Collection;
interface CoursePresentationServiceInterface
{
    public function getAll(): Collection;
}
