<?php

/*
 * This file is part of Symfony DEMO Online Education Application.
 * (c) Tarantsova Mariia <yashuk803@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Course;

use Vich\UploaderBundle\Entity\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

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
    private $videoFile;


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
