<?php

declare(strict_types=1);

/**
 * This file is part of the EaseHtml package
 *
 * https://github.com/VitexSoftware/php-ease-html
 *
 * (c) Vítězslav Dvořák <http://vitexsoftware.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

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
     * @param string $content script content
     */
    public function __construct($content, array $properties = [])
    {
        if (\array_key_exists('type', $properties) === false) {
            $properties['type'] = 'text/javascript';
        }

        parent::__construct($content, $properties);
    }
}
