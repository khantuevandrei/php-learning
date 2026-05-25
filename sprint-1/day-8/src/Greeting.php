<?php

namespace App;

class Greeting
{
    public static function getGreeting(): string
    {
        $hour = (int)date('H');

        return match (true) {
            $hour < 6  => 'Доброй ночи',
            $hour < 12 => 'Доброе утро',
            $hour < 18 => 'Добрый день',
            default    => 'Добрый вечер',
        };
    }
}
