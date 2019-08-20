<?php

namespace Ease\Html;

/**
 * HTML meta tag.
 *
 * @author Vitex <vitex@hippy.cz>
 */
class MetaTag extends Tag
{

    /**
     * Describe metadata within an HTML document
     *
     * @param string $name       meta property name
     * @param string $content    meta propery value
     * @param array  $properties other html tag params array
     */
    public function __construct($name = null, $content = null, $properties = [])
    {
        if (!is_null($name)) {
            $properties['name'] = $name;
        }
        if (!is_null($content)) {
            $properties['content'] = $content;
        }
        parent::__construct('meta', $properties);
    }
}
