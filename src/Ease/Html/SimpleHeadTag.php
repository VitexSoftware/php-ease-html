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
 * Siple HTML head tag class.
 */
class SimpleHeadTag extends PairTag
{
    /**
     * Content type of webpage.
     */
    public static string $contentType = 'text/html';

    /**
     * Content Charset.
     */
    public string $charSet = 'utf-8';

    /**
     * head tag with defined meta http-equiv content type.
     *
     * @param mixed $contents   inserted content
     * @param array $properties simple head tag properties
     */
    public function __construct($contents = null, $properties = [])
    {
        parent::__construct('head', $properties, $contents);
        $this->addItem('<meta http-equiv="Content-Type" content="' . self::$contentType . '; charset=' . $this->charSet . '" />');
    }
}
