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
 * HTML5 input datetime-local tag.
 */
class InputDateTimeLocalTag extends InputTag implements Input
{
    /**
     * The <input type="datetime-local"> is used for input fields that should contain a
     * date and time with no time zone.
     *
     * @param string           $name       name
     * @param \DateTime|string $value      initial value as string or DateTime
     * @param array            $properties additional input date time local properties
     */
    public function __construct(
        $name,
        /** @scrutinizer ignore-type */
        $value = null,
        $properties = [],
    ) {
        $properties['type'] = 'datetime-local';
        $properties['name'] = $name;
        parent::__construct($name, \is_object($value) ? $value->format('Y-m-dTH:i:s') : $value, $properties);
    }
}
