<?php

/*
 * This file is part of Symfony DEMO Onlain Education Application.
 * (c) Tarantsova Mariia <yashuk803@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Lesson\Service;

use App\Lesson\Collection;
use App\Lesson\LessonModel;

interface LessonPresentationServiceInterface
{
    public function getAll(): Collection;

    public function findByCourse(int $courseId): Collection;

    public function findById(int $id): LessonModel;
}
