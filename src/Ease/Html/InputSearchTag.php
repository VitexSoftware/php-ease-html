<?php
declare (strict_types=1);

namespace Ease\Html;

/**
 * Show search input field
 * Zobrazí vyhledávací poloíčko.
 *
 * @author Vítězslav Dvořák <vitex@hippy.cz>
 */
class InputSearchTag extends InputTag
{
    /**
     * URL zdroje dat pro hinter.
     *
     * @var string
     */
    public $dataSourceURL = null;

    /**
     * Zobrazí tag pro vyhledávací box.
     *
     * @param string $name       jméno
     * @param string $value      předvolená hodnota
     * @param array  $properties dodatečné vlastnosti tagu
     */
    public function __construct($name, $value = null, $properties = [])
    {
        $properties['type'] = 'search';
        if ($value) {
            $properties['value'] = $value;
        }
        if ($name) {
            $properties['name'] = $name;
        }
        parent::__construct($name, $value, $properties);
    }

}
