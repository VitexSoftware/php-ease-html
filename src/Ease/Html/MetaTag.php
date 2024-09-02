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
 * HTML meta tag.
 */
class MetaTag extends Tag
{
    /**
     * Describe metadata within an HTML document.
     *
     * @param string $name       meta property name
     * @param string $content    meta property value
     * @param array  $properties other html tag properties
     */
    public function __construct($name = null, $content = null, $properties = [])
    {
        if (null !== $name) {
            $properties['name'] = $name;
        }

        if (null !== $content) {
            $properties['content'] = $content;
        }

        parent::__construct('meta', $properties);
    }
}
