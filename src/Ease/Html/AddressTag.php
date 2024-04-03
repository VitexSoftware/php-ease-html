<?php

declare(strict_types=1);

namespace Ease\Html;

/**
 *  @author Vítězslav Dvořák <info@vitexsoftware.cz>, Jana Viktorie Borbina <jana@borbina.com>
 *
 *   Html address element.
 */
class AddressTag extends PairTag
{
    /**
     * Html address element.
     *
     * @param string $content       address content
     * @param array  $properties address tag properties
     */
    public function __construct($content = null, $properties = [])
    {
        parent::__construct('address', $properties, $content);
    }
}
