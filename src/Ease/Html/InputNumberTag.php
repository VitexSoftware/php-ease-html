<?php

namespace Ease\Html;

/**
 * Vstupní pole čísla.
 *
 * @author Vítězslav Dvořák <vitex@hippy.cz>
 */
class InputNumberTag extends InputTag
{

    /**
     * The <input type="number"> defines a numeric input field.
     * You can also set restrictions on what numbers are accepted.
     *
     * @param string $name       name
     * @param string $value      initial value
     * @param array  $properties additional tag properties
     */
    public function __construct($name, $value = null, $properties = [])
    {
        $properties['type']  = 'number';
        $properties['value'] = $value;
        $properties['name']  = $name;
        parent::__construct($name, $value, $properties);
    }
}
