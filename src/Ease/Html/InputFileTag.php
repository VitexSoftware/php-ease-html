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
 * Input element for sending a file.
 */
class InputFileTag extends InputTag implements Input
{
    /**
     * Input box for file selection.
     *
     * @param string $name       tag name
     * @param string $value      pre-defined value
     * @param array  $properties input file tag properties
     */
    public function __construct($name, $value = null, array $properties = [])
    {
        parent::__construct($name, $value);
        $properties['type'] = 'file';
        $this->setTagProperties($properties);
    }
}
