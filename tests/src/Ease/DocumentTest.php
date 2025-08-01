<?php

declare(strict_types=1);

/**
 * This file is part of the EaseHtml package
 *
 * https://github.com/VitexSoftware/php-ease-html
 *
 * (c) Vítězslav Dvořák <http://vitexsoftware.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Test\Ease;

use Ease\Document;
use Ease\Html\ATag;
use Ease\Html\DivTag;
use Ease\WebPage;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2016-01-17 at 23:58:37.
 */
class DocumentTest extends ContainerTest
{
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp(): void
    {
        Document::singleton()->javaScripts = [];
        WebPage::singleton()->cascadeStyles = [];
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
     * @covers \Ease\Document::singleton
     */
    public function testSingleton(): void
    {
        if (\get_class($this->object) === 'Ease\Document') {
            $this->assertInstanceOf(
                \get_class($this->object),
                Document::singleton(),
            );
        } else {
            $this->assertIsObject(Document::singleton());
        }
    }

    /**
     * @covers \Ease\Document::addJavaScript
     */
    public function testAddJavaScript(): void
    {
        WebPage::singleton()->javaScripts = [];
        $this->assertEquals(0, $this->object->addJavaScript('alert("hallo");'));
        $this->assertEquals(
            0,
            $this->object->addJavaScript('alert("Document");', null, false),
        );
    }

    /**
     * @covers \Ease\Document::includeJavaScript
     * @covers \Ease\WebPage::clearJavaScriptsCache
     */
    public function testIncludeJavaScript(): void
    {
        \Ease\WebPage::clearJavaScriptsCache();
        $this->assertEquals(0, $this->object->includeJavaScript('Document.js'));
        $this->assertTrue(\Ease\WebPage::clearJavaScriptsCache());
    }

    /**
     * @covers \Ease\Document::addCSS
     */
    public function testAddCSS(): void
    {
        $this->assertTrue($this->object->addCSS('.Document {color:red;}'));
        WebPage::singleton()->cascadeStyles = [];
    }

    /**
     * @covers \Ease\Document::includeCss
     */
    public function testIncludeCss(): void
    {
        $this->assertTrue($this->object->includeCss('Document.css'));
        WebPage::singleton()->cascadeStyles = [];
    }

    /**
     * @covers \Ease\Document::redirect
     */
    public function testRedirect(): void
    {
        $this->assertEquals(0, $this->object->redirect('http://v.s.cz/'));
        $this->assertTrue(Document::$pageClosed);
        Document::$pageClosed = false;
        WebPage::singleton()->javaScripts = [];
    }

    /**
     * @covers \Ease\Document::getUri
     */
    public function testGetUri(): void
    {
        $_SERVER['REQUEST_URI'] = 'test';
        $this->assertEquals('test', Document::getUri());
    }

    /**
     * @covers \Ease\Document::phpSelf
     */
    public function testPhpSelf(): void
    {
        $this->assertEquals('', Document::phpSelf());
    }

    /**
     * @covers \Ease\Document::makePagePublic
     * @covers \Ease\Document::onlyForLogged
     */
    public function testOnlyForLogged(): void
    {
        $backup = $this->object;
        $this->assertEquals(1, $this->object->onlyForLogged());
        $this->assertTrue(Document::$pageClosed);
        $this->assertEquals(1, $this->object->onlyForLogged('login.php', 'test message'));
        $this->assertTrue($this->object->makePagePublic());
        $this->object = $backup;
    }

    /**
     * @covers \Ease\Document::getRequestValues
     */
    public function testGetRequestValues(): void
    {
        $_REQUEST = ['a' => 1, 'b' => 2];
        $this->assertEquals(
            ['a' => 1, 'b' => 2],
            $this->object->getRequestValues(),
        );
    }

    /**
     * @covers \Ease\Document::isPosted
     */
    public function testIsPosted(): void
    {
        $_SERVER['REQUEST_METHOD'] = 'test';
        $this->assertFalse(Document::isPosted());
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $this->assertTrue(Document::isPosted());
    }

    /**
     * @covers \Ease\Document::sanitizeAsType
     */
    public function testSanitizeAsType(): void
    {
        $this->assertIsString($this->object->sanitizeAsType('123', 'string'));
        $this->assertIsInt($this->object->sanitizeAsType('123', 'int'));
        $this->assertIsBool($this->object->sanitizeAsType('0', 'boolean'));
        $this->assertFalse($this->object->sanitizeAsType('FALSE', 'boolean'));
        $this->assertTrue($this->object->sanitizeAsType('true', 'boolean'));
        $this->assertIsFloat($this->object->sanitizeAsType('1.45', 'float'));
        $this->assertNull($this->object->sanitizeAsType('', 'int'));
        $this->assertEquals(
            'test',
            $this->object->sanitizeAsType('test', 'null'),
        );
    }

    /**
     * @covers \Ease\Document::getRequestValue
     */
    public function testGetRequestValue(): void
    {
        $_REQUEST['test'] = 'lala';
        $this->assertEquals('lala', $this->object->getRequestValue('test'));
    }

    /**
     * @covers \Ease\Document::getGetValue
     */
    public function testGetGetValue(): void
    {
        $_GET['test'] = 'lolo';
        $this->assertEquals('lolo', $this->object->getGetValue('test'));
    }

    /**
     * @covers \Ease\Document::getPostValue
     */
    public function testGetPostValue(): void
    {
        $_POST['test'] = 'lili';
        $this->assertEquals('lili', $this->object->getPostValue('test'));
    }

    /**
     * @covers \Ease\Document::isFormPosted
     */
    public function testIsFormPosted(): void
    {
        unset($_POST);
        $this->assertFalse($this->object->isFormPosted());
        $_POST['test'] = 'lili';
        $this->assertTrue($this->object->isFormPosted());
    }

    /**
     * @covers \Ease\Document::arrayToUrlParams
     */
    public function testArrayToUrlParams(): void
    {
        $this->assertEquals(
            'http://v.s.cz/?a=1&b=2',
            $this->object->arrayToUrlParams(
                ['a' => 1, 'b' => 2],
                'http://v.s.cz/',
            ),
        );
        $this->assertEquals(
            'http://v.s.cz/?d=3&a=1&b=2',
            $this->object->arrayToUrlParams(
                ['a' => 1, 'b' => 2],
                'http://v.s.cz/?d=3',
            ),
        );
    }

    /**
     * @covers \Ease\Document::addItem
     */
    public function testAddItem(): void
    {
        Document::$pageClosed = false;
        parent::testAddItem();
        Document::$pageClosed = true;
        $this->assertNull($this->object->addItem(new DivTag('test')));
        Document::$pageClosed = false;
    }

    /**
     * @covers \Ease\Document::registerItem
     */
    public function testRegisterItem(): void
    {
        $item = new ATag('#');
        Document::registerItem($item);
        $this->assertInstanceOf($item::class, end(Document::$allItems));
    }
}
