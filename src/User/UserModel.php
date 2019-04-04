<?php

namespace App\User;

use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Class CourseModel
 *
 * @Vich\Uploadable
 */
final class UserModel
{
    private $id;
    private $email;
    private $roles;
    private $password;
    private $firstName;
    private $imageName;
    private $town;
    private $bio;
    private $about;
    private $lastName;
    private $slug;
    private $courses;
    private $createdAt;

    public function __construct(
        int $id,
        string $email,
        array $roles,
        string $password,
        \DateTimeInterface $createdAt
    ) {
        $this->id = $id;
        $this->email = $email;
        $this->roles = $roles;
        $this->password = $password;
        $this->createdAt = $createdAt;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
    public function getRoles(): array
    {
        return $this->roles;
    }
    public function getPassword(): string
    {
        return $this->password;
    }
    public function getCreatedAt(): \DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setFirstName(?string $firstName): void
    {
        $this->firstName = $firstName;
    }
    public function getFirstName(): ?string
    {
        return $this->firstName;
    }
}
