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
 */

use Ease\Document;
use Ease\Functions;

/*
 * Common HTML tag class.
 */

class Tag extends Document
{
    /**
     * Tag name - is also used as an object name.
     */
    public string $tagName = '';

    /**
     * Tag property fields.
     */
    public array $tagProperties = [];

    /**
     * the field from which the contents of the STYLE tag are rendered.
     */
    public array $cssProperties = [];

    /**
     * Do not log HTML object events.
     */
    public string $logType = 'none';

    /**
     * Trailing for xhtml.
     */
    public string $trail = ' /';

    /**
     * Should the object automatically fulfill the name property?
     */
    public bool $setName = false;

    /**
     * Tag type - e.g. A or STRONG.
     */
    private string $tagType = '';

    /**
     * Object for rendering a general unpaired html tag.
     *
     * @param string $tagType    tag type
     * @param array  $properties tag properties
     */
    public function __construct($tagType = null, $properties = null)
    {
        $this->setTagType(null === $tagType ? $this->getTagType() : $tagType);
        parent::__construct();

        if ($properties) {
            $this->setTagProperties($properties);
        }

        $this->setObjectName();
    }

    /**
     * Sets ObjectName.
     *
     * @param string $objectName object name
     *
     * @return string New object name
     */
    public function setObjectName($objectName = null)
    {
        if ((null === $objectName) === false) {
            $objName = parent::setObjectName($objectName);
        } else {
            if (empty($this->tagName) === false) {
                $objName = parent::setObjectName(\get_class($this).'@'.$this->tagName);
            } else {
                if (empty($this->tagType) === false) {
                    $objName = parent::setObjectName(\get_class($this).'@'.$this->tagType);
                } else {
                    $objName = parent::setObjectName();
                }
            }
        }

        return $objName;
    }

    /**
     * Name tag settings. Unused ...
     *
     * @param string $tagName he name of the tag in the property NAME
     */
    public function setTagName($tagName): void
    {
        $this->tagName = $tagName;

        if ($this->setName) {
            $this->tagProperties['name'] = $tagName;
        }

        $this->setObjectName();
    }

    /**
     * Returns the name of the tag.
     *
     * @return string
     */
    public function getTagName()
    {
        return $this->setName ? $this->getTagProperty('name') : $this->tagName;
    }

    /**
     * Sets up tag type.
     *
     * @param string $tagType tag type e.g. img
     */
    public function setTagType($tagType): void
    {
        $this->tagType = $tagType;
    }

    /**
     * Returns tag type.
     *
     * @return string tag type e.g. img
     */
    public function getTagType()
    {
        return $this->tagType;
    }

    /**
     * Sets tag class.
     *
     * @param string $className jméno css třídy
     */
    public function setTagClass($className): void
    {
        $this->setTagProperties(['class' => $className]);
    }

    /**
     * Adds tag class.
     *
     * @param string $className jméno css třídy
     */
    public function addTagClass($className): void
    {
        $this->setTagClass(trim($this->getTagClass().' '.$className));
    }

    /**
     * Returns tags css class.
     */
    public function getTagClass()
    {
        return $this->getTagProperty('class');
    }

    /**
     * Sets the tag specified by the id, or randomly generated.
     *
     * @param string $tagID html tag #ID for JavaScript a Css
     *
     * @return string the set ID
     */
    public function setTagID($tagID = null)
    {
        $this->setTagProperties(['id' => null === $tagID ? Functions::randomString() : $tagID]);

        return $this->getTagID();
    }

    /**
     * Returns taga html ID.
     *
     * @return string
     */
    public function getTagID()
    {
        return $this->getTagProperty('id');
    }

    /**
     * Sets tag property to given value.
     *
     * @param string $name
     * @param string $value
     *
     * @return bool
     */
    public function setTagProperty($name, $value)
    {
        $this->tagProperties[$name] = $value;

        return true;
    }

    /**
     * Returns property tag value.
     *
     * @param string $propertyName the name of the tag property. eg "src" next to the image
     *
     * @return string current tag property value
     */
    public function getTagProperty($propertyName)
    {
        return \array_key_exists($propertyName, $this->tagProperties) ? $this->tagProperties[$propertyName] : null;
    }

    /**
     * Sets tag parameters.
     *
     * @param array $properties associative array of tag parameters
     *
     * @return bool operation success
     */
    public function setTagProperties(array $properties)
    {
        if (isset($properties['id'])) {
            $properties['id'] = preg_replace(
                '/[^A-Za-z0-9_\\-]/',
                '',
                $properties['id'],
            );
        }

        $this->tagProperties = empty($this->tagProperties) ? $properties : array_merge(
            $this->tagProperties,
            $properties,
        );

        if (isset($properties['name'])) {
            $this->setTagName($properties['name']);
        }

        return true;
    }

    /**
     * Returns tag parameters as a string.
     *
     * @return string
     */
    public function tagPropertiesToString()
    {
        $props = [];

        foreach ($this->tagProperties as $propName => $propValue) {
            $props[] = \is_string($propName) ? $propName.'="'.$propValue.'"' : $propValue;
        }

        return implode(' ', $props);
    }

    /**
     * Sets Css parameters.
     *
     * @param array $cssProperties asociative feild, or CSS definition
     */
    public function setTagCss(array $cssProperties): void
    {
        $this->cssProperties = $cssProperties;
        $this->setTagProperties(['style' => $this->cssPropertiesToString()]);
    }

    /**
     * Returns Css parameters as a string.
     *
     * @param array|string $cssProperties parameter feild, or CSS definition
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
    #[\Override]
    public function finalize(): void
    {
        if (!empty($this->cssProperties)) {
            $this->setTagProperties(['style' => $this->cssPropertiesToString()]);
        }

        parent::finalize();
    }

    /**
     * Renders tag.
     */
    #[\Override]
    public function draw(): void
    {
        echo '<'.trim($this->tagType.' '.$this->tagPropertiesToString());
        echo $this->trail.'>';
        $this->drawStatus = true;
    }
}
