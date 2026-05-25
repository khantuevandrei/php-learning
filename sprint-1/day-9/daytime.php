<?php

declare(strict_types=1);

function getDayTime(int $hour): string
{
    return match (true) {
        $hour >= 0 && $hour < 6 => 'Night',
        $hour >= 6 && $hour < 12 => 'Morning',
        $hour >= 12 && $hour < 18 => 'Day',
        $hour >= 18 && $hour < 24 => 'Evening'
    };
};

echo getDayTime(3);
echo getDayTime(10);
echo getDayTime(15);
echo getDayTime(20);
