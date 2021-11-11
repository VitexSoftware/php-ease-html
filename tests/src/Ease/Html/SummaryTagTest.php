<?php

declare (strict_types=1);

namespace Test\Ease\Html;

use Ease\Html\SummaryTag;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2016-01-17 at 23:59:27.
 */
class SummaryTagTest extends PairTagTest {

    /**
     * @var SummaryTag
     */
    protected $object;
    public $rendered = '<summary></summary>';

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp(): void {
        $this->object = new SummaryTag();
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown(): void {
        
    }

}
