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
 * List item.
 */
class OptionTag extends PairTag
{
    /**
     * Value.
     */
    public string $value = '';

    /**
     * Drop-down menu item tag.
     */
    public function __construct(string $content = '', string $value = '')
    {
        parent::__construct('option', ['value' => $value], $content);
        $this->setObjectName($this->getObjectName().'@'.$value);
        $this->value = &$this->tagProperties['value'];
    }

    /**
     * Sets the default item.
     *
     * @return bool
     */
    public function setDefault()
    {
        return $this->setTagProperties(['selected']);
    }

    /**
     * Sets value.
     *
     * @param int|string $value return value
     */
    public function setValue($value): void
    {
        $this->value = $value;
    }

    /**
     * Value Getter.
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }
}
