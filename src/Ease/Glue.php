<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Ease;

/**
 *
 * @author Vítězslav Dvořák <info@vitexsoftware.cz>
 */
trait Glue
{
    /**
     * Pole objektů a fragmentů k vykreslení.
     * Array of objects and fragments to draw
     *
     * @var array
     */
    public $pageParts = [];

    /**
     * Byla jiz stranka vykreslena.
     *
     * @var bool
     */
    public $drawStatus = false;

    /**
     * Is class finalized ?
     * Prošel už objekt finalizací ?
     *
     * @var bool
     */
    private $finalized = false;

    /**
     *
     * @var string|null 
     */
    private $embedName = null;

    /**
     * Vloží další element do objektu.
     *
     * @param Embedable|string $pageItem     hodnota nebo EaseObjekt s metodou draw()
     * @param Embedable        $context      Objekt do nějž jsou prvky/položky vkládány
     *
     * @return mixed Odkaz na vložený objekt
     */
    public static function &addItemCustom($pageItem, Embedable $context)
    {
        $itemPointer = null;
        if (is_object($pageItem)) {
            $context->pageParts[] = $pageItem;

            $pageItemName = key(array_slice($context->pageParts, -1, 1, true));

            $context->pageParts[$pageItemName]->parentObject = &$context;
            $context->pageParts[$pageItemName]->setEmbedName($pageItemName);
            $context->pageParts[$pageItemName]->afterAdd($context);

            $itemPointer = &$context->pageParts[$pageItemName];
        } else {
            if (is_array($pageItem)) {
                $addedItemPointer = $context->addItems($pageItem);
                $itemPointer      = &$addedItemPointer;
            } else {
                if (!is_null($pageItem)) {
                    $context->pageParts[] = $pageItem;
                    $endPointer           = end($context->pageParts);
                    $itemPointer          = &$endPointer;
                }
            }
        }
        Document::singleton()->registerItem($itemPointer);
        return $itemPointer;
    }

    /**
     * Include next element into current object.
     *
     * @param Embedable|string  $pageItem     value or EaseClass with draw() method
     *
     * @return mixed Pointer to included object
     */
    public function addItem($pageItem)
    {
        return self::addItemCustom($pageItem, $this);
    }

    /**
     * Notify component about its embed name
     * 
     * @param string  $embedName parent::$pageParts[$embedName] == self
     *
     * @return boolean success
     */
    public function setEmbedName($embedName)
    {
        $this->embedName = $embedName;
        return true;
    }

    /**
     * Method executed after adding object into new one
     */
    public function afterAdd()
    {
        
    }

    /**
     * Method executed before rendering
     */
    public function finalize()
    {
        
    }

    /**
     * Recursive draw object and its contents
     */
    public function draw()
    {
        foreach ($this->pageParts as $part) {
            if (is_object($part)) {
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
