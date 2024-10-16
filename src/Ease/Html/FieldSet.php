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
 * Html FieldSet.
 */
class FieldSet extends PairTag
{
    /**
     * Frame legend.
     */
    public string $legend;

    /**
     * Object with legend tag.
     */
    public PairTag $legendTag;

    /**
     * Frame content.
     */
    public $content;

    /**
     * Displays the frame.
     *
     * @param string $legend  frame title in text format or ease framework object
     * @param mixed  $content elements inserted into the frame
     */
    public function __construct(string $legend, $content = null)
    {
        $this->setTagName($legend);
        $this->legend = $legend;
        $this->legendTag = $this->addItem(new PairTag(
            'legend',
            null,
            $this->legend,
        ));

        if ($content) {
            $this->content = $this->addItem($content);
        }

        parent::__construct('fieldset');
    }

    /**
     * Legend settings.
     *
     * @param string $legend description
     */
    public function setLegend($legend): void
    {
        $this->legend = $legend;
    }

    /**
     * Inserts the legend.
     */
    #[\Override]
    public function finalize(): void
    {
        if ($this->legend) {
            if (\is_object(reset($this->pageParts))) {
                reset($this->pageParts)->pageParts = [$this->legend];
            } else {
                array_unshift($this->pageParts, $this->legendTag);
                reset($this->pageParts)->pageParts = [$this->legend];
            }
        }

        parent::finalize();
    }
}
