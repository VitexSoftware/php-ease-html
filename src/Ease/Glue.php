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

namespace Ease;

/**
 *  @author Vítězslav Dvořák <info@vitexsoftware.cz>, Jana Viktorie Borbina <jana@borbina.com>
 */
trait Glue
{
    /**
     * Array of objects and fragments to draw.
     */
    public array $pageParts = [];

    /**
     * Has the page already been rendered ?
     */
    public bool $drawStatus = false;

    /**
     * Is class finalized ?
     */
    protected bool $finalized = false;
    private ?string $embedName = null;

    /**
     * Inserts another element into the object.
     *
     * @param Embedable|string $pageItem value or EaseObject with draw () method
     * @param Embedable        $context  Object into which elements / items are inserted
     *
     * @return mixed Pointer to embed object
     */
    public static function &addItemCustom($pageItem, Embedable $context)
    {
        $itemPointer = null;

        if (null !== $pageItem) {
            if (\is_object($pageItem)) {
                $context->pageParts[] = $pageItem;

                $pageItemName = key(\array_slice($context->pageParts, -1, 1, true));

                $context->pageParts[$pageItemName]->parentObject = &$context;
                $context->pageParts[$pageItemName]->setEmbedName((string) $pageItemName);
                $context->pageParts[$pageItemName]->afterAdd();

                $itemPointer = &$context->pageParts[$pageItemName];
            } else {
                if (\is_array($pageItem)) {
                    $addedItemPointer = $context->addItems($pageItem);
                    $itemPointer = &$addedItemPointer;
                } else {
                    if (null !== $pageItem) {
                        $context->pageParts[] = $pageItem;
                        $endPointer = end($context->pageParts);
                        $itemPointer = &$endPointer;
                    }
                }
            }

            Document::singleton()->registerItem($itemPointer);
        }

        return $itemPointer;
    }

    /**
     * Include next element into current object.
     *
     * @param Embedable|string $pageItem value or EaseClass with draw() method
     *
     * @return mixed Pointer to included object
     */
    public function addItem($pageItem)
    {
        return self::addItemCustom($pageItem, $this);
    }

    /**
     * Notify component about its embed name.
     *
     * @param string $embedName parent::$pageParts[$embedName] == self
     *
     * @return bool success
     */
    public function setEmbedName($embedName): bool
    {
        $this->embedName = $embedName;

        return true;
    }

    /**
     * Method executed after adding object into new one.
     */
    public function afterAdd(): void
    {
    }

    /**
     * Method executed before rendering.
     */
    public function finalize(): void
    {
        $this->finalized = true;
    }

    /**
     * Recursive draw object and its contents.
     *
     * @return string Empty string
     */
    public function draw(): void
    {
        foreach ($this->pageParts as $part) {
            if (\is_object($part)) {
                if (method_exists($part, 'drawIfNotDrawn')) {
                    $part->drawIfNotDrawn();
                } else {
                    $part->draw();
                }
            } else {
                echo $part;
            }
        }

        $this->drawStatus = true;
    }
}
