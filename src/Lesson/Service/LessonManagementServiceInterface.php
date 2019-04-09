<?php

/*
 * This file is part of Symfony DEMO Online Education Application.
 * (c) Tarantsova Mariia <yashuk803@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Lesson\Service;

use App\Lesson\FormLessonModel;
use App\Entity\Lesson;

interface LessonManagementServiceInterface
{
    public function setData(Lesson $lesson, FormLessonModel $formCourseModel, bool $transcoding): Lesson;
}
