<?php

/*
 * This file is part of Symfony DEMO Online Education Application.
 * (c) Tarantsova Mariia <yashuk803@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Course\Service;

use App\Course\FormCourseModel;
use App\Course\Repository\CourseRepositoryInterface;
use App\Entity\Course;

final class CourseManagementService implements CourseManagementServiceInterface
{
    private $courseRepository;

    public function __construct(CourseRepositoryInterface $courseRepository)
    {
        $this->courseRepository = $courseRepository;
    }

    public function setData(Course $course, FormCourseModel $formCourseModel, ?string $projectDir): Course
    {
        $course->setName($formCourseModel->getName());
        $course->setAccessType($formCourseModel->getAccessType());
        $course->setDescription($formCourseModel->getDescription());
        $course->setShortDescription($formCourseModel->getShortDescription());
        $course->setCost($formCourseModel->getCost());
        //  $course->setVideoFile($formCourseModel->getVideoFile());
//        $post->setContent($postType->getContent());
//        if (null === $post->getDateCreation()) {
//            $post->setDateCreation(new \DateTime());
//        }
//        if (null != $postType->getImage()) {
//            if (null != $post->getImage()) {
//                $this->fileManager->deleteImage($post);
//            }
//            $fileName = $this->fileManager->upload($postType->getImage());
//            $post->setImage($fileName);
//        }

        $this->courseRepository->save($course);

        return $course;
    }
}
