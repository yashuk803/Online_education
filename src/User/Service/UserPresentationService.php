<?php

/*
 * This file is part of Symfony DEMO Online Education Application.
 * (c) Tarantsova Mariia <yashuk803@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\User\Service;

use App\User\UserMapper;
use App\User\Collection;
use App\User\UserModel;
use App\User\Repository\UserRepositoryInterface;

final class UserPresentationService implements UserPresentationServiceInterface
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function getAll(): Collection
    {
        $courses = $this->userRepository->findAll();
        $collection = new Collection();

        foreach ($courses as $course) {
            $collection->addCourse(
                UserMapper::entityToModel($course)
            );
        }

        return $collection;
    }

    public function findByUser($id): UserModel
    {
        $courses = $this->userRepository->findByUser($id);


        return UserMapper::entityToModel($courses);
    }
}
