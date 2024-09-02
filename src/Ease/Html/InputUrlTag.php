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
 * HTML5 url input tag.
 */
class InputUrlTag extends InputTag implements Input
{
    /**
     * The <input type="url"> is used for input fields that should contain a
     * URL address.
     *
     * @param string $name       tag name
     * @param string $value      initial value
     * @param array  $properties additional input tel input url tag properties
     */
    public function __construct($name, $value = null, $properties = [])
    {
        $properties['type'] = 'url';
        $properties['value'] = $value;
        $properties['name'] = $name;
        parent::__construct($name, $value, $properties);
    }
}
