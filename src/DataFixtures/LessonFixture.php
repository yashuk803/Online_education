<?php

/*
 * This file is part of Symfony DEMO Online Education Application.
 * (c) Tarantsova Mariia <yashuk803@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\DataFixtures;

use App\Entity\Lesson;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;

class LessonFixture extends BaseFixture implements DependentFixtureInterface
{
    const COURSE_LESSON = 'lesson';

    private $sourceDirectory;
    private $targetDirectory;

    public function __construct(ContainerBagInterface $parameterBag)
    {
        $basePath =  $parameterBag->get('kernel.project_dir');

        $this->sourceDirectory = $basePath . '/public/uploads/test_video';
        $this->targetDirectory = $basePath . '/public/uploads/video/lessons';
    }

    protected function loadData(ObjectManager $manager)
    {
        $this->createMany(10, self::COURSE_LESSON, function () {
            $course = $this->getRandomReference(CourseFixture::COURSE_REFERENCE);
            $lesson = new Lesson();
            $lesson->setCourse($course);

            $faker = \Faker\Factory::create();

            $lesson->setVideo($faker->file($this->sourceDirectory, $this->targetDirectory, false));
            $lesson->setDescription($faker->sentence(5));
            $lesson->setName($faker->sentence(2));
            $lesson->setCreatedAt($this->faker->dateTime);
            $lesson->setUpdatedAt($this->faker->dateTime);

            return $lesson;
        });

        $manager->flush();
    }

    /**
     * This method must return an array of fixtures classes
     * on which the implementing class depends on
     *
     * @return array
     */
    public function getDependencies()
    {
        return [
            CourseFixture::class,
        ];
    }
}
