<?php

/*
 * This file is part of Symfony DEMO Online Education Application.
 * (c) Tarantsova Mariia <yashuk803@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Course\Service;

use App\Course\Collection;

interface CoursePresentationServiceInterface
{
    public function getAll(): Collection;

    public function findByUser($userId): Collection;

    public function findById($id);

    public function getLastFiveCourses(): Collection;
}
