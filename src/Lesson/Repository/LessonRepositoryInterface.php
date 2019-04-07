<?php

/*
 * This file is part of Symfony DEMO Online Education Application.
 * (c) Tarantsova Mariia <yashuk803@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Lesson\Repository;

interface LessonRepositoryInterface
{
    public function findAll();
    public function findByCourse(int $courseId);
    public function findById(int $id);
}
