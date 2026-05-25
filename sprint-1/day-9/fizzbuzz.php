<?php

declare(strict_types=1);

function fizzbuzz(int $n): string
{
    if ($n % 3 === 0 && $n % 5 === 0) return 'FizzBuzz';
    if ($n % 3 === 0) return 'Fizz';
    if ($n % 5 === 0) return 'Buzz';
    return "$n";
};

for ($i = 1; $i <= 20; $i++) {
    echo fizzbuzz($i) . "\n";
}
