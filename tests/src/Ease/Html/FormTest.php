<?php

declare (strict_types=1);

namespace Test\Ease\Html;

use Ease\Html\Form;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2016-01-17 at 23:59:19.
 */
class FormTest extends PairTagTest {

    /**
     * @var Form
     */
    protected $object;
    public $rendered = '<form name="test" action="test.php" method="POST"></form>';

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp(): void {
        $this->object = new \Ease\Html\Form(['name' => 'test', 'action' => 'test.php']);
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown(): void {
        
    }

    public function testConstructor() {
        $classname = get_class($this->object);
        $mock = $this->getMockBuilder($classname)
                ->disableOriginalConstructor()
                ->getMockForAbstractClass();
        $mock->__construct(['name' => 'Tag', 'id' => 'testing']);
        $mock->__construct(['name' => 'Tag', 'id' => 'testing'], 'Initial Content');
        $this->assertFalse(empty($mock->getRendered()));
    }

    /**
     * @covers Ease\Html\Form::setFormTarget
     *
     * @todo   Implement testSetFormTarget().
     */
    public function testSetFormTarget() {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
                'This test has not been implemented yet.'
        );
    }

    /**
     * @covers Ease\Html\Form::changeActionParameter
     *
     * @todo   Implement testChangeActionParameter().
     */
    public function testChangeActionParameter() {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
                'This test has not been implemented yet.'
        );
    }

    /**
     * @covers Ease\Html\Form::objectContentSearch
     *
     * @todo   Implement testObjectContentSearch().
     */
    public function testObjectContentSearch() {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
                'This test has not been implemented yet.'
        );
    }

    /**
     * @covers Ease\Html\Form::finalize
     *
     * @todo   Implement testFinalize().
     */
    public function testFinalize() {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
                'This test has not been implemented yet.'
        );
    }

    /**
     * @covers Ease\Html\Form::fillUp
     */
    public function testFillUp() {
        $this->object->emptyContents();
        $this->object->fillUp(['a' => 1, 'b' => 2]);
        $this->assertEquals('<form name="test" action="test.php" method="POST"></form>',
                $this->object->getRendered());
        $this->object->addItem(new \Ease\Html\InputTag('a'));
        $this->object->addItem(new \Ease\Html\InputTag('b'));
        $this->object->fillUp(['a' => 1, 'b' => 2]);
        $this->assertEquals('<form name="test" action="test.php" method="POST"><input name="a" value="1" /><input name="b" value="2" /></form>',
                $this->object->getRendered());
    }

    /**
     * @covers Ease\Html\Form::fillMeUp
     */
    public function testFillMeUp() {
        $this->object->emptyContents();
        $this->object->addItem(new \Ease\Html\InputTag('a'));
        $this->object->addItem(new \Ease\Html\InputTag('b'));
        \Ease\Html\Form::fillMeUp(['a' => 1, 'b' => 2], $this->object);
        $this->assertEquals('<form name="test" action="test.php" method="POST"><input name="a" value="1" /><input name="b" value="2" /></form>',
                $this->object->getRendered());
    }

    /**
     * @covers Ease\Html\Form::getTagName
     */
    public function testGetTagName() {
        $this->assertEquals('test', $this->object->getTagName());
        $this->object->setName = true;
        $this->object->setTagName('Test');
        $this->assertEquals('Test', $this->object->getTagName());
    }

}
