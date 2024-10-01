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
 * iFrame element.
 */
class IframeTag extends PairTag
{
    /**
     * iFrame element.
     *
     * @param string $src        content url
     * @param array  $properties HTML tag proberties
     */
    public function __construct(string $src, $properties = [])
    {
        $properties['src'] = $src;
        parent::__construct('iframe', $properties);
    }
}
