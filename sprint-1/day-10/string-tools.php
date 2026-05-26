<?php

declare(strict_types=1);

// Take a string, return sentence in reverse
function reverseWords(string $sentence): string
{
    $parts = explode(' ', $sentence);
    $parts = array_reverse($parts);
    $parts = implode(' ', $parts);
    return $parts;
};

function wordFrequency(string $text): array
{
    $parts = explode(' ', $text);
    $count = array_count_values($parts);
    arsort($count);
    return $count;
};

$result =  wordFrequency("кот пес кот кот пес мышь");
print_r($result);
