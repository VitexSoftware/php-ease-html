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
 * Radio button.
 */
class InputRadioTag extends InputTag implements Input
{
    /**
     * Return value.
     */
    public string $value = '';

    /**
     * Radio button.
     *
     * @param string $name       tag name
     * @param string $value      return value
     * @param array  $properties input radio tag properties
     */
    public function __construct($name, $value = '', $properties = [])
    {
        parent::__construct($name, $value);

        if ($properties) {
            $this->setTagProperties($properties);
        }

        $this->setTagProperties(['type' => 'radio']);
        $this->value = $value;
    }

    /**
     * Sets the checkbox value for the first time. The second call sets the checked flag, if the value is the same as already charged.
     *
     * @param string $value return value
     */
    public function setValue($value): void
    {
        $currentValue = $this->getTagProperty('value');

        if ($currentValue) {
            if ($currentValue === $value) {
                $this->setTagProperties(['checked']);
            }
        } else {
            $this->setTagProperties(['value' => $value]);
        }
    }
}
