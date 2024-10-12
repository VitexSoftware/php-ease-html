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
interface Embedable
{
    /**
     * Include next element into current object.
     *
     * @param Embedable|string $pageItem value or EaseClass with draw() method
     *
     * @return mixed Pointer to included object
     */
    public function addItem($pageItem);

    /**
     * Notify component about its embed name.
     *
     * @param string $embedName parent::$pageParts[$embedName] == self
     *
     * @return bool success
     */
    public function setEmbedName($embedName);

    /**
     * Method executed after adding object into new one.
     */
    public function afterAdd();

    /**
     * Method executed before rendering.
     */
    public function finalize();

    /**
     * Recursive draw object and its contents.
     */
    public function draw(): void;
}
