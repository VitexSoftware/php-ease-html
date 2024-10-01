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
 * Generated by PHPUnit_SkeletonGenerator on 2019-09-05 at 22:56:43.
 */
class InputMonthTagTest extends InputTagTest
{
    public string $rendered = '<input name="test" type="month" value="06" />';
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp(): void
    {
        $this->object = new \Ease\Html\InputMonthTag('test', '06');
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown(): void
    {
    }

    /**
     * @covers \Ease\Html\InputMonthTag::__construct
     */
    public function testConstructor(): void
    {
        $classname = \get_class($this->object);

        // Get mock, without the constructor being called
        $mock = $this->getMockBuilder($classname)
            ->disableOriginalConstructor()
            ->getMockForAbstractClass();

        $mock->__construct(
            'Tag',
            'info@vitexsoftware.cz',
            ['name' => 'Tag', 'id' => 'testing'],
        );

        $this->assertEquals(
            '<input name="Tag" id="testing" type="month" value="info@vitexsoftware.cz" />',
            $mock->getRendered(),
        );
    }

    /**
     * @covers \Ease\Html\InputNumberTag::draw
     *
     * @param null|mixed $whatWant
     */
    public function testDraw($whatWant = null): void
    {
        parent::testDraw($this->rendered);
    }
}
