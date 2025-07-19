<?php

declare(strict_types=1);

/**
 * This file is part of the EaseHtml package
 *
 * https://github.com/VitexSoftware/php-ease-html
 *
 * (c) Vítězslav Dvořák <http://vitexsoftware.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ease\Html;

/**
 *  @author Vítězslav Dvořák <info@vitexsoftware.cz>, Jana Viktorie Borbina <jana@borbina.com>
 *
 * IMG tag class.
 */
class ImgTag extends Tag
{
    /**
     * Html Image.
     *
     * @param string $image      image URL
     * @param string $alt        alternate name for text only browsers
     * @param array  $properties IMG tag properties
     */
    public function __construct(string $image, string $alt = '', array $properties = [])
    {
        $properties['src'] = $image;

        if (empty($alt) === false) {
            $properties['alt'] = $alt;
        }

        parent::__construct('img', $properties);
    }

    /**
     * Generate base64 for img src from file.
     *
     * @param string $imgFileName source image path
     */
    public static function fileBase64src(string $imgFileName): string
    {
        return self::base64src(file_get_contents($imgFileName), mime_content_type($imgFileName));
    }

    /**
     * Convert.
     *
     * @param string $imgRawData  raw image data
     * @param string $contentType mime type eg. image/gif
     */
    public static function base64src(string $imgRawData, string $contentType): string
    {
        return 'data: '.$contentType.';base64,'.base64_encode($imgRawData);
    }
}
