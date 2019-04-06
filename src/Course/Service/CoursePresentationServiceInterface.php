<?php

namespace App\Course\Service;

use App\Course\Collection;

interface CoursePresentationServiceInterface
{
    public function getAll(): Collection;

    public function findByUser($userId): Collection;

    public function findById($id);

    public function getLastFiveCourses(): Collection;
}
