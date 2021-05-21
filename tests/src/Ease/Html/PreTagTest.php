<?php
declare (strict_types=1);

namespace Test\Ease\Html;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2016-01-17 at 23:59:11.
 */
class PreTagTest extends PairTagTest
{
    /**
     * @var PreTag
     */
    protected $object;
    public $rendered = '<pre></pre>';

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp(): void
    {
        $this->object = new \Ease\Html\PreTag();
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown(): void
    {
    }
}
