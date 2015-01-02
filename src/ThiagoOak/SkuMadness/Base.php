<?php

namespace ThiagoOak\SkuMadness;

class Base
{
    protected $chars;

    protected function checkBaseString($string)
    {
        if (strlen($string) < 2) {
            throw new \InvalidArgumentException("base must be at least 2 chars long");
        }

        $array = str_split($string);

        $arrayCountValues = array_count_values($array);

        $duplicates = array_filter($arrayCountValues, function ($item) {
            if ($item > 1) {
                return $item;
            }
        });

        if (count($duplicates) > 0) {
            throw new \InvalidArgumentException("$string contains duplicated chars");
        }
    }

    public function setChars($string)
    {
        $this->checkBaseString($string);
        $this->chars = $string;
    }

    public function getChars()
    {
        return $this->chars;
    }

    public function getCharsArray()
    {
        return str_split($this->getChars());
    }

    public function getLen()
    {
        return strlen($this->getChars());
    }
}
