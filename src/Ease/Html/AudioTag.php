<?php

declare (strict_types=1);

namespace Ease\Html;

/**
 *  @author Vítězslav Dvořák <info@vitexsoftware.cz>, Jana Viktorie Borbina <jana@borbina.com>
 *
 * HTML5 Article tag.
 */
class AudioTag extends PairTag {

    /**
     * Defines audio content
     *
     * @param mixed  $content    items included
     * @param array  $properties audio tag properties
     */
    public function __construct($content = null, $properties = []) {
        parent::__construct('audio', $properties, $content);
    }

}
