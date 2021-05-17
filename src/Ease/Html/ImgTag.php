<?php

namespace Ease\Html;

/**
 * IMG tag class.
 *
 * @author     Vitex <vitex@hippy.cz>
 */
class ImgTag extends Tag {

    /**
     * Html Obrazek.
     * Html Image.
     *
     * @param string $image         image URL
     * @param string $alt           alternat name for text only browsers
     * @param array  $tagProperties IMG tag properties
     */
    public function __construct($image, $alt = null, $tagProperties = []) {
        $tagProperties['src'] = $image;
        if (isset($alt)) {
            $tagProperties['alt'] = $alt;
        }
        parent::__construct('img', $tagProperties);
    }

    /**
     * Generate base64 for img src from file
     * 
     * @param string $imgFileName source image path 
     * 
     * @return string
     */
    public static function fileBase64src($imgFileName) {
        return self::base64src(file_get_contents($imgFileName), mime_content_type($imgFileName));
    }

    /**
     * Convert 
     * 
     * @param string $imgRawData   raw image data
     * @param string $contentType  mime type eg. image/gif
     * 
     * @return type
     */
    public static function base64src($imgRawData, $contentType) {
        return 'data: ' . $contentType . ';base64,' . base64_encode($imgRawData);
    }

}
