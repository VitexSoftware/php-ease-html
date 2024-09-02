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
 * Horizontal line tag.
 */
class HrTag extends Tag
{
    /**
     * Horizontal line tag.
     *
     * @param array $properties tag parameters
     */
    public function __construct($properties = [])
    {
        parent::__construct('hr', $properties);
    }
}
