<?php
declare (strict_types=1);

namespace Ease\Html;

/**
 * Html Select.
 *
 * @author Vítězslav Dvořák <vitex@hippy.cz>
 */
class SelectTag extends PairTag {

    /**
     * Předvolené položka #.
     *
     * @var string|int
     */
    public $defaultValue = null;

    /**
     * Automaticky nastavovat název elemnetu.
     *
     * @var bool
     */
    public $setName = true;

    /**
     * @var array field values to use in select
     */
    public $items = [];

    /**
     * Html select box.
     *
     * @param string $name         jmeno
     * @param array  $items        polozky
     * @param string $defaultValue id predvolene polozky
     * @param array  $properties   tag properties
     */
    public function __construct($name, $items = null, $defaultValue = null,
            $properties = []) {
        parent::__construct('select', $properties);
        $this->defaultValue = $defaultValue;
        $this->setTagName($name);
        if (is_array($items)) {
            $this->addItems($items);
        }
    }

    /**
     * Hromadné vložení položek.
     *
     * @param array $items položky výběru
     */
    public function addItems($items) {
        foreach ($items as $itemName => $itemValue) {
            $newItem = $this->addItem(new OptionTag($itemValue, $itemName));
            if (($this->defaultValue == $itemName)) {
                $this->lastItem()->setDefault();
            }
        }
    }

    /**
     * Maketa načtení položek.
     *
     * @return array
     */
    public function loadItems() {
        return [];
    }

	/**
	 * Value setting.
	 *
	 * @param string $value     the set value
	 */
	public function setValue($value)
	{
		if (!empty($value)) {
			foreach ($this->pageParts as $option) {
				if ($option->getValue() == $value) {
					$option->setDefault();
				} else {
					$pos = array_search('selected', $option->tagProperties);
					if (($pos !== false) && is_numeric($pos)) {
						unset($option->tagProperties[$pos]);
					}
				}
			}
		} else {
			if (isset($this->pageParts) && count($this->pageParts)) {
				$firstItem = &reset($this->pageParts);
				$firstItem->setDefault();
			}
		}
	}
  
    /**
     * Include loaded items
     */
    public function finalize() {
        if (!count($this->pageParts)) {
            //Uninitialised Select - so we load items
            $this->addItems($this->loadItems());
        }
    }

    /**
     * Odstarní položku z nabídky.
     *
     * @param string $itemID klíč hodnoty k odstranění ze seznamu
     */
    public function delItem($itemID) {
        foreach ($this->pageParts as $optionId => $option) {
            if ($option->getValue() == $itemID) {
                unset($this->pageParts[$optionId]);
            }
        }
    }

    /**
     * Disable menu item
     *  
     * @param int $itemID
     */
    public function disableItem($itemID) {
        foreach ($this->pageParts as $optionId => $option) {
            if ($option->getValue() == $itemID) {
                $this->pageParts[$optionId]->setTagProperties(['disabled']);
            }
        }
    }

}
