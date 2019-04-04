<?php

namespace App\User;

final class Collection implements \IteratorAggregate
{
    private $users;
    public function __construct(UserModel ...$users)
    {
        $this->users = $users;
    }
    public function addCourse(UserModel $user): void
    {
        $this->users[] = $user;
    }
    public function getIterator(): iterable
    {
        return new \ArrayIterator($this->users);
    }
}
