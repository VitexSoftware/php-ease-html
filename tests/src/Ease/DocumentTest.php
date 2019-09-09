<?php

namespace Test\Ease;

use Ease\Document;
use Ease\Html\ATag;
use Ease\Html\DivTag;
use Ease\Shared;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2016-01-17 at 23:58:37.
 */
class DocumentTest extends ContainerTest
{
    /**
     * @var Document
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp(): void
    {
        $this->object = new Document();
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown(): void
    {
        
    }

    /**
     * @covers Ease\Document::singleton
     */
    public function testSingleton()
    {
        if (get_class($this->object) == 'Ease\Document') {
            $this->assertInstanceOf(get_class($this->object),
                Document::singleton());
        }
    }

    /**
     * @covers Ease\Document::addJavaScript
     */
    public function testAddJavaScript()
    {
        \Ease\WebPage::singleton()->javaScripts = [];
        $this->assertEquals(0, $this->object->addJavaScript('alert("hallo");'));
        $this->assertEquals(0,
            $this->object->addJavaScript('alert("world");', false));
    }

    /**
     * @covers Ease\Document::includeJavaScript
     */
    public function testIncludeJavaScript()
    {
        $this->assertEquals(0, $this->object->includeJavaScript('test.js'));
    }

    /**
     * @covers Ease\Document::addCSS
     */
    public function testAddCSS()
    {
        $this->assertTrue($this->object->addCSS('.test {color:red;}'));
    }

    /**
     * @covers Ease\Document::includeCss
     */
    public function testIncludeCss()
    {
        $this->assertEquals(1, $this->object->includeCss('test.css'));
    }

    /**
     * @covers Ease\Document::redirect
     */
    public function testRedirect()
    {
        $this->assertEquals(0, $this->object->redirect('http://v.s.cz/'));
    }

    /**
     * @covers Ease\Document::getUri
     */
    public function testGetUri()
    {
        $_SERVER['REQUEST_URI'] = 'test';
        $this->assertEquals('test', Document::getUri());
    }

    /**
     * @covers Ease\Document::phpSelf
     */
    public function testPhpSelf()
    {
        $this->assertEquals('', Document::phpSelf());
    }

    /**
     * @covers Ease\Document::onlyForLogged
     */
    public function testOnlyForLogged()
    {
        $this->assertEquals(0, $this->object->onlyForLogged());
    }

    /**
     * @covers Ease\Document::getRequestValues
     */
    public function testGetRequestValues()
    {
        $_REQUEST = ['a' => 1, 'b' => 2];
        $this->assertEquals(['a' => 1, 'b' => 2],
            $this->object->getRequestValues());
    }

    /**
     * @covers Ease\Document::isPosted
     */
    public function testIsPosted()
    {
        $_SERVER['REQUEST_METHOD'] = 'test';
        $this->assertFalse(Document::isPosted());
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $this->assertTrue(Document::isPosted());
    }

    /**
     * @covers Ease\Document::sanitizeAsType
     */
    public function testSanitizeAsType()
    {
        $this->assertInternalType('string',
            $this->object->sanitizeAsType('123', 'string'));
        $this->assertInternalType('integer',
            $this->object->sanitizeAsType('123', 'int'));
        $this->assertInternalType('boolean',
            $this->object->sanitizeAsType('0', 'boolean'));
        $this->assertFalse($this->object->sanitizeAsType('FALSE', 'boolean'));
        $this->assertTrue($this->object->sanitizeAsType('true', 'boolean'));
        $this->assertInternalType('float',
            $this->object->sanitizeAsType('1.45', 'float'));
        $this->assertNull($this->object->sanitizeAsType('', 'int'));
        $this->assertEquals('test',
            $this->object->sanitizeAsType('test', 'null'));
    }

    /**
     * @covers Ease\Document::getRequestValue
     */
    public function testGetRequestValue()
    {
        $_REQUEST['test'] = 'lala';
        $this->assertEquals('lala', $this->object->getRequestValue('test'));
    }

    /**
     * @covers Ease\Document::getGetValue
     */
    public function testGetGetValue()
    {
        $_GET['test'] = 'lolo';
        $this->assertEquals('lolo', $this->object->getGetValue('test'));
    }

    /**
     * @covers Ease\Document::getPostValue
     */
    public function testGetPostValue()
    {
        $_POST['test'] = 'lili';
        $this->assertEquals('lili', $this->object->getPostValue('test'));
    }

    /**
     * @covers Ease\Document::isFormPosted
     */
    public function testIsFormPosted()
    {
        unset($_POST);
        $this->assertFalse($this->object->isFormPosted());
        $_POST['test'] = 'lili';
        $this->assertTrue($this->object->isFormPosted());
    }

    /**
     * @covers Ease\Document::arrayToUrlParams
     */
    public function testArrayToUrlParams()
    {
        $this->assertEquals('http://v.s.cz/?a=1&b=2',
            $this->object->arrayToUrlParams(['a' => 1, 'b' => 2],
                'http://v.s.cz/'));
        $this->assertEquals('http://v.s.cz/?d=3&a=1&b=2',
            $this->object->arrayToUrlParams(['a' => 1, 'b' => 2],
                'http://v.s.cz/?d=3'));
    }

    /**
     * @covers Ease\Document::addItem
     */
    public function testAddItem()
    {
        Document::$pageClosed = false;
        parent::testAddItem();
        Document::$pageClosed = true;
        $this->assertNull($this->object->addItem(new DivTag('test')));
        Document::$pageClosed = false;
    }

    /**
     * @covers Ease\Document::registerItem
     */
    public function testRegisterItem()
    {
        $item = new ATag('#');
        Document::registerItem($item);
        $this->assertInstanceOf(get_class($item), end(Document::$allItems));
    }
}
