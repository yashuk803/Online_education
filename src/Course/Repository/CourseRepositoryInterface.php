<?php

/*
 * This file is part of Symfony DEMO Onlain Education Application.
 * (c) Tarantsova Mariia <yashuk803@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Course\Repository;

use App\Entity\Course;

interface CourseRepositoryInterface
{
    public function findAll();

    public function findByUser($userId);

    public function findById($id);

    public function findFiveLastCourse();

    public function save(Course $course): void;
}
