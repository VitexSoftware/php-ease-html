<?php

namespace Ease\Html;

/**
 * HTML main tag.
 *
 * @author Vitex <vitex@hippy.cz>
 */
class MetaTag extends Tag
{

    /**
     * Defines the main content of a document
     *
     * @param array  $properties params array
     */
    public function __construct($properties = [])
    {
        parent::__construct('meta', $properties);
    }
}
