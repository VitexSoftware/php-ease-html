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
 * HTML unsorted list.
 */
class OlTag extends UlTag
{
    /**
     * Vytvori OL container.
     *
     * @param mixed $ulContents items included
     * @param array $properties ol tag properties
     */
    public function __construct($ulContents = null, $properties = [])
    {
        parent::__construct($ulContents, $properties);
        $this->setTagType('ol');
    }
}
