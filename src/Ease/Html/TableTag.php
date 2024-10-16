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
    public function __construct($content = null, $properties = [])
    {
        parent::__construct('table', $properties);
        $this->tHead = new Thead();
        $this->tBody = new Tbody($content);
        $this->tFoot = new Tfoot();
    }

    /**
     * @param array $headerColumns table header items
     */
    public function setHeader(array $headerColumns): void
    {
        $this->tHead->emptyContents();
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
        $tableRow = $this->tBody->addItem(new TrTag());

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
        $tableRow = $this->tHead->addItem(new TrTag());

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
        $tableRow = $this->tFoot->addItem(new TrTag());

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
     *
     * @return bool
     */
    public function isEmpty()
    {
        return $this->tBody->isEmpty();
    }

    /**
     * Empties container contents.
     */
    #[\Override]
    public function emptyContents(): void
    {
        $this->tBody->emptyContents();
    }

    /**
     * Contents.
     */
    #[\Override]
    public function getContents()
    {
        return $this->tBody->getContents();
    }

    public function getFirstPart()
    {
        return $this->tBody->getFirstPart();
    }

    /**
     * Returns number of enclosed items in current or given object.
     *
     * @return int number of parts enclosed
     */
    public function getItemsCount()
    {
        return $this->tBody->getItemsCount();
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
        if ($this->tHead->isEmpty() === false) {
            $this->addItem($this->tHead);
        }

        $this->addItem($this->tBody);

        if ($this->tFoot->isEmpty() === false) {
            $this->addItem($this->tFoot);
        }

        parent::finalize();
    }
}
