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
 * Html Select.
 */
class SelectTag extends PairTag implements Input
{
    /**
     * Default item #.
     */
    public string $defaultValue;

    /**
     * Automatic setting of the element name.
     */
    public bool $setName = true;

    /**
     * @var array field values to use in select
     */
    public array $items = [];

    /**
     * Html select box.
     *
     * @param string $name         name
     * @param array  $items        items
     * @param string $defaultValue default item id
     * @param array  $properties   select tag properties
     */
    public function __construct( string $name, array  $items = [], string $defaultValue = '', array  $properties = [] ) {
        parent::__construct('select', $properties);
        $this->defaultValue = $defaultValue;
        $this->setTagName($name);

        if (\is_array($items)) {
            $this->addItems($items);
        }
    }

    /**
     * Bulk insert items.
     *
     * @param array $items Select Items to add
     */
    public function addItems(array $items): array
    {
        $added = [];

        foreach ($items as $itemName => $itemValue) {
            $added[$itemName] = $this->addItem(new OptionTag((string) $itemValue, (string) $itemName));

            if ($this->defaultValue === $itemName) {
                $this->lastItem()->setDefault();
            }
        }

        return $added;
    }

    /**
     * Mockup of loading items.
     *
     * @return array
     */
    public function loadItems()
    {
        return [];
    }

    /**
     * Value setting.
     *
     * @param string $value the set value
     */
    public function setValue(string $value): void
    {
        if (empty(trim($value)) === false) {
            foreach ($this->pageParts as $option) {
                if ($option->getValue() === $value) {
                    $option->setDefault();
                } else {
                    $pos = array_search('selected', $option->tagProperties, true);

                    if (($pos !== false) && is_numeric($pos)) {
                        unset($option->tagProperties[$pos]);
                    }
                }
            }
        } else {
            if (empty($this->pageParts) === true) {
                reset($this->pageParts);
                $firstItem = &$this->pageParts[array_keys($this->pageParts)[0]];
                $firstItem->setDefault();
            }
        }
    }

    /**
     * Insert loaded items.
     */
    public function finalize(): void
    {
        if (!\count($this->pageParts)) {
            // Uninitialised Select - so we load items
            $this->addItems($this->loadItems());
        }
    }

    /**
     * Removes an item from the menu.
     *
     * @param string $itemID value key for removing from the list
     */
    public function delItem($itemID): void
    {
        foreach ($this->pageParts as $optionId => $option) {
            if ($option->getValue() === $itemID) {
                unset($this->pageParts[$optionId]);
            }
        }
    }

    /**
     * Disable menu item.
     *
     * @param int $itemID
     */
    public function disableItem($itemID): void
    {
        foreach ($this->pageParts as $optionId => $option) {
            if ($option->getValue() === $itemID) {
                $this->pageParts[$optionId]->setTagProperties(['disabled']);
            }
        }
    }

    /**
     * Get value of selected item.
     */
    #[\Override]
    public function getValue(): string
    {
        foreach ($this->pageParts as $option) {
            $pos = array_search('selected', $option->tagProperties, true);

            if (($pos !== false) && is_numeric($pos)) {
                return $option->getValue();
            }
        }
    }
}
