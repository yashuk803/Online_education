<?php

/*
 * This file is part of Symfony DEMO Online Education Application.
 * (c) Tarantsova Mariia <yashuk803@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Course;

use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class CourseModel
 *
 * @Vich\Uploadable
 */
final class FormCourseModel
{
    private $name;
    private $description;
    private $accessType;
    private $cost;
    private $shortDescription;

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
     * @var File
     */
    private $videoFile;

    private $video;


    public function getVideo()
    {
        return $this->video;
    }
    public function setVideo($video): void
    {
        $this->video = $video;
    }
    public function getCost()
    {
        return $this->cost;
    }
    public function setCost($cost): void
    {
        $this->cost = $cost;
    }
    public function getName()
    {
        return $this->name;
    }
    public function setName($name): void
    {
        $this->name = $name;
    }
    public function getAccessType()
    {
        return $this->accessType;
    }
    public function setAccessType($accessType): void
    {
        $this->accessType = $accessType;
    }
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }
    public function getDescription()
    {
        return $this->description;
    }
    public function setShortDescription(?string $shortDescription): void
    {
        $this->shortDescription = $shortDescription;
    }
    public function getShortDescription()
    {
        return $this->shortDescription;
    }
    public function setVideoFile(File $video = null)
    {
        $this->videoFile = $video;
    }
    public function getVideoFile()
    {
        return $this->videoFile;
    }
}
