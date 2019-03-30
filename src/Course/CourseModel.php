<?php

namespace App\Course;
final class CourseModel
{
    private $id;
    private $name;
    private $description;
    private $accessType;
    private $cost;
    private $publicationDate;

    public function __construct(
        int $id,
        string $name,
        float $cost,
        bool $accessType,
        \DateTimeInterface $publicationDate
    )
    {
        $this->id = $id;
        $this->cost = $cost;
        $this->name = $name;
        $this->accessType = $accessType;
        $this->publicationDate = $publicationDate;
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
    public function setDescription(string $description): void
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
}
