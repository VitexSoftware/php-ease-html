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
 * @author vitex
 */
interface Input
{
    /**
     * Sets the value of the input field.
     *
     * @param string $value return value
     */
    public function setValue(string $value);

    /**
     * Returns the value of an input field.
     *
     * @return string $value
     */
    public function getValue(): ?string;
}
