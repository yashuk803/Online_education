<?php

/*
 * This file is part of Symfony DEMO Online Education Application.
 * (c) Tarantsova Mariia <yashuk803@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Tests\Controller;

use App\Entity\Course;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class CourseControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();
        $client->request('GET', '/courses');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

//    public function testCreate()
//    {
//        $faker = \Faker\Factory::create();
//        $courseName = 'Course Post Title ' . \mt_rand();
//        $courseDescription = $faker->sentence(20);
//        $courseShortDescription = $faker->sentence(50);
//
//        $client = static::createClient([], [
//            'PHP_AUTH_USER' => 'spacebar0@example.com',
//            'PHP_AUTH_PW' => 'plainPassword',
//        ]);
//
//        $crawler = $client->request('GET', '/new-course');
//
//        $form = $crawler->selectButton('сохронить')->form([
//            'course_form[name]' => $courseName,
//            'course_form[shortDescription]' => $courseShortDescription,
//            'course_form[description]' => $courseDescription,
//            'course_form[accessType]' => 0,
//            'course_form[cost]' => 20,
//        ]);
//
//        $client->submit($form);
//
//        $this->assertSame(Response::HTTP_FOUND, $client->getResponse()->getStatusCode());
//        $course = $client->getContainer()->get('doctrine')->getRepository(Course::class)->findOneBy([
//            'name' => $courseName,
//        ]);
//        $this->assertNotNull($course);
//        $this->assertSame($courseDescription, $course->getDescription());
//        $this->assertSame($courseShortDescription, $course->getShortDescription());
//    }
}
