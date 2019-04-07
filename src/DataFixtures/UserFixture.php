<?php

/*
 * This file is part of Symfony DEMO Online Education Application.
 * (c) Tarantsova Mariia <yashuk803@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixture extends BaseFixture
{
    public const USER_REFERENCE = 'user';
    public const ADMIN_REFERENCE = 'admin';

    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    protected function loadData(ObjectManager $manager)
    {
        $this->createMany(10, self::USER_REFERENCE, function ($i) {
            $user = new User();

            $email = \sprintf('spacebar%d@example.com', $i);
            $slug = \explode('@', $email);

            $user->setFirstName($this->faker->userName);
            $user->setSlug('@' . $slug[0]);
            $user->setEmail($email);
            $user->setCreatedAt($this->faker->dateTime);
            $user->setUpdatedAt($this->faker->dateTime);

            $user->setPassword($this->passwordEncoder->encodePassword(
                $user,
                'plainPassword'
            ));

            return $user;
        });


        $this->createMany(2, self::ADMIN_REFERENCE, function ($i) {
            $user = new User();
            $user->setRoles(['ROLE_ADMIN']);
            $email = \sprintf('admin%d@thespacebar.com', $i);
            $slug = \explode('@', $email);

            $user->setEmail($email);
            $user->setSlug('@' . $slug[0]);
            $user->setCreatedAt($this->faker->dateTime);
            $user->setUpdatedAt($this->faker->dateTime);
            $user->setPassword($this->passwordEncoder->encodePassword(
                $user,
                'plainPassword'
            ));

            return $user;
        });

        $manager->flush();
    }
}
