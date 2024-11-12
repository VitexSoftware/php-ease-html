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
 * HTML table.
 */
class TableTag extends PairTag
{
    /**
     * Table header.
     */
    public Thead $tHead;

    /**
     * Table Body.
     */
    public Tbody $tBody;

    /**
     * Table Foot.
     */
    public Tfoot $tFoot;

    /**
     * Html Table.
     *
     * @param mixed $content    inserted value
     * @param array $properties table tag properties
     */
    public function __construct($content = null, array $properties = [])
    {
        $this->tHead = new Thead();
        $this->tBody = new Tbody($content);
        $this->tFoot = new Tfoot();
        parent::__construct('table', $properties);
    }

    public function getHead(): Thead
    {
        return $this->tHead ?? $this->tHead = new Thead();
    }

    public function getBody(): Tbody
    {
        return $this->tBody ?? $this->tBody = new Tbody();
    }

    public function getFoot(): Tfoot
    {
        return $this->tFoot ?? $this->tFoot = new Tfoot();
    }

    /**
     * @param array $headerColumns table header items
     */
    public function setHeader(array $headerColumns): void
    {
        $this->getHead()->emptyContents();
        $this->addRowHeaderColumns($headerColumns);
    }

    /**
     * Inserts the contents of the field into the table as cells.
     *
     * @param array $columns    array of cell contents
     * @param array $properties property field given to all cells
     *
     * @return TrTag table row reference
     */
    public function &addRowColumns($columns = null, $properties = [])
    {
        $tableRow = $this->getBody()->addItem(new TrTag());

        if (\is_array($columns)) {
            foreach ($columns as $column) {
                if (
                    \is_object($column) && method_exists($column, 'getTagType') && $column->getTagType() === 'td'
                ) {
                    $tableRow->addItem($column);
                } else {
                    $tableRow->addItem(new TdTag($column, $properties));
                }
            }
        }

        return $tableRow;
    }

    /**
     * Inserts the contents of the field into the table as cells.
     *
     * @param array $columns    array of cell contents
     * @param array $properties property field given to all cells
     *
     * @return TrTag table row reference
     */
    public function &addRowHeaderColumns($columns = null, $properties = [])
    {
        $tableRow = $this->getHead()->addItem(new TrTag());

        if (\is_array($columns)) {
            foreach ($columns as $column) {
                if (
                    \is_object($column) && method_exists($column, 'getTagType') && $column->getTagType() === 'th'
                ) {
                    $tableRow->addItem($column);
                } else {
                    $tableRow->addItem(new ThTag($column, $properties));
                }
            }
        }

        return $tableRow;
    }

    /**
     * Insert columns into table foot.
     *
     * @param array $columns    values
     * @param array $properties options to add
     *
     * @return TrTag table row reference
     */
    public function &addRowFooterColumns($columns = null, $properties = [])
    {
        $tableRow = $this->getFoot()->addItem(new TrTag());

        if (\is_array($columns)) {
            foreach ($columns as $column) {
                if (
                    \is_object($column) && method_exists($column, 'getTagType') && $column->getTagType() === 'th'
                ) {
                    $tableRow->addItem($column);
                } else {
                    $tableRow->addItem(new ThTag($column, $properties));
                }
            }
        }

        return $tableRow;
    }

    /**
     * Is Table Empty?
     */
    public function isEmpty(): bool
    {
        return $this->getBody()->isEmpty();
    }

    /**
     * Empties container contents.
     */
    #[\Override]
    public function emptyContents(): void
    {
        $this->getBody()->emptyContents();
    }

    /**
     * Contents.
     */
    #[\Override]
    public function getContents()
    {
        return $this->getBody()->getContents();
    }

    public function getFirstPart()
    {
        return $this->getBody()->getFirstPart();
    }

    /**
     * Returns number of enclosed items in current or given object.
     *
     * @return int number of parts enclosed
     */
    public function getItemsCount(): int
    {
        return $this->getBody()->getItemsCount();
    }

    /**
     * Fill table with given data.
     *
     * @param array $contents
     *
     * @return self Updated table
     */
    public function populate($contents)
    {
        foreach ($contents as $cRow) {
            $this->addRowColumns($cRow);
        }

        return $this;
    }

    /**
     * Remove empty tHead and tFoot.
     */
    #[\Override]
    public function finalize(): void
    {
        if ($this->getHead()->isEmpty() === false) {
            $this->addItem($this->tHead);
        }

        $this->addItem($this->tBody);

        if ($this->getFoot()->isEmpty() === false) {
            $this->addItem($this->tFoot);
        }

        parent::finalize();
    }
}
