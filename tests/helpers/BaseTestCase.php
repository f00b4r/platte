<?php

use Mockista\Registry;
use Tester\TestCase;

abstract class BaseTestCase extends TestCase
{

    /** @var Registry */
    protected $mockista;

    /**
     * This method is called before a test is executed.
     *
     * @return void
     */
    protected function setUp()
    {
        $this->mockista = new Registry();
    }

    /**
     * This method is called after a test is executed.
     *
     * @return void
     */
    protected function tearDown()
    {
        $this->mockista->assertExpectations();
    }

}
