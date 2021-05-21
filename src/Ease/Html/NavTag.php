<?php
declare (strict_types=1);

namespace Ease\Html;

/**
 * HTML5 nav tag.
 *
 * @author Vitex <vitex@hippy.cz>
 */
class NavTag extends PairTag
{

    /**
     * Defines navigation links
     *
     * @param mixed  $content    items included
     * @param array  $properties params array
     */
    public function __construct($content = null, $properties = [])
    {
        parent::__construct('nav', $properties, $content);
    }
}
