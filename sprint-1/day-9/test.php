<?php

declare(strict_types=1);

$fruits = ['apple', 'banana', 'coconut'];

foreach ($fruits as $fruit) {
    echo "$fruit\n";
};

foreach ($fruits as $index => $fruit) {
    echo "$index. $fruit\n";
};
