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
 * Text area.
 */
class TextareaTag extends PairTag implements Input
{
    /**
     * Link to content.
     */
    public $content;
    public bool $setName = true;

    /**
     * Text area.
     *
     * @param string $name       tag name
     * @param string $content    text arrey content
     * @param array  $properties text area tag properties
     */
    public function __construct($name, $content = '', $properties = [])
    {
        $this->setTagName($name);
        parent::__construct('textarea', $properties);

        if ($content) {
            $this->addItem($content);
        }
    }

    /**
     * Sets content.
     *
     * @param string $value value
     */
    public function setValue($value): void
    {
        $this->pageParts = [];
        $this->addItem($value);
    }

    public function getValue(): string
    {
        return $this->getContents();
    }
}
