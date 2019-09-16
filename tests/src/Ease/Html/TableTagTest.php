<?php

namespace Test\Ease\Html;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2016-01-17 at 23:59:07.
 */
class TableTagTest extends PairTagTest
{
    /**
     * @var TableTag
     */
    protected $object;
    public $rendered = '<table><thead></thead><tbody></tbody><tfoot></tfoot></table>';

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
     * @covers Ease\Html\TableTag::setHeader
     */
    public function testSetHeader()
    {
        $this->object->setHeader(['a', 'b']);
        $this->assertEquals('<table><thead><tr><th>a</th><th>b</th></tr></thead><tbody></tbody><tfoot></tfoot></table>',
            $this->object->getRendered());
    }

    /**
     * @covers Ease\Html\TableTag::addRowColumns
     */
    public function testAddRowColumns()
    {
        $this->object->addRowColumns(['x', 'y', 'z']);
        $this->assertEquals('<table><thead></thead><tbody><tr><td>x</td><td>y</td><td>z</td></tr></tbody><tfoot></tfoot></table>',
            $this->object->getRendered());
    }

    /**
     * @covers Ease\Html\TableTag::addRowHeaderColumns
     */
    public function testAddRowHeaderColumns()
    {
        $this->object->addRowHeaderColumns(['a', 'b', 'c']);
        $this->assertEquals('<table><thead><tr><th>a</th><th>b</th><th>c</th></tr></thead><tbody></tbody><tfoot></tfoot></table>', $this->object->getRendered());
    }

    /**
     * @covers Ease\Html\TableTag::isEmpty
     */
    public function testIsEmpty()
    {
        $this->object->addItem( new \Ease\Html\TrTag( new \Ease\Html\TdTag() ) );
        $this->assertFalse($this->object->isEmpty());
        $this->object->emptyContents();
        $this->assertTrue($this->object->isEmpty());
    }

    /**
     * @covers Ease\Html\TableTag::populate
     */
    public function testPopulate()
    {
        $this->object->populate([['a', 'b'], ['c', 'd']]);
        $this->assertEquals('<table><thead></thead><tbody><tr><td>a</td><td>b</td></tr><tr><td>c</td><td>d</td></tr></tbody><tfoot></tfoot></table>',
            $this->object->getRendered());
    }
}
