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
 * HTML5 mark tag.
 */
class MarkTag extends PairTag
{
    /**
     * Defines marked/highlighted text.
     *
     * @param mixed $content    items included
     * @param array $properties mark tag properties
     */
    public function __construct($content = null, $properties = [])
    {
        parent::__construct('mark', $properties, $content);
    }
}
