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
 * Send button
 */
class SubmitButton extends InputTag
{
    /**
     * Button label.
     */
    public string $label = '';

    /**
     * Odesílací tlačítko
     * <input type="submit" name="$label" value="$value" title="$Hint">.
     *
     * @param string $label    button label
     * @param string $value    sent value
     * @param string $hint     mouseover tip
     * @param string $classCss css class for tag buttons
     */
    public function __construct(
        $label,
        $value = null,
        $hint = null,
        $classCss = null,
    ) {
        $properties = ['type' => 'submit'];

        if (null === $value) {
            $value = trim(str_replace(
                [' ', '?'],
                '',
                @iconv('utf-8', 'us-ascii//TRANSLIT', strtolower($label)),
            ));
        } else {
            $properties['value'] = $value;
        }

        if (!empty($hint)) {
            $properties['title'] = $hint;
        }

        if (null !== $classCss) {
            $properties['class'] = $classCss;
        }

        $this->setTagProperties($properties);
        parent::__construct($value, $label);
        $this->label = $label;
    }

    /**
     * Sets value.
     *
     * @param string $value     return tag value
     * @param bool   $Automatic Hack for keeping the lables while filling the form
     */
    public function setValue($value, $Automatic = false): void
    {
        if (!$Automatic) {
            // FillUp sets up button lables
            parent::SetValue($value);
        }
    }
}
