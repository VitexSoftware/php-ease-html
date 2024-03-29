<?php

declare (strict_types=1);

namespace Test\Ease\Html;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2016-01-17 at 23:59:05.
 */
class InputNumberTagTest extends InputTagTest {

    /**
     * @var InputNumberTag
     */
    protected $object;
    public $rendered = '<input name="test" type="number" value="12" />';

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp(): void {
        $this->object = new \Ease\Html\InputNumberTag('test', 12);
    }

    /**
     * 
     * @covers Ease\Html\InputNumberTag::__construct
     */
    public function testConstructor() {
        $classname = get_class($this->object);

        // Get mock, without the constructor being called
        $mock = $this->getMockBuilder($classname)
                ->disableOriginalConstructor()
                ->getMockForAbstractClass();

        $mock->__construct('Tag', 10, ['name' => 'Tag', 'id' => 'testing']);

        $this->assertEquals('<input name="Tag" id="testing" type="number" value="10" />',
                $mock->getRendered());
    }

    /**
     * 
     * @covers Ease\Html\InputNumberTag::draw
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
