<?php

/*
 * This file is part of Symfony DEMO Online Education Application.
 * (c) Tarantsova Mariia <yashuk803@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Lesson;

use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @Vich\Uploadable
 */
final class FormLessonModel
{
    private $name;
    private $description;
    /**
     * @Assert\File(
     * maxSize = "500M",
     * mimeTypes = {"video/mpeg", "video/mp4", "video/quicktime", "video/x-ms-wmv", "video/x-msvideo", "video/x-flv", "video/ogv"},
     * mimeTypesMessage = "ce format de video est inconnu",
     * uploadIniSizeErrorMessage = "uploaded file is larger than the upload_max_filesize PHP.ini setting",
     * uploadFormSizeErrorMessage = "uploaded file is larger than allowed by the HTML file input field",
     * uploadErrorMessage = "uploaded file could not be uploaded for some unknown reason",
     * maxSizeMessage = "fichier trop volumineux"
     * )
     * @Vich\UploadableField(mapping="video_courses", fileNameProperty="video")
     *
     * @var \Symfony\Component\HttpFoundation\File\File
     */
    private $videoFile;
    private $course;
    private $video;

    public function getCourse()
    {
        return $this->course;
    }
    public function setCourse($course): void
    {
        $this->course = $course;
    }

    public function getName()
    {
        return $this->name;
    }
    public function setName($name): void
    {
        $this->name = $name;
    }
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }
    public function getDescription()
    {
        return $this->description;
    }
    public function setVideoFile(File $video = null)
    {
        $this->videoFile = $video;
    }
    public function getVideoFile()
    {
        return $this->videoFile;
    }
    public function setVideo($video): void
    {
        $this->video = $video;
    }
    public function getVideo(): ?string
    {
        return $this->video;
    }
}
