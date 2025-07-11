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
 * Generated by PHPUnit_SkeletonGenerator on 2016-01-17 at 23:59:06.
 */
class CheckboxTagTest extends InputTagTest
{
    public string $rendered = '<input type="checkbox" checked name="test" />';
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp(): void
    {
        $this->object = new \Ease\Html\CheckboxTag('test', true);
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown(): void
    {
    }

    /**
     * @covers \Ease\Html\CheckboxTag::setValue
     */
    public function testSetValue(): void
    {
        $this->object->setValue(true);
        $this->assertEquals('1', $this->object->getValue());
        $this->object->setValue(false);
        $this->assertEquals('0', $this->object->getValue());
    }

    /**
     * @covers \Ease\Html\CheckboxTag::getValue
     */
    public function testGetValue(): void
    {
        $this->object->setValue(true);
        $this->assertEquals('1', $this->object->getValue());
        $this->object->setValue(false);
        $this->assertEquals('0', $this->object->getValue());
    }

    /**
     * @covers \Ease\Html\CheckboxTag::__construct
     */
    public function testConstructor(): void
    {
        $object = new \Ease\Html\CheckboxTag('Tag', true, 'value', ['name' => 'Tag', 'id' => 'testing']);
        $this->assertEquals(
            '<input name="Tag" id="testing" type="checkbox" checked value="value" />',
            $object->getRendered(),
        );
    }

    /**
     * @covers \Ease\Html\CheckBoxTag::draw
     *
     * @param null|mixed $whatWant
     */
    public function testDraw($whatWant = null): void
    {
        $this->assertEquals($this->rendered, $this->object->getRendered());
    }
}
