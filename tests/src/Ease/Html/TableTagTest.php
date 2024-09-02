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

namespace Test\Ease\Html;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2016-01-17 at 23:59:07.
 */
class TableTagTest extends PairTagTest
{
    public $rendered = '<table><thead></thead><tbody></tbody><tfoot></tfoot></table>';
    protected TableTag $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp(): void
    {
        $this->object = new \Ease\Html\TableTag();
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown(): void
    {
    }

    /**
     * @covers \Ease\Html\TableTag::setHeader
     */
    public function testSetHeader(): void
    {
        $this->object->setHeader(['a', 'b']);
        $this->assertEquals(
            '<table><thead><tr><th>a</th><th>b</th></tr></thead><tbody></tbody><tfoot></tfoot></table>',
            $this->object->getRendered(),
        );
    }

    /**
     * @covers \Ease\Html\TableTag::addRowColumns
     */
    public function testAddRowColumns(): void
    {
        $this->object->addRowColumns(['x', 'y', 'z']);
        $this->assertEquals(
            '<table><thead></thead><tbody><tr><td>x</td><td>y</td><td>z</td></tr></tbody><tfoot></tfoot></table>',
            $this->object->getRendered(),
        );
    }

    /**
     * @covers \Ease\Html\TableTag::addRowHeaderColumns
     */
    public function testAddRowHeaderColumns(): void
    {
        $this->object->addRowHeaderColumns(['a', 'b', 'c']);
        $this->assertEquals(
            '<table><thead><tr><th>a</th><th>b</th><th>c</th></tr></thead><tbody></tbody><tfoot></tfoot></table>',
            $this->object->getRendered(),
        );
    }

    /**
     * @covers \Ease\Html\TableTag::isEmpty
     */
    public function testIsEmpty(): void
    {
        $this->object->addRowColumns(['a' => 'A', 'b' => 'B']);
        $this->assertFalse($this->object->isEmpty());
        $this->object->emptyContents();
        $this->assertTrue($this->object->isEmpty());
    }

    /**
     * @covers \Ease\Html\TableTag::populate
     */
    public function testPopulate(): void
    {
        $this->object->populate([['a', 'b'], ['c', 'd']]);
        $this->assertEquals(
            '<table><thead></thead><tbody><tr><td>a</td><td>b</td></tr><tr><td>c</td><td>d</td></tr></tbody><tfoot></tfoot></table>',
            $this->object->getRendered(),
        );
    }

    /**
     * @covers \Ease\Html\TableTag::addToLastItem
     */
    public function testAddToLastItem(): void
    {
        $this->object->emptyContents();
        $this->object->addItem(new \Ease\Html\DivTag());
        $this->object->addToLastItem(new \Ease\Html\PreTag());
        $this->assertEquals(
            '<table><thead></thead><tbody></tbody><tfoot></tfoot><div></div></table>',
            $this->object->getRendered(),
        );
    }

    /**
     * @covers \Ease\Html\TableTag::getFirstPart
     */
    public function testGetFirstPart(): void
    {
        $this->object->emptyContents();
        $this->assertNull($this->object->getFirstPart());
        $this->object->addRowColumns(['a' => 'A', 'b' => 'B']);
        $this->assertEquals(
            '<thead></thead>',
            $this->object->getFirstPart()->getRendered(),
        );
    }

    /**
     * @covers \Ease\Html\TableTag::addAsFirst
     */
    public function testAddAsFirst(): void
    {
        $this->object->emptyContents();
        $this->object->addItem(new \Ease\Html\DivTag());
        $this->object->addAsFirst(new \Ease\Html\SpanTag());
        $this->assertEquals(
            '<table><thead></thead><tbody></tbody><tfoot></tfoot><div></div><span></span><thead></thead><tbody></tbody><tfoot></tfoot><div></div></table>',
            $this->object->getRendered(),
        );
    }

    /**
     * @covers \Ease\Html\TableTag::getItemsCount
     */
    public function testGetItemsCount(): void
    {
        $this->object->emptyContents();
        $this->assertEquals(0, $this->object->getItemsCount());
        $this->object->addRowColumns(['a' => 'A', 'b' => 'B']);
        $this->assertEquals(1, $this->object->getItemsCount());
    }

    /**
     * @covers \Ease\Html\TableTag::addItems
     */
    public function testAddItems(): void
    {
        $this->object->emptyContents();
        $this->object->addItems([new \Ease\Html\DivTag(), new \Ease\Html\SpanTag()]);
        $this->assertEquals(
            '<table><thead></thead><tbody></tbody><tfoot></tfoot><div></div><span></span></table>',
            $this->object->getRendered(),
        );
    }
}
