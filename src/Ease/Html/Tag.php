<?php

namespace Ease\Html;

use Ease\Document;
use Ease\Functions;

/**
 * Common HTML tag class.
 *
 * @author     Vitex <vitex@hippy.cz>
 */
class Tag extends Document
{
    /**
     * Jméno tagu - je použit i jako jméno objektu.
     *
     * @var string
     */
    public $tagName = null;

    /**
     * Typ tagu - např A či STRONG.
     *
     * @var string
     */
    private $tagType = null;

    /**
     * Pole vlastností tagu.
     *
     * @var array
     */
    public $tagProperties = [];

    /**
     * pole ze kterého se rendruje obsah STYLE tagu.
     *
     * @var array
     */
    public $cssProperties = null;

    /**
     * Nelogovat události HTML objektů.
     *
     * @var string
     */
    public $logType = 'none';

    /**
     * Koncové lomítko pro xhtml.
     *
     * @var string
     */
    public $trail = ' /';

    /**
     * Má si objekt automaticky plnit vlastnost name ?
     */
    public $setName = false;

    /**
     * Objekt pro vykreslení obecného nepárového html tagu.
     *
     * @param string  $tagType       typ tagu
     * @param array   $tagProperties parametry tagu
     */
    public function __construct($tagType = null, $tagProperties = null)
    {
        $this->setTagType(is_null($tagType) ? $this->getTagType() : $tagType);
        parent::__construct();
        if ($tagProperties) {
            $this->setTagProperties($tagProperties);
        }
        $this->setObjectName();
    }

    /**
     * Set ObjectName
     * Nastaví jméno objektu.
     *
     * @param string $objectName jméno objektu
     *
     * @return string New object name
     */
    public function setObjectName($objectName = null)
    {
        if (is_null($objectName) === false) {
            $objName = parent::setObjectName($objectName);
        } else {
            if (empty($this->tagName) === false) {
                $objName = parent::setObjectName(get_class($this).'@'.$this->tagName);
            } else {
                if (empty($this->tagType) === false) {
                    $objName = parent::setObjectName(get_class($this).'@'.$this->tagType);
                } else {
                    $objName = parent::setObjectName();
                }
            }
        }
        return $objName;
    }

    /**
     * Nastaví jméno tagu. Unused ...
     *
     * @param string $tagName jméno tagu do vlastnosti NAME
     */
    public function setTagName($tagName)
    {
        $this->tagName = $tagName;
        if ($this->setName) {
            $this->tagProperties['name'] = $tagName;
        }
        $this->setObjectName();
    }

    /**
     * Returns name of tag.
     *
     * @return string
     */
    public function getTagName()
    {
        $tagName = null;
        if ($this->setName === true) {
            if (isset($this->tagProperties['name'])) {
                $tagName = $this->tagProperties['name'];
            }
        } else {
            $tagName = $this->tagName;
        }

        return $tagName;
    }

    /**
     * Nastaví typ tagu.
     *
     * @param string $tagType typ tagu - např. img
     */
    public function setTagType($tagType)
    {
        $this->tagType = $tagType;
    }

    /**
     * Vrací typ tagu.
     *
     * @return string typ tagu - např. img
     */
    public function getTagType()
    {
        return $this->tagType;
    }

    /**
     * Nastaví classu tagu.
     *
     * @param string $className jméno css třídy
     */
    public function setTagClass($className)
    {
        $this->setTagProperties(['class' => $className]);
    }

    /**
     * Přidá classu tagu.
     *
     * @param string $className jméno css třídy
     */
    public function addTagClass($className)
    {
        $this->setTagClass(trim($this->getTagClass().' '.$className));
    }

    /**
     * Vrací css classu tagu.
     */
    public function getTagClass()
    {
        return $this->getTagProperty('class');
    }

    /**
     * Nastaví tagu zadane id, nebo vygenerované náhodné.
     *
     * @param string $tagID #ID html tagu pro JavaScript a Css
     *
     * @return string nastavené ID
     */
    public function setTagID($tagID = null)
    {
        $this->setTagProperties(['id' => is_null($tagID) ? Functions::randomString()
                    : $tagID]);
        return $this->getTagID();
    }

    /**
     * Vrací ID html tagu.
     *
     * @return string
     */
    public function getTagID()
    {
        return $this->getTagProperty('id');
    }

    /**
     * Set Tag property to given value
     * 
     * @param string $name
     * @param string $value
     * 
     * @return boolean
     */
    public function setTagProperty($name, $value)
    {
        $this->tagProperties[$name] = $value;
        return true;
    }

    /**
     * Returns property tag value.
     *
     * @param string $propertyName název vlastnosti tagu. např. "src" u obrázku
     *
     * @return string current tag property value
     */
    public function getTagProperty($propertyName)
    {
        return array_key_exists($propertyName, $this->tagProperties) ? $this->tagProperties[$propertyName]
                : null;
    }

    /**
     * Nastaví paramatry tagu.
     *
     * @param mixed $tagProperties asociativní pole parametrů tagu
     * 
     * @return boolean operation success
     */
    public function setTagProperties(array $tagProperties)
    {
        if (isset($tagProperties['id'])) {
            $tagProperties['id'] = preg_replace('/[^A-Za-z0-9_\\-]/', '',
                $tagProperties['id']);
        }
        $this->tagProperties = empty($this->tagProperties) ? $tagProperties : array_merge($this->tagProperties,
                $tagProperties);

        if (isset($tagProperties['name'])) {
            $this->setTagName($tagProperties['name']);
        }
        return true;
    }

    /**
     * Vrátí parametry tagu jako řetězec.
     *
     * @return string
     */
    public function tagPropertiesToString()
    {
        $props = [];
        foreach ($this->tagProperties as $propName => $propValue) {
            $props[] = is_string($propName) ? $propName.'="'.$propValue.'"' : $propValue;
        }
        return implode(' ', $props);
    }

    /**
     * Nastaví paramatry Css.
     *
     * @param array $cssProperties asociativní pole, nebo CSS definice
     */
    public function setTagCss(array $cssProperties)
    {
        $this->cssProperties = $cssProperties;
        $this->setTagProperties(['style' => $this->cssPropertiesToString()]);
    }

    /**
     * Vrátí parametry Cssu jako řetězec.
     *
     * @param array|string $cssProperties pole vlastností nebo CSS definice
     *
     * @return string
     */
    public function cssPropertiesToString($cssProperties = null)
    {
        if (!$cssProperties) {
            $cssProperties = $this->cssProperties;
        }
        $cssPropertiesString = ' ';
        foreach ($cssProperties as $cssPropertyName => $cssPropertiesssPropertyValue) {
            $cssPropertiesString .= $cssPropertyName.':'.$cssPropertiesssPropertyValue.';';
        }
        return trim($cssPropertiesString);
    }

    /**
     * Add Css to tag properties.
     */
    public function finalize()
    {
        if (!empty($this->cssProperties)) {
            $this->setTagProperties(['style' => $this->cssPropertiesToString()]);
        }
    }

    /**
     * Vykreslí tag.
     */
    public function draw()
    {
        echo '<'.trim($this->tagType.' '.$this->tagPropertiesToString());
        echo $this->trail.'>';
        $this->drawStatus = true;
    }
}
