<?php

declare(strict_types=1);

// Page visit counter
function visit(): int
{
    static $count = 0;
    $count++;
    return $count;
}

echo visit() . "\n"; // 1
echo visit() . "\n"; // 2
echo visit() . "\n"; // 3