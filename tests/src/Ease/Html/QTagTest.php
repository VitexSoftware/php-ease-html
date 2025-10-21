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

class QTagTest extends PairTagTest
{
    public string $rendered = '<q></q>';
    protected $object;

    protected function setUp(): void
    {
        $this->object = new \Ease\Html\QTag();
    }

    protected function tearDown(): void
    {
    }
}
