<?php

declare(strict_types=1);
// Take a factor and return a anon fn multiplying a number on that factor
function createMultiplier(int $factor): callable
{
    return fn($n) => $n * $factor;
};

$double = createMultiplier(2);
$triple = createMultiplier(3);

echo $double(5) . "\n"; // 10
echo $triple(5) . "\n"; // 15

// Use array_filter with anon fn
$numbers = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];

$modified = array_filter($numbers, fn($n) => $n % 3 === 0);
print_r($modified);

// Use arrow fn for array_map
$names = ['bob', 'maria', 'john', 'anna'];

$result = array_map(fn($n) => ucfirst($n), $names);
print_r($result);
