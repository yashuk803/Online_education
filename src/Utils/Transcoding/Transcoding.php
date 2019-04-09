<?php

/*
 * This file is part of Symfony DEMO Online Education Application.
 * (c) Tarantsova Mariia <yashuk803@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Utils\Transcoding;

use FFMpeg\FFMpeg;
use FFMpeg\Format\FormatInterface;
use FFMpeg\Format\Video\WebM;
use FFMpeg\Format\Video\WMV;
use FFMpeg\Format\Video\X264;
use Symfony\Component\HttpFoundation\File\File;

/**
 * This class helper fo transcoding video file in
 * other format (WebM, WMV, X264).
 *
 * @author Mariia Tarantsova <yashuk803@gmail.com>
 */
class Transcoding
{
    const KILOBITRATE = 200;

    private const MP4  = '.mp4';
    private const WMV  = '.wmv';
    private const WEBM = '.webm';

    /**
     * A file in the file system.
     *
     * @var File
     */
    private $file;

    /**
     * Path where need save video file
     *
     * @var string
     */
    private $path;

    /*
     * @var string
     */
    private $fileName;

    /**
     *
     * @var FormatInterface
     */
    private $format;

    /**
     * @var WebM|WMV|X264
     */
    private $expansion;

    public function __construct(
        File $file,
        string $path,
        string $fileName,
        FormatInterface $format
    ) {
        $this->file = $file;
        $this->path = $path;
        $this->fileName = $fileName;
        $this->expansion = $this->getExpansion($format);
        $this->format = $format;
        $this->setKiloBitrate(self::KILOBITRATE);
    }

    /**
     * Transcode videos using the FFMpeg\Media\Video:save method.
     * Returns the name of the file with the desired extension.
     *
     * @return string
     */
    public function saveVideo(): string
    {
        $ffmpeg = FFMpeg::create();

        $ffmpeg->open($this->file)->save($this->format, $this->path . $this->fileName . self::WEBM);

        return $this->fileName . self::WEBM;
    }


    /**
     *  Return expansion format file.
     *
     * @param FormatInterface $format
     *
     * @return string
     */
    public function getExpansion(FormatInterface $format): string
    {
        $exp = '';

        if ($format instanceof WebM) {
            $exp =  self::WEBM;
        } elseif ($format instanceof X264) {
            $exp =  self::MP4;
        } elseif ($format instanceof WMV) {
            $exp = self::WMV;
        } else {
            $exp = self::MP4;
        }

        return $exp;
    }

    public function setKiloBitrate($kilobitrate)
    {
        $this->format->setKiloBitrate($kilobitrate);
    }

    public function getKiloBitrate()
    {
        return $this->format->getKiloBitrate();
    }
}
