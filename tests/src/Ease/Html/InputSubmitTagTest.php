<?php

namespace Test\Ease\Html;

use Ease\Html\InputSubmitTag;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2016-01-17 at 23:59:18.
 */
class InputSubmitTagTest extends InputTagTest
{
    /**
     * @var InputSubmitTag
     */
    protected $object;
    public $rendered = '<input name="test" type="submit" value="test" />';

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp(): void
    {
        $this->object = new \Ease\Html\InputSubmitTag('test');
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown(): void
    {
        
    }

    /**
     * 
     * @covers Ease\Html\InputSubmitTag::__construct
     */
    public function testConstructor()
    {
        $classname = get_class($this->object);

        // Get mock, without the constructor being called
        $mock = $this->getMockBuilder($classname)
            ->disableOriginalConstructor()
            ->getMockForAbstractClass();

        $mock->__construct('Tag', 'label', ['name' => 'Tag', 'id' => 'testing']);

        $this->assertEquals('<input name="Tag" id="testing" type="submit" value="label" />',
            $mock->getRendered());
    }

    /**
     * @covers Ease\Html\InputSubmitTag::setValue
     *
     * @todo   Implement testSetValue().
     */
    public function testSetValue()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * 
     * @covers Ease\Html\InputSubmitTag::draw
     */
    public function testDraw($whatWant = null)
    {
        parent::testDraw($this->rendered);
    }
}
