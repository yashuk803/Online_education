<?php

/*
 * This file is part of Symfony DEMO Online Education Application.
 * (c) Tarantsova Mariia <yashuk803@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Lesson\Service;

use App\Course\Repository\CourseRepositoryInterface;
use App\Entity\Lesson;
use App\Lesson\FormLessonModel;
use App\Lesson\Repository\LessonRepositoryInterface;
use App\Service\File\FileManagerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\File\File;

final class LessonManagementService implements LessonManagementServiceInterface
{
    private $lessonRepository;
    private $params;
    private $fileManager;
    private $courseRepository;

    public function __construct(
        LessonRepositoryInterface $lessonRepository,
        ParameterBagInterface $params,
        FileManagerInterface $fileManager,
        CourseRepositoryInterface $courseRepository
    ) {
        $this->lessonRepository = $lessonRepository;
        $this->courseRepository = $courseRepository;
        $this->params = $params;
        $this->fileManager = $fileManager;
    }

    public function setData(Lesson $lesson, FormLessonModel $formLessonModel, bool $transcoding): Lesson
    {
        $course = $this->courseRepository->findById($formLessonModel->getCourse());
        $lesson->setName($formLessonModel->getName());
        $lesson->setCourse($course);
        $lesson->setDescription($formLessonModel->getDescription());

        if ($formLessonModel->getVideoFile()) {
            if ($transcoding) {
                $fileName = $this->fileManager->transcodingUpload(
                    $formLessonModel->getVideoFile(),
                    $this->params->get('app.path.video_path_lessons')
                );
                $lesson->setVideoFile(new File($fileName));
                $lesson->setVideo($fileName);
            } else {
                $lesson->setVideoFile($formLessonModel->getVideoFile());
            }
        }
        $this->lessonRepository->save($lesson);

        return $lesson;
    }
}
