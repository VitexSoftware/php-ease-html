<?php

declare(strict_types=1);

namespace Ease\Html;

/**
 *  @author Vítězslav Dvořák <info@vitexsoftware.cz>, Jana Viktorie Borbina <jana@borbina.com>
 *
 * HTML top tag class.
 */
class HtmlTag extends PairTag
{
    /**
     * HTML Tag
     *
     * @param mixed $content    inserted content - page body
     * @param array $properties Description
     */
    public function __construct($content = null, $properties = [])
    {
        if (array_key_exists('lang', $properties) === false) {
            $properties['lang'] = \Ease\Locale::singleton()->get2Code();
        }
        parent::__construct('html', $properties, $content);
    }

    /**
     * Sets object name to "html".
     *
     * @param string $ObjectName    object name
     *
     * @return string               final object name
     */
    public function setObjectName($ObjectName = null)
    {
        return parent::setObjectName('html');
    }
}
