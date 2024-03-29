<?php

declare (strict_types=1);

namespace Test\Ease\Html;

use \Ease\Html\Comment;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2019-09-30 at 19:28:57.
 */
class CommentTest extends TagTest {

    /**
     * @var Comment
     */
    protected $object;
    public $rendered = '<!-- Test Comment -->';

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp(): void {
        $this->object = new Comment('Test Comment');
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown(): void {
        
    }

    /**
     * @covers Ease\Html\Comment::__construct
     */
    public function testConstructor() {
        $classname = get_class($this->object);

        // Get mock, without the constructor being called
        $mock = $this->getMockBuilder($classname)
                ->disableOriginalConstructor()
                ->getMockForAbstractClass();
        $mock->__construct('Test');

        $this->assertEquals('<!-- Test -->',
                $mock->getRendered());
    }

    /**
     * @covers Ease\Html\Tag::draw
     */
    public function testDraw($whatWant = null) {
        ob_start();
        $this->object->draw();
        $drawed = ob_get_contents();
        ob_end_clean();
        $this->assertEquals('<!-- Test Comment -->', $drawed);
    }

}
