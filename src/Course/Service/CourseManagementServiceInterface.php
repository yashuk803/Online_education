<?php


namespace App\Course\Service;

use App\Course\FormCourseModel;
use App\Entity\Course;

interface CourseManagementServiceInterface
{
    public function setData(Course $course,  FormCourseModel $formCourseModel,  ?string $projectDir): Course;
}
