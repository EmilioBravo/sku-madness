<?php

namespace ThiagoOak\SkuMadness;

class SkuTest extends \PHPUnit_Framework_TestCase
{
    public function testShortSku()
    {
        $sku = new Sku('ABCDE', 5);

        $this->assertEquals('BAAAA', $sku->generate(0));
        $this->assertEquals('BAAAB', $sku->generate(1));
        $this->assertEquals('BAAAC', $sku->generate(2));
    }

    public function testOutOfBoundsSku()
    {
        $this->setExpectedException('\OutOfBoundsException');

        $sku = new Sku('ABCDE', 5);
        $sku->generate(2500);
    }
}
