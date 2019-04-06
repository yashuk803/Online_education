<?php


namespace App\Course\Repository;

interface CourseRepositoryInterface
{
    public function findAll();

    public function findByUser($userId);

    public function findById($id);

    public function findFiveLastCourse();
}
