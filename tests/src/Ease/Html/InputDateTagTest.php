<?php

declare (strict_types=1);

namespace Test\Ease\Html;

use Ease\Html\InputDateTag;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2019-09-06 at 00:00:12.
 */
class InputDateTagTest extends InputTagTest {

    /**
     * @var InputDateTag
     */
    protected $object;
    public $rendered = '<input name="when" type="date" value="2018-07-22" />';

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp(): void {
        $this->object = new InputDateTag('when', '2018-07-22');
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown(): void {
        
    }

    /**
     * 
     * @covers Ease\Html\InputDateTag::__construct
     */
    public function testConstructor() {
        $classname = get_class($this->object);

        // Get mock, without the constructor being called
        $mock = $this->getMockBuilder($classname)
                ->disableOriginalConstructor()
                ->getMockForAbstractClass();

        $mock->__construct('Tag', '2018-07-22', ['name' => 'Tag', 'id' => 'testing']);

        $this->assertEquals('<input name="Tag" id="testing" type="date" value="2018-07-22" />',
                $mock->getRendered());
    }

}
