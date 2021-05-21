<?php
declare (strict_types=1);

namespace Ease\Html;

/**
 * Html element pro adresu.
 */
class AddressTag extends PairTag
{

    /**
     * Html element pro adresu.
     *
     * @param string $content       text adresy
     * @param array  $tagProperties vlastnosti tagu
     */
    public function __construct($content = null, $tagProperties = null)
    {
        parent::__construct('address', $tagProperties, $content);
    }
}
