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
 * General HTML pair tag.
 */
class PairTag extends Tag
{
    /**
     * Character to close tag.
     */
    public string $trail = '';

    /**
     * Common pair tag.
     *
     * @param string       $tagType    tag type
     * @param array|string $properties pair tag properties
     * @param mixed        $content    Content to insert into tag
     */
    public function __construct(
        $tagType = null,
        $properties = null,
        $content = null
    ) {
        parent::__construct($tagType, $properties);

        if (empty($content) === false) {
            $this->addItem($content);
        }
    }

    /**
     * Render tag and its contents.
     */
    public function draw(): void
    {
        if ($this->finalized === false) {
            $this->finalize();
        }

        $this->tagBegin();
        $this->drawAllContents();
        $this->tagEnclousure();
        $this->drawStatus = true;
    }

    /**
     * Show pair tag begin.
     */
    public function tagBegin(): void
    {
        parent::draw();
    }

    /**
     * Show pair tag ending.
     */
    public function tagEnclousure(): void
    {
        echo '</' . $this->getTagType() . '>';
    }
}
