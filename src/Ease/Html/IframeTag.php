<?php
declare (strict_types=1);

namespace Ease\Html;

/**
 * iFrame element.
 *
 * @author Vitex <vitex@hippy.cz>
 */
class IframeTag extends PairTag
{
    /**
     * iFrame element.
     *
     * @param string $src        content url
     * @param array  $properties HTML tag proberties
     */
    public function __construct( string $src, $properties = [])
    {
        $properties['src'] = $src;
        parent::__construct('iframe',$properties);
    }
}
