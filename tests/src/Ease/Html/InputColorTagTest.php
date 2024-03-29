<?php

declare (strict_types=1);

namespace Test\Ease\Html;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2016-01-17 at 23:58:39.
 */
class InputColorTagTest extends InputTagTest {

    /**
     * @var InputColorTag
     */
    protected $object;
    public $rendered = '<input name="test" type="color" value="" />';

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp(): void {
        $this->object = new \Ease\Html\InputColorTag('test');
    }

    /**
     * 
     * @covers Ease\Html\ImgTag::__construct
     */
    public function testConstructor() {
        $classname = get_class($this->object);

        // Get mock, without the constructor being called
        $mock = $this->getMockBuilder($classname)
                ->disableOriginalConstructor()
                ->getMockForAbstractClass();
        $mock->__construct('Test');

        $mock->__construct('Tag', 'a1b2c3', ['name' => 'Tag', 'id' => 'testing']);

        $this->assertEquals('<input name="Tag" type="color" value="a1b2c3" id="testing" />',
                $mock->getRendered());
    }

    /**
     * 
     * @covers Ease\Html\InputColorTag::draw
     */
    public function testDraw($whatWant = null) {
        parent::testDraw($this->rendered);
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown(): void {
        
    }

}
