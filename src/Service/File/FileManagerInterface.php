<?php

/*
 * This file is part of Symfony DEMO Online Education Application.
 * (c) Tarantsova Mariia <yashuk803@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Service\File;

use Symfony\Component\HttpFoundation\File\UploadedFile;

interface FileManagerInterface
{
    public function transcodingUpload(UploadedFile $file, string $path): string;
}
