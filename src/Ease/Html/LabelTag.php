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
 * Tag Label for LabeledInput.
 */
class LabelTag extends PairTag
{
    /**
     * Link to content.
     */
    public mixed $contents = null;

    /**
     * Displays tag label.
     *
     * @param string $for        reference element
     * @param mixed  $contents   labeled content
     * @param array  $properties labe tag properties
     */
    public function __construct($for, $contents = null, $properties = [])
    {
        $this->setTagProperties(['for' => $for]);
        parent::__construct('label', $properties);
        $this->contents = $this->addItem($contents);
    }

    /**
     * Sets object name.
     *
     * @param string $objectName the set name
     *
     * @return string New object name
     */
    public function setObjectName($objectName = null)
    {
        if (null === $objectName) {
            $objectName = \get_class($this).'@'.$this->getTagProperty('for');
        }

        return parent::setObjectName($objectName);
    }
}
