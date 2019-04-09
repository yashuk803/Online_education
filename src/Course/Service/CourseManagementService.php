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
use App\Service\File\FileManagerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\File\File;

final class CourseManagementService implements CourseManagementServiceInterface
{
    private $courseRepository;
    private $params;
    private $fileManager;

    public function __construct(
        CourseRepositoryInterface $courseRepository,
        ParameterBagInterface $params,
        FileManagerInterface $fileManager
    ) {
        $this->courseRepository = $courseRepository;
        $this->params = $params;
        $this->fileManager = $fileManager;
    }

    public function setData(Course $course, FormCourseModel $formCourseModel, bool $transcoding): Course
    {
        $course->setName($formCourseModel->getName());
        $course->setAccessType($formCourseModel->getAccessType());
        $course->setDescription($formCourseModel->getDescription());
        $course->setShortDescription($formCourseModel->getShortDescription());
        $course->setCost($formCourseModel->getCost());


        if ($formCourseModel->getVideoFile()) {
            if ($transcoding) {
                $fileName = $this->fileManager->transcodingUpload(
                    $formCourseModel->getVideoFile(),
                    $this->params->get('app.path.video_path_courses')
                );
                $course->setVideoFile(new File($fileName));
                $course->setVideo($fileName);
            } else {
                $course->setVideoFile($formCourseModel->getVideoFile());
            }
        }
        $this->courseRepository->save($course);

        return $course;
    }
}
