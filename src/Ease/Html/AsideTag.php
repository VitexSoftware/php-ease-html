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
 * HTML5 Aside tag.
 */
class AsideTag extends PairTag
{
    /**
     * Defines content aside from the page content.
     *
     * @param mixed $content    items included
     * @param array $properties Aside tag properties
     */
    public function __construct($content = null, $properties = [])
    {
        parent::__construct('aside', $properties, $content);
    }
}
