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
 * HTML5 datetime input tag.
 */
class InputDateTimeTag extends InputTag implements Input
{
    /**
     * The <input type="date"> is used for input fields that should contain a date and time.
     *
     * @param string $name       name
     * @param string $value      initial value
     * @param array  $properties additional input time tag properties
     */
    public function __construct($name, $value = null, $properties = [])
    {
        $properties['type'] = 'datetime';
        $properties['value'] = $value;
        $properties['name'] = $name;
        parent::__construct($name, $value, $properties);
    }
}
