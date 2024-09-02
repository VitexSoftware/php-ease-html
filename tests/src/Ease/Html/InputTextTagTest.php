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

namespace Test\Ease\Html;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2016-01-17 at 23:58:46.
 */
class InputTextTagTest extends InputTagTest
{
    public $rendered = '<input type="text" name="test" />';
    protected InputTextTag $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp(): void
    {
        $this->object = new \Ease\Html\InputTextTag('test');
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown(): void
    {
    }

    /**
     * @covers \Ease\Html\InputTextTag::__construct
     */
    public function testConstructor(): void
    {
        $classname = \get_class($this->object);

        // Get mock, without the constructor being called
        $mock = $this->getMockBuilder($classname)
            ->disableOriginalConstructor()
            ->getMockForAbstractClass();

        $mock->__construct('Tag', 'secret', ['name' => 'Tag', 'id' => 'testing']);

        $this->assertEquals(
            '<input name="Tag" id="testing" type="text" value="secret" />',
            $mock->getRendered(),
        );
    }
}
