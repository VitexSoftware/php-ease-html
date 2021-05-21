<?php
declare (strict_types=1);

namespace Ease\Html;

class Tfoot extends PairTag
{

    /**
     * <tfoot>.
     *
     * @param mixed $content
     * @param array $properties
     */
    public function __construct($content = null, $properties = [])
    {
        parent::__construct('tfoot', $properties, $content);
    }
}
