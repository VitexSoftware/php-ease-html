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

use Ease\Html\ATag;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2016-01-17 at 23:59:15.
 */
class ATagTest extends PairTagTest
{
    /**
     * What we want to get ?
     */
    public string $rendered = '<a href="http://v.s.cz/">Vitex Software</a>';
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp(): void
    {
        $this->object = new ATag('http://v.s.cz/', 'Vitex Software');
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown(): void
    {
    }

    public function testConstructor(): void
    {
        $classname = \get_class($this->object);

        // Get mock, without the constructor being called
        $mock = $this->getMockBuilder($classname)
            ->disableOriginalConstructor()
            ->getMockForAbstractClass();

        $mock->__construct('#test');
        $mock->__construct('http://v.s.cz/', 'Initial Content');
        $mock->__construct('https://php.net', 'PHP', ['title' => 'test']);

        $this->assertEquals(
            '<a href="https://php.net" title="test">Initial ContentPHP</a>',
            $mock->getRendered(),
        );
    }
}
