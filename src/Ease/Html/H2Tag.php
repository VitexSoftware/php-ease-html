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
 * HTML H2 tag.
 */
class H2Tag extends PairTag
{
    /**
     * H2 Tag.
     *
     * @param mixed $content    inserted content
     * @param array $properties h2 tag propoerties
     */
    public function __construct($content = '', $properties = [])
    {
        parent::__construct('h2', $properties, $content);
    }
}
