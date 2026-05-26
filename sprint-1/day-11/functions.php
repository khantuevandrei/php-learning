<?php

declare(strict_types=1);

function celsiusToFahrenheit(float $celsius): float
{
    return $celsius * 9 / 5 + 32;
}

function isPasswordValid(string $password): bool
{
    return preg_match('/^(?=.*[A-Z])(?=.*\d).{8,}$/', $password) === 1;
}

function average(int ...$numbers): float
{
    $sum = array_sum($numbers);
    $count = count($numbers);
    return $count === 0 ? 0.0 : $sum / $count;
}

function formatPrice(float $amount, string $currency = 'USD', int $decimals = 2): string
{
    return number_format($amount, $decimals, '.') . ' ' . $currency;
}

echo celsiusToFahrenheit(0) . "\n";     // 32.0
echo celsiusToFahrenheit(100) . "\n";   // 212.0
var_dump(isPasswordValid("Short1"));    // false (меньше 8)
var_dump(isPasswordValid("longpassword")); // false (нет цифры)
var_dump(isPasswordValid("Valid1Password")); // true
echo average(1, 2, 3, 4, 5) . "\n";    // 3.0
echo average() . "\n";                   // 0.0
echo formatPrice(10) . "\n";            // 10.00 USD
echo formatPrice(amount: 5.5, currency: 'EUR') . "\n"; // 5.50 EUR