<?php


namespace App\Utils;

use FFMpeg\FFMpeg;
use FFMpeg\Format\FormatInterface;
use FFMpeg\Format\Video\WebM;
use FFMpeg\Format\Video\WMV;
use FFMpeg\Format\Video\X264;
use Symfony\Component\HttpFoundation\File\File;

class Transcoding
{
    const KILOBITRATE = 200;

    const MP4  = '.mp4';
    const WMV  = '.wmv';
    const WEBM = '.webm';

    private $file;
    private $path;
    private $fileName;
    private $format;
    private $expansion;

    public function __construct(File $file, string $path, string $fileName, FormatInterface $format)
    {
        $this->file = $file;
        $this->path = $path;
        $this->fileName = $this->getBaseName($fileName);
        $this->expansion = $this->getExpansion($format);
        $this->format = $format;
    }

    public function saveVideo()
    {
        $this->format->setKiloBitrate(self::KILOBITRATE);

        $ffmpeg = FFMpeg::create();

        $ffmpeg->open($this->file)->save($this->format, $this->path . $this->fileName . self::WEBM);

        return $this->fileName . self::WEBM;
    }

    private function getBaseName($fileName)
    {
        $list = \explode('.', $fileName);

        return $list[0];
    }
    private function getExpansion($format)
    {
        if ($format instanceof WebM) {
            return new WebM();
        }

        if ($format instanceof X264) {
            return new X264();
        }

        if ($format instanceof WMV) {
            return new WMV();
        }

        return new X264();
    }
}
