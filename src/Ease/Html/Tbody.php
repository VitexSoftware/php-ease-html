<?php
declare (strict_types=1);

namespace Ease\Html;

class Tbody extends PairTag
{

    /**
     * <tbody>.
     *
     * @param mixed $content
     * @param array $properties
     */
    public function __construct($content = null, $properties = [])
    {
        parent::__construct('tbody', $properties, $content);
    }
}
