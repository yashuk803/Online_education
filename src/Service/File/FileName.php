<?php

/*
 * This file is part of Symfony DEMO Online Education Application.
 * (c) Tarantsova Mariia <yashuk803@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Service\File;

class FileName implements FileNameInterface
{
    /**
     * {@inheritdoc}
     */
    public function getBaseName(string $originName): string
    {
        $name = \explode('.', $originName);

        return $name[0];
    }
}
