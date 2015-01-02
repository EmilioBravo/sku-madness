<?php

namespace ThiagoOak\SkuMadness;

class Sku
{
    protected $base;
    protected $len;
    protected $first;
    protected $last;

    public function __construct($baseChars, $skuLen = 10)
    {
        $this->base = new Base();
        $this->base->setChars($baseChars);

        $this->len = $skuLen;

        $this->calculateFirst();
        $this->calculateLast();
    }

    /**
     * returns information about the current base and the ammount of
     * skus that can be generated
     */
    public function explain()
    {
        $data = array(
            'base'         => $this->base->getChars(),
            'baseLen'      => $this->base->getLen(),
            'skuLen'       => $this->len,
            'firstSku'     => $this->generate(0),
            'lastSku'      => $this->generate(bcsub($this->getLast(), $this->getFirst())),
            'possibleSkus' => bcsub($this->getLast(), $this->getFirst())
        );

        return $data;
    }

    public function generate($from)
    {
        if ($from  < 0) {
            throw new \InvalidArgumentException("Only positive numbers or zero please");
        }

        $result = '';
        $remaining = bcadd($this->getFirst(), $from);

        if (bccomp($remaining, $this->getLast()) == 1) {
            throw new \OutOfBoundsException("{$from} exceeds the ammount of possible skus on this base with length {$this->len}");
        }

        if ($remaining == 0) {
            return $this->base->getCharsArray()[0];
        }

        while (bccomp($remaining, '0') == 1) {
            $mod = bcmod($remaining, $this->base->getLen());
            $remaining = bcdiv($remaining, $this->base->getLen());
            $result .= $this->base->getCharsArray()[$mod];
        }

        return strrev($result);
    }

    /**
     * first number on base 10 that when converted to $this->base
     * has $this->len chars in lenght
     */
    public function getFirst()
    {
        return $this->first;
    }

    /**
     * last number on base 10 that when converted to $this->base
     * has $this->len chars in lenght
     */
    public function getLast()
    {
        return $this->last;
    }

    /**
     * calculates the first number on base 10 that when converted to $this->base
     * has $this->len chars in lenght
     */
    private function calculateFirst()
    {
        $this->first = bcpow($this->base->getLen(), $this->len - 1);
    }

    /**
     * calculates the last number on base 10 that when converted to $this->base
     * has $this->len chars in lenght
     */
    private function calculateLast()
    {
        $this->last = bcsub(bcpow($this->base->getLen(), $this->len), 1);
    }

}
