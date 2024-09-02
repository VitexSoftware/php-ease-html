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
 * HTML5 output tag.
 */
class OutputTag extends PairTag
{
    /**
     * Defines the result of a calculation.
     *
     * @param mixed $content    items included
     * @param array $properties output tag properties
     */
    public function __construct($content = null, $properties = [])
    {
        parent::__construct('output', $properties, $content);
    }
}
