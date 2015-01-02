# SKU madness

SKU generation using base conversion

## usage

```php
<?php
$skuValidChars = 'ABCDE';
$skuLenght     = 5;
$skuMadness    = new \ThiagoOak\SkuMadness\Sku($skuValidChars, $skuLenght);

$skuMadness->generate(0); // BAAAA
$skuMadness->generate(1); // BAAAB
$skuMadness->generate(2); // BAAAC

$skuMadness->explain();
/*
    Array
    (
        [base] => ABCDE
        [baseLen] => 5
        [skuLen] => 5
        [firstSku] => BAAAA
        [lastSku] => EEEEE
        [possibleSkus] => 2499
    )
*/
```