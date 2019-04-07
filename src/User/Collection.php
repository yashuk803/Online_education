<?php

/*
 * This file is part of Symfony DEMO Onlain Education Application.
 * (c) Tarantsova Mariia <yashuk803@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

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
