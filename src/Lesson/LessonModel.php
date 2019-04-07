<?php

/*
 * This file is part of Symfony DEMO Onlain Education Application.
 * (c) Tarantsova Mariia <yashuk803@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Lesson;

use Vich\UploaderBundle\Entity\File;
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
    private $video;

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

    public function setDescription(?string $description)
    {
        $this->description = $description;
    }

    public function getDescription(): ?string
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
    public function setVideo($video): void
    {
        $this->video = $video;
    }
    public function getVideo(): ?string
    {
        return $this->video;
    }
    public function setVideoFile(File $video = null)
    {
        $this->videoFile = $video;
        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($video) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTimeImmutable();
        }
    }
}
