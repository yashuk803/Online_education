<?php


namespace App\Lesson;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @Vich\Uploadable
 */
class LessonModel
{
    private $id;
    private $name;
    private $description;
    private $createdAt;
    private $course;

    public function __construct(
        int $id,
        string $name,
        \DateTimeInterface $createdAt,
        int $course
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->createdAt = $createdAt;
        $this->course = $course;
    }

    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getId(): int
    {
        return $this->id;
    }
    public function getName(): string
    {
        return $this->name;
    }
    public function getCourses(): int
    {
        return $this->course;
    }
    public function getCreatedAt(): \DateTimeInterface
    {
        return $this->createdAt;
    }
}
