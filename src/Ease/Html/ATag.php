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
 *   @author Vítězslav Dvořák <info@vitexsoftware.cz>, Jana Viktorie Borbina <jana@borbina.com>
 *
 * HTML hyperlink class.
 */
class ATag extends PairTag
{
    /**
     * displays HTML link.
     *
     * @param null|string $href       link url
     * @param mixed       $contents   inserted content
     * @param array       $properties A tag properties
     */
    public function __construct($href, $contents = null, $properties = [])
    {
        if (null !== $href) {
            $properties['href'] = $href;
        }

        parent::__construct('a', $properties, $contents);
    }
}
