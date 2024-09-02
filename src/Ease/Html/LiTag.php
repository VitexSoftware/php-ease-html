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
 * HTML list item tag class.
 */
class LiTag extends PairTag
{
    /**
     * Simple LI tag.
     *
     * @param mixed $liContents list item content
     * @param array $properties Li tag properties
     */
    public function __construct($liContents = null, $properties = [])
    {
        parent::__construct('li', $properties, $liContents);
    }
}
