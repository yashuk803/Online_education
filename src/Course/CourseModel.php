<?php

namespace App\Course;

use Vich\UploaderBundle\Entity\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Class CourseModel
 *
 * @Vich\Uploadable
 */
final class CourseModel
{
    private $id;
    private $name;
    private $description;
    private $accessType;
    private $cost;
    private $publicationDate;
    private $shortDescription;
    private $user;
    private $video;
    private $videoFile;

    public function __construct(
        int $id,
        string $name,
        float $cost,
        bool $accessType,
        \DateTimeInterface $publicationDate,
        int $user
    ) {
        $this->id = $id;
        $this->cost = $cost;
        $this->name = $name;
        $this->accessType = $accessType;
        $this->publicationDate = $publicationDate;
        $this->user = $user;
    }
    public function getId(): int
    {
        return $this->id;
    }
    public function getCost(): string
    {
        return $this->cost;
    }
    public function getName(): string
    {
        return $this->name;
    }
    public function getAccessType(): string
    {
        return $this->accessType;
    }
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }
    public function getDescription(): ?string
    {
        return $this->description;
    }
    public function getPublicationDate(): \DateTimeInterface
    {
        return $this->publicationDate;
    }
    public function setShortDescription(?string $shortDescription): void
    {
        $this->shortDescription = $shortDescription;
    }
    public function getShortDescription(): ?string
    {
        return $this->shortDescription;
    }
    public function getUser()
    {
        return $this->user;
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
