<?php

namespace App\User\Service;

use App\User\Collection;
use App\User\UserModel;

interface UserPresentationServiceInterface
{
    public function getAll(): Collection;

    public function findByUser($id): UserModel;
}
