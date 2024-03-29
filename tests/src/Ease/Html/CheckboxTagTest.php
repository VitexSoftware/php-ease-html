<?php

declare (strict_types=1);

namespace Test\Ease\Html;

use Ease\Html\CheckboxTag;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2016-01-17 at 23:59:06.
 */
class CheckboxTagTest extends InputTagTest {

    /**
     * @var CheckboxTag
     */
    protected $object;
    public $rendered = '<input type="checkbox" checked name="test" />';

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp(): void {
        $this->object = new \Ease\Html\CheckboxTag('test', true);
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown(): void {
        
    }

    /**
     * @covers Ease\Html\CheckboxTag::setValue
     */
    public function testSetValue() {
        $this->object->setValue(true);
        $this->assertTrue($this->object->getValue());
        $this->object->setValue(false);
        $this->assertFalse($this->object->getValue());
    }

    /**
     * @covers Ease\Html\CheckboxTag::getValue
     */
    public function testGetValue() {
        $this->object->setValue(true);
        $this->assertTrue($this->object->getValue());
        $this->object->setValue(false);
        $this->assertFalse($this->object->getValue());
    }

    /**
     * 
     * @covers Ease\Html\CheckboxTag::__construct
     */
    public function testConstructor() {
        $classname = get_class($this->object);

        // Get mock, without the constructor being called
        $mock = $this->getMockBuilder($classname)
                ->disableOriginalConstructor()
                ->getMockForAbstractClass();

        $mock->__construct('Tag', true, 'value', ['name' => 'Tag', 'id' => 'testing']);

        $this->assertEquals('<input name="Tag" id="testing" type="checkbox" checked value="value" />',
                $mock->getRendered());
    }

    /**
     * 
     * @covers Ease\Html\CheckBoxTag::draw
     */
    public function testDraw($whatWant = null) {
        parent::testDraw($this->rendered);
    }

}
