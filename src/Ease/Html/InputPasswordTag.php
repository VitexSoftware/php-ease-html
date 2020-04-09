<?php

namespace Ease\Html;

/**
 * Vstup pro zadání hesla.
 *
 * @author Vítězslav Dvořák <vitex@hippy.cz>
 */
class InputPasswordTag extends InputTextTag
{

    /**
     * Password Input
     *
     * @param string $name       Tag Name
     * @param string $value      prefilled password
     * @param array  $properties Description
     */
    public function __construct($name, $value = null, $properties = [])
    {
        $properties['type'] = 'password';
        parent::__construct($name, $value,$properties);
    }
}
