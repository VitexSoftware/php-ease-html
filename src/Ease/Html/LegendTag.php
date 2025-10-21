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
 *  @author Vítězslav Dvořák <info@vitexsoftware.cz>
 *
 * HTML legend tag.
 */
class LegendTag extends PairTag
{
    /**
     * Legend Tag for fieldset caption.
     *
     * @param mixed $content    inserted content
     * @param array $properties legend tag properties
     */
    public function __construct($content = null, $properties = [])
    {
        parent::__construct('legend', $properties, $content);
    }
}
