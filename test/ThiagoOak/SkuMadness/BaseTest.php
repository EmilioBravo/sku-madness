<?php

namespace ThiagoOak\SkuMadness;

class BaseTest extends \PHPUnit_Framework_TestCase
{
    public function testSimpleBase()
    {
        $base = new Base();
        $base->setChars('0123456789');
        $this->assertEquals('0123456789', $base->getChars());
    }

    public function testSimpleBaseWithDuplicateChars()
    {
        $this->setExpectedException('\InvalidArgumentException');

        $base = new Base();
        $base->setChars('0123567897');
    }
}
