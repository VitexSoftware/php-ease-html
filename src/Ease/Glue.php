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
 * Trait Glue.
 *
 * @author Vítězslav Dvořák <info@vitexsoftware.cz>, Jana Viktorie Borbina <jana@borbina.com>
 *
 * @property array       $pageParts  Array of objects and fragments to draw
 * @property bool        $drawStatus Has the page already been rendered?
 * @property bool        $finalized  Is class finalized?
 * @property null|string $embedName  Name of the embedded part
 *
 * @method mixed addItem(mixed $pageItem)        Include next element into current object
 * @method bool  setEmbedName(string $embedName) Notify component about its embed name
 * @method void  afterAdd()                      Method executed after adding object into new one
 * @method void  finalize()                      Method executed before rendering
 * @method bool  finalized(?bool $state = null)  Get/Set finalization flag
 * @method void  draw()                          Recursive draw object and its contents
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
        $this->finalized(true);
    }

    /**
     * Get/Set finalization flag.
     */
    public function finalized(?bool $state = null): bool
    {
        if ((null === $state) === false) {
            $this->finalized = $state;
        }

        return $this->finalized;
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
