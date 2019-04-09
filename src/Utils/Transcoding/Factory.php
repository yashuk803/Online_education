<?php

/*
 * This file is part of Symfony DEMO Online Education Application.
 * (c) Tarantsova Mariia <yashuk803@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Utils\Transcoding;

use FFMpeg\Format\Video\WebM;
use FFMpeg\Format\Video\WMV;
use FFMpeg\Format\Video\X264;

class Factory
{
    public function createFormatWebM()
    {
        return new WebM();
    }

    public function createFormatWMV()
    {
        return new WMV();
    }
    public function createFormatX264()
    {
        return new X264();
    }
}
