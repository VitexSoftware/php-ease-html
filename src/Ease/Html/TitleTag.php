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
 * HTML title class.
 */
class TitleTag extends PairTag
{
    /**
     * Title html tag.
     *
     * @param string $contents   caption content
     * @param array  $properties title tag properties
     */
    public function __construct($contents = null, $properties = [])
    {
        parent::__construct('title', $properties, $contents);
    }
}
