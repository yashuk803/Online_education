<?php

namespace App\Course;

final class Collection implements \IteratorAggregate
{
    private $courses;
    public function __construct(CourseModel ...$courses)
    {
        $this->courses = $courses;
    }
    public function addCategory(CourseModel $course): void
    {
        $this->courses[] = $course;
    }
    public function getIterator(): iterable
    {
        return new \ArrayIterator($this->courses);
    }
}
