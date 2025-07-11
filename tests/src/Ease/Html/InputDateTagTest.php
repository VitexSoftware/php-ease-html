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

use Ease\Html\InputDateTag;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2019-09-06 at 00:00:12.
 */
class InputDateTagTest extends InputTagTest
{
    public string $rendered = '<input name="when" type="date" value="2018-07-22" />';
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp(): void
    {
        $this->object = new InputDateTag('when', '2018-07-22');
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown(): void
    {
    }

    /**
     * @covers \Ease\Html\InputDateTag::__construct
     */
    public function testConstructor(): void
    {
        $object = new InputDateTag('Tag', '2018-07-22', ['name' => 'Tag', 'id' => 'testing']);
        $this->assertEquals(
            '<input name="Tag" id="testing" type="date" value="2018-07-22" />',
            $object->getRendered(),
        );
    }
}
