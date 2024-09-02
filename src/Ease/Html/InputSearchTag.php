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
 * Show search input field.
 */
class InputSearchTag extends InputTag implements Input
{
    /**
     * URL data source for the hinter.
     */
    public string $dataSourceURL = null;

    /**
     * Displays a tag for the search box.
     *
     * @param string $name       tag name
     * @param string $value      initial value
     * @param array  $properties additional input search tag properties
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
