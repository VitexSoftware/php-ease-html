<?php
/**
 * Object able to contain other object in int.
 * Objekt schopný do sebe pojmou jiné objekty.
 *
 * @author     Vitex <vitex@hippy.cz>
 * @copyright  2009-2019 Vitex@hippy.cz (G)
 */

namespace Ease;

class Container extends Sand implements Embedable
{
    /**
     * Pole objektů a fragmentů k vykreslení.
     * Array of objects and fragments to draw
     *
     * @var array
     */
    public $pageParts = [];

    /**
     * Byla jiz stranka vykreslena.
     *
     * @var bool
     */
    public $drawStatus = false;

    /**
     * Is class finalized ?
     * Prošel už objekt finalizací ?
     *
     * @var bool
     */
    private $finalized = false;

    /**
     *
     * @var string|null 
     */
    private $embedName = null;

    /**
     * Kontejner, který může obsahovat vložené objekty, které se vykreslí.
     *
     * @param Embedable|string $initialContent hodnota nebo EaseObjekt s metodou draw()
     */
    public function __construct($initialContent = null)
    {
        if (!empty($initialContent)) {
            $this->addItem($initialContent);
        }
    }

    /**
     * Vloží další element do objektu.
     *
     * @param Embedable|string $pageItem     hodnota nebo EaseObjekt s metodou draw()
     * @param Embedable        $context      Objekt do nějž jsou prvky/položky vkládány
     *
     * @return mixed Odkaz na vložený objekt
     */
    public static function &addItemCustom($pageItem, Embedable $context)
    {
        $itemPointer = null;
        if (is_object($pageItem)) {
            $context->pageParts[] = $pageItem;

            $pageItemName = key(array_slice($context->pageParts, -1, 1, true));

            $context->pageParts[$pageItemName]->parentObject = &$context;
            $context->pageParts[$pageItemName]->setEmbedName($pageItemName);
            $context->pageParts[$pageItemName]->afterAdd($context);

            $itemPointer = &$context->pageParts[$pageItemName];
        } else {
            if (is_array($pageItem)) {
                $addedItemPointer = $context->addItems($pageItem);
                $itemPointer      = &$addedItemPointer;
            } else {
                if (!is_null($pageItem)) {
                    $context->pageParts[] = $pageItem;
                    $endPointer           = end($context->pageParts);
                    $itemPointer          = &$endPointer;
                }
            }
        }
        Document::singleton()->registerItem($itemPointer);
        return $itemPointer;
    }

    /**
     * Notify component about its embed name
     * 
     * @param string  $embedName parent::$pageParts[$embedName] == self
     *
     * @return boolean success
     */
    public function setEmbedName($embedName)
    {
        $this->embedName = $embedName;
        return true;
    }

    /**
     * Include next element into current object.
     *
     * @param Embedable|string  $pageItem     value or EaseClass with draw() method
     *
     * @return mixed Pointer to included object
     */
    public function addItem($pageItem)
    {
        return self::addItemCustom($pageItem, $this);
    }

    /**
     * Vloží jako první element do objektu.
     *
     * @param mixed  $pageItem     hodnota nebo EaseObjekt s metodou draw()
     * @param string $pageItemName Pod tímto jménem je objekt vkládán do stromu
     *
     * @return mixed Odkaz na vložený objekt
     */
    public function &addAsFirst($pageItem, $pageItemName = null)
    {
        $swap        = $this->pageParts;
        $this->emptyContents();
        $itemPointer = $this->addItem($pageItem);
        $this->addItems($swap);
        return $itemPointer;
    }

    /**
     * Umožní již vloženému objektu se odstranit ze stromu k vykreslení.
     */
    public function suicide()
    {
        if (isset($this->parentObject) && isset($this->parentObject->pageParts[$this->embedName])) {
            unset($this->parentObject->pageParts[$this->embedName]);

            return true;
        } else {
            return false;
        }
    }

    /**
     * Vrací počet vložených položek.
     * Obtain number of enclosed items in current or given object.
     *
     * @return int nuber of parts enclosed
     */
    public function getItemsCount()
    {
        return count($this->pageParts);
    }

    /**
     * Vloží další element za stávající.
     *
     * @param mixed $pageItem hodnota nebo EaseObjekt s metodou draw()
     *
     * @return Embedable|string Odkaz na vložený objekt
     */
    public function &addNextTo($pageItem)
    {
        $itemPointer = $this->parentObject->addItem($pageItem);

        return $itemPointer;
    }

    /**
     * Vrací odkaz na poslední vloženou položku.
     *
     * @return Brick|mixed
     */
    public function &lastItem()
    {
        $lastPart = empty($this->pageParts) ? null : end($this->pageParts);
        return $lastPart;
    }

    /**
     * Přidá položku do poslední vložené položky.
     *
     * @param object $pageItem hodnota nebo EaseObjekt s metodou draw()
     *
     * @return Container|null success
     */
    public function addToLastItem($pageItem)
    {
        return $this->isEmpty() ? null : end($this->pageParts)->addItem($pageItem);
    }

    /**
     * Vrací první vloženou položku.
     */
    public function getFirstPart()
    {
        return $this->isEmpty() ? null : reset($this->pageParts);
    }

    /**
     * Insert an array of elemnts
     * Vloží pole elementů.
     *
     * @param array $itemsArray pole hodnot nebo EaseObjektů s metodou draw()
     */
    public function addItems($itemsArray)
    {
        $itemsAdded = [];
        foreach ($itemsArray as $itemID => $item) {
            $itemsAdded[$itemID] = $this->addItem($item);
        }

        return $itemsAdded;
    }

    /**
     * Vyprázní obsah objektu.
     * Empty container contents
     */
    public function emptyContents()
    {
        $this->pageParts = [];
    }

    /**
     * Contentets
     * 
     * @return mixed
     */
    public function getContents()
    {
        return $this->pageParts;
    }

    /**
     * Projde rekurzivně všechny vložené objekty a zavolá jeich draw().
     */
    public function drawAllContents()
    {
        if (!empty($this->pageParts)) {
            foreach ($this->pageParts as $part) {
                if (is_object($part) && method_exists($part, 'draw')) {
                    $part->draw();
                } else {
                    echo $part;
                }
            }
        }
        $this->drawStatus = true;
    }

    /**
     * Vrací rendrovaný obsah objektů.
     *
     * @return string
     */
    public function getRendered()
    {
        $retVal = '';
        ob_start();
        $this->draw();
        $retVal .= ob_get_contents();
        ob_end_clean();

        return $retVal;
    }

    /**
     * Vykresli se, pokud již tak nebylo učiněno.
     * Draw contents not drawn yet.
     */
    public function drawIfNotDrawn()
    {
        if ($this->drawStatus === false) {
            $this->draw();
        }
    }

    /**
     * Vrací stav návěští finalizace části.
     *
     * @return bool
     */
    public function isFinalized()
    {
        return $this->finalized;
    }

    /**
     * Set label of parts finalized.
     * Nastaví návěstí finalizace části.
     *
     * @param bool $flag příznak finalizace
     */
    public function setFinalized($flag = true)
    {
        $this->finalized = $flag;
    }

    /**
     * Je element prázdný ?
     *
     * @return bool prázdnost
     */
    public function isEmpty()
    {
        return empty($this->pageParts);
    }

    /**
     * Recursive draw object and its contents
     */
    public function draw()
    {
        foreach ($this->pageParts as $part) {
            if (is_object($part)) {
                if (method_exists($part, 'drawIfNotDrawn')) {
                    $part->drawIfNotDrawn();
                } else {
                    $part->draw();
                }
            } else {
                echo $part;
            }
        }
        $this->drawStatus = true;
    }

    /**
     * Method executed after adding object into new one
     */
    public function afterAdd()
    {
        
    }

    /**
     * Method executed before rendering
     */
    public function finalize()
    {
        
    }

    /**
     * Render Obect (and its contents) as string.
     *
     * @return string
     */
    public function __toString()
    {
        ob_start();
        $this->draw();
        $objectOut = ob_get_contents();
        ob_end_clean();

        return $objectOut;
    }
}
