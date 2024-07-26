<?php

declare(strict_types=1);

namespace Ease\Html;

/**
 *  @author Vítězslav Dvořák <info@vitexsoftware.cz>, Jana Viktorie Borbina <jana@borbina.com>
 *
 * Input for password insertion..
 */
class InputPasswordTag extends InputTextTag implements Input
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
        parent::__construct($name, $value, $properties);
    }
}
