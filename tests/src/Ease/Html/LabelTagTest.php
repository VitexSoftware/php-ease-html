<?php
declare (strict_types=1);

namespace Test\Ease\Html;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2016-01-17 at 23:59:23.
 */
class LabelTagTest extends PairTagTest
{
    /**
     * @var LabelTag
     */
    protected $object;
    public $rendered = '<label for="test"></label>';

    
    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp(): void
    {
        $this->object = new \Ease\Html\LabelTag('test');
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown(): void
    {
    }

    /**
     * @covers Ease\Html\LabelTag::setObjectName
     *
     * @todo   Implement testSetObjectName().
     */
    public function testSetObjectName()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    public function testConstructor()
    {
        $classname = get_class($this->object);

        // Get mock, without the constructor being called
        $mock = $this->getMockBuilder($classname)
            ->disableOriginalConstructor()
            ->getMockForAbstractClass();
        $mock->__construct('for');

        $mock->__construct('for', 'Iam label',
            ['name' => 'Label', 'id' => 'testing']);
        
        $this->assertEquals( '<label for="for" name="Label" id="testing">Iam label</label>',$mock->getRendered() );
    }
}
