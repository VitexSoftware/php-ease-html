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
 * Html element for a button.
 */
class ButtonTag extends PairTag
{
    /**
     * Html element for a button.
     *
     * @param mixed $content    button content
     * @param array $properties button tag properties
     */
    public function __construct($content, $properties = [])
    {
        parent::__construct('button', $properties, $content);
    }
}
