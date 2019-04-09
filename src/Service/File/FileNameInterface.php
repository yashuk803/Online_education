<?php

/*
 * This file is part of Symfony DEMO Online Education Application.
 * (c) Tarantsova Mariia <yashuk803@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Service\File;

interface FileNameInterface
{
    /**
     * Returns file without extension
     *
     * @param string $originName
     *
     * @return string
     */
    public function getBaseName(string $originName): string;
}
