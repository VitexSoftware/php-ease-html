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
 * HtmlParam tag.
 */
class ParamTag extends Tag
{
    /**
     * Paramm tag.
     *
     * @param string $name  tag name
     * @param string $value tag value
     */
    public function __construct($name, $value)
    {
        parent::__construct('param', ['name' => $name, 'value' => $value]);
    }
}
