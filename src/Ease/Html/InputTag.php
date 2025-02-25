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
 * General input TAG.
 */
class InputTag extends Tag implements Input
{
    /**
     * Sets tag name automatically.
     *
     * @author Vítězslav Dvořák <vitex@hippy.cz>
     */
    public bool $setName = true;

    /**
     * General input TAG.
     *
     * @param string $name       tag name
     * @param string $value      return value
     * @param array  $properties additional input tag properties
     */
    public function __construct($name, $value = null, $properties = [])
    {
        parent::__construct('input');
        $this->setTagName($name);
        $this->setTagProperties($properties);

        if (null !== $value) {
            $this->setValue($value);
        }
    }

    /**
     * Sets the value of the input field.
     *
     * @param string $value return value
     */
    public function setValue($value): void
    {
        $this->setTagProperties(['value' => $value]);
    }

    /**
     * Returns the value of an input field.
     *
     * @return null|string $value
     */
    public function getValue(): ?string
    {
        return $this->getTagProperty('value');
    }
}
