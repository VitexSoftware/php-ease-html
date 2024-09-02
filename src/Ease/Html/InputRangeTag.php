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
 * HTML5 range input tag.
 */
class InputRangeTag extends InputTag implements Input
{
    /**
     * The &lt;input type="range"&gt; defines a control for entering a number whose exact value is not important.
     *
     * @see https://www.w3schools.com/tags/att_input_type_range.asp
     *
     * @param string $name       name
     * @param string $value      initial value
     * @param array  $properties additional input range tag properties min,max,step...
     */
    public function __construct($name, $value = null, $properties = [])
    {
        $properties['type'] = 'range';
        $properties['value'] = $value;
        $properties['name'] = $name;
        parent::__construct($name, $value, $properties);
    }
}
