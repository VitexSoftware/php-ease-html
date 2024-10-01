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
 * Definition list.
 */
class DlTag extends PairTag
{
    /**
     * Definition.
     *
     * @param mixed $content    content included
     * @param array $properties dl tag properties
     */
    public function __construct($content = null, $properties = null)
    {
        parent::__construct('dl', $properties, $content);
    }

    /**
     * Inserts new definition.
     *
     * @param mixed|string $term  subject
     * @param mixed|string $value subject description
     */
    public function addDef($term, $value): void
    {
        $this->addItem(new DtTag($term));
        $this->addItem(new DdTag($value));
    }
}
