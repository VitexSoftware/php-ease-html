<?php

namespace Ease\Html;

/**
 *
 * @author vitex
 */
interface Input
{
    /**
     * Sets the value of the input field.
     *
     * @param string $value return value
     */
    public function setValue($value);

    /**
     * Returns the value of an input field.
     *
     * @return string $value
     */
    public function getValue();
}
