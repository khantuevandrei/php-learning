<?php

declare(strict_types=1);

$fruits = ['apple', 'banana', 'orange'];

$numbers = [1, 2, 3, 4, 5];

$doubled = array_map(fn($n) => $n * 2, $numbers);

$even = array_filter($numbers, fn($n) => $n % 2 === 0);

$sum = array_reduce($numbers, fn($carry, $n) => $carry + $n, 0);

in_array(2, $numbers);
array_search(2, $numbers);


$users = [
    ['name' => 'John', 'id' => 1],
    ['name' => 'Maria', 'id' => 2],
];

$maria = array_find($users, fn($u) => $u['name'] === 'Maria');

asort($users);
ksort($users);
usort($users, fn($a, $b) => $a['age'] <=> $b['age']);

$arr = [3, 1, 4, 1, 5, 9];

sort($arr);
rsort($arr);

$arr1 = ['a' => 1, 'b' => 2];
$arr2 = ['b' => 3, 'c' => 4];

$merged = array_merge($arr1, $arr2);

$arr3 = [1, 2];
$arr4 = [3, 4];
array_merge($arr3, $arr4);

$user = ['name' => 'John', 'age' => 30];

array_keys($user);
array_values($user);

array_key_exists('name', $user);

$arr = ['a' => 1, 'b' => 2, 'c' => 1];
array_flip($arr);

$arr = [1, 2, 3, 4, 5];

count($arr);
array_sum($arr);
array_product($arr);
min($arr);
max($arr);

$fruits = ['apple', 'banana', 'orange'];
[$first, $second, $third] = $fruits;

[,, $third] = $fruits;

$user = ['name' => 'Ivan', 'age' => 30, 'email' => 'ivan@example.com'];
['name' => $name, 'age' => $age] = $user;

$str = "  Hello, World!  ";

trim($str);
ltrim($str);
rtrim($str);

strlen('hello');
mb_strlen('hello');

strpos("Hello, World!", "World");
str_contains("Hello, World!", "Hello");
str_starts_with("Hello, World!", "Hello");
str_ends_with("Hello, World!", ' World!');

substr("Hello, World!", 0, 5);
substr("Hello World", -6);

str_replace("World", "PHP", "Hello, World!");
str_ireplace('world', 'PHP', 'Hello, World!');

strtoupper("hello");
strtolower('HELLO');
mb_strtoupper('hello');
ucfirst("hello");
lcfirst("Hello");

$parts = explode(", ", "apple, banana, orange");
$str = implode(" | ", $parts);

sprintf("Hello, %s! You're %d.", "John", 30);
