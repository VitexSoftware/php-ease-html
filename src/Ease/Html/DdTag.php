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
 * Definition content.
 */
class DdTag extends PairTag
{
    /**
     * Definition content.
     *
     * @param mixed|string $content    content included
     * @param array        $properties Dd tag properties
     */
    public function __construct($content = null, $properties = null)
    {
        parent::__construct('dd', $properties, $content);
    }
}
