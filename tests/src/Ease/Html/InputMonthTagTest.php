<?php

declare (strict_types=1);

namespace Test\Ease\Html;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2019-09-05 at 22:56:43.
 */
class InputMonthTagTest extends InputTagTest {

    /**
     * @var InputMonthTag
     */
    protected $object;
    public $rendered = '<input name="test" type="month" value="06" />';

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp(): void {
        $this->object = new \Ease\Html\InputMonthTag('test', '06');
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown(): void {
        
    }

    /**
     * 
     * @covers Ease\Html\InputMonthTag::__construct
     */
    public function testConstructor() {
        $classname = get_class($this->object);

        // Get mock, without the constructor being called
        $mock = $this->getMockBuilder($classname)
                ->disableOriginalConstructor()
                ->getMockForAbstractClass();

        $mock->__construct('Tag', 'info@vitexsoftware.cz',
                ['name' => 'Tag', 'id' => 'testing']);

        $this->assertEquals('<input name="Tag" id="testing" type="month" value="info@vitexsoftware.cz" />',
                $mock->getRendered());
    }

    /**
     * 
     * @covers Ease\Html\InputNumberTag::draw
     */
    public function testDraw($whatWant = null) {
        parent::testDraw($this->rendered);
    }

}
