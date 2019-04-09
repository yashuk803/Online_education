<?php

/*
 * This file is part of Symfony DEMO Online Education Application.
 * (c) Tarantsova Mariia <yashuk803@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Service\File;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use App\Utils\Transcoding\Factory;
use App\Utils\Transcoding\Transcoding;

class FileManager implements FileManagerInterface
{
    private $fileName;

    public function __construct(FileNameInterface $fileName)
    {
        $this->fileName = $fileName;
    }

    public function transcodingUpload(UploadedFile $file, string $path): string
    {
        $baseName = $this->fileName->getBaseName($file->getClientOriginalName());

        $trascodingFactory = new Factory();

        $fileName = new Transcoding($file, $path, $baseName, $trascodingFactory->createFormatWMV());

        return $fileName->saveVideo();
    }
}
