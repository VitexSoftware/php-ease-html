<?php

declare(strict_types=1);

namespace Ease\Html;

/**
 *  @author Vítězslav Dvořák <info@vitexsoftware.cz>, Jana Viktorie Borbina <jana@borbina.com>
 *
 *  page javascript fragment.
 */
class JavaScript extends ScriptTag
{
    /**
     * page javascript fragment.
     *
     * @param string $content  script content
     */
    public function __construct($content, $properties = [])
    {
        if (empty($properties)) {
            $properties = ['type' => 'text/javascript'];
        } else {
            $properties['type'] = 'text/javascript';
        }
        parent::__construct($content, $properties);
    }
}
