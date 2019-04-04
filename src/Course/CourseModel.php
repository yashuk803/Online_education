<?php

namespace App\Course;

use Symfony\Component\HttpFoundation\File\File;
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
}
