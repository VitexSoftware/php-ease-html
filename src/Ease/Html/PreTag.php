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
 * Reformatted text.
 */
class PreTag extends PairTag
{
    /**
     * Reformatted text.
     *
     * @param mixed|string $content    tag content
     * @param array        $properties pre tag properties
     */
    public function __construct($content = null, $properties = null)
    {
        parent::__construct('pre', $properties, $content);
    }
}
