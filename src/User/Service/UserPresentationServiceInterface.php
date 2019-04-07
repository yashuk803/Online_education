<?php

/*
 * This file is part of Symfony DEMO Online Education Application.
 * (c) Tarantsova Mariia <yashuk803@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\User\Service;

use App\User\Collection;
use App\User\UserModel;

interface UserPresentationServiceInterface
{
    public function getAll(): Collection;

    public function findByUser($id): UserModel;
}
