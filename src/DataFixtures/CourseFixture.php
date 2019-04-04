<?php

namespace App\DataFixtures;

use App\Entity\Course;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;
use Symfony\Component\Finder\Finder;

class CourseFixture extends BaseFixture implements DependentFixtureInterface
{
    private $parametrBag;

    public function __construct(ContainerBagInterface $parameterBag)
    {
        $this->parametrBag = $parameterBag;
    }

    protected function loadData(ObjectManager $manager)
    {
        $this->createMany(10, 'course', function () {
            $course = new Course();

            $video = $this->getFakeVideoFiles();
            $faker = \Faker\Factory::create();

            $nVideo = $faker->numberBetween(0, (\count($video)-1));
            $user = $this->getRandomReference(UserFixture::USER_REFERENCE);
            $course->setVideo($video[$nVideo]);

            $course->setUser($user);

            $course->setShortDescription($faker->sentence(50));
            $course->setDescription($faker->sentence(50));
            $course->setName($faker->sentence(2));
            $course->setCost($faker->randomFloat());

            return $course;
        });

        $manager->flush();
    }

    private function getFakeVideoFiles()
    {
        $basePath =  $this->parametrBag->get('kernel.project_dir');

        $finder = new Finder();

        $finder->files()->name('*.mp4')->in($basePath . '/public/uploads/video');

        foreach ($finder as $file) {
            $fileName[] = $file->getRelativePathname();
        }

        return $fileName;
    }


    public function getDependencies()
    {
        return [
            UserFixture::class,
        ];
    }
}
