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

    use Glue;
    /**
     * Library version
     * @var string 
     */
    public static $libVersion = 1.0;

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
