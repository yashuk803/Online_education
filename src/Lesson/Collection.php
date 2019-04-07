<?php

/*
 * This file is part of Symfony DEMO Online Education Application.
 * (c) Tarantsova Mariia <yashuk803@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Lesson;

final class Collection implements \IteratorAggregate
{
    private $lesson;

    public function __construct(LessonModel ...$lesson)
    {
        $this->lesson = $lesson;
    }
    public function addLesson(LessonModel $lesson): void
    {
        $this->lesson[] = $lesson;
    }
    public function getIterator(): iterable
    {
        return new \ArrayIterator($this->lesson);
    }
}
