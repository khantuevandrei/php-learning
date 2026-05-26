<?php

declare(strict_types=1);

// Take string, separator and return an array
function csvToArray(string $csv, string $separator = ','): array
{
    return explode($separator, $csv);
};

// Take an array, separator and return a string
function arrayToCsv(array $data, string $separator = ','): string
{
    return implode($separator, $data);
};

print_r(arrayToCsv(['apple', 'banana']));
