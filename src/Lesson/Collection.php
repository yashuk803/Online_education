<?php


namespace App\Lesson;

use App\Lesson\LessonModel;

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
