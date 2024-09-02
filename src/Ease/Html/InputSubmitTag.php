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
 * Form submit button.
 */
class InputSubmitTag extends InputTag implements Input
{
    /**
     * Odesílací tlačítko formuláře.
     *
     * @param string $name       tag name
     * @param string $value      initial value
     * @param array  $properties additional input submit tag properties
     */
    public function __construct($name, $value = null, $properties = [])
    {
        if (null === $value) {
            $value = $name;
        }

        $properties['type'] = 'submit';
        $properties['name'] = $name;
        $properties['value'] = $value;
        parent::__construct($name, $value, $properties);
    }

    /**
     * Mockup for label.
     *
     * @param bool $value is ignored
     */
    public function setValue($value = true): void
    {
    }
}
