<?php

/*
 * This file is part of Symfony DEMO Onlain Education Application.
 * (c) Tarantsova Mariia <yashuk803@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Course;

final class Collection implements \IteratorAggregate
{
    private $courses;

    public function __construct(CourseModel ...$courses)
    {
        $this->courses = $courses;
    }
    public function addCourse(CourseModel $course): void
    {
        $this->courses[] = $course;
    }
    public function getIterator(): iterable
    {
        return new \ArrayIterator($this->courses);
    }
}
