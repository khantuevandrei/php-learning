<?php

declare(strict_types=1);

$numbers = [10, 20, 30];

foreach ($numbers as &$number) {
    $number *= 2;
};

print_r($numbers);

unset($number);

foreach ($numbers as $number) {
    echo $number . "\n";
}
