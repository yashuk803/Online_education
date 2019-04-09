<?php

/*
 * This file is part of Symfony DEMO Online Education Application.
 * (c) Tarantsova Mariia <yashuk803@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\DataFixtures;

use App\Entity\Course;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;

class CourseFixture extends BaseFixture implements DependentFixtureInterface
{
    const COURSE_REFERENCE = 'course';

    private $sourceDirectory;
    private $targetDirectory;

    public function __construct(ContainerBagInterface $parameterBag)
    {
        $basePath =  $parameterBag->get('kernel.project_dir');

        $this->sourceDirectory = $basePath . '/public/uploads/test_video';
        $this->targetDirectory = $basePath . '/public/uploads/video/courses';
    }


    protected function loadData(ObjectManager $manager)
    {
        $this->createMany(10, self::COURSE_REFERENCE, function () {
            $user = $this->getRandomReference(UserFixture::USER_REFERENCE);

            $course = new Course($user);

            $faker = \Faker\Factory::create();

            $course->setVideo($faker->file($this->sourceDirectory, $this->targetDirectory, false));
            $course->setShortDescription($faker->sentence(50));
            $course->setDescription($faker->sentence(50));
            $course->setName($faker->sentence(2));
            $course->setCost($faker->randomNumber(2));
            $course->setUpdatedAt($this->faker->dateTime);

            return $course;
        });

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixture::class,
        ];
    }
}
