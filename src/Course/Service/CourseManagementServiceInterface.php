<?php

/*
 * This file is part of Symfony DEMO Online Education Application.
 * (c) Tarantsova Mariia <yashuk803@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Course\Service;

use App\Course\FormCourseModel;
use App\Entity\Course;

interface CourseManagementServiceInterface
{
    public function setData(Course $course, FormCourseModel $formCourseModel, ?string $projectDir): Course;
}
