<?php

namespace App\ExchangeRates\Domain;

class Currencies
{
    public static function getAvailable(): array
    {
        return ['EUR', 'USD', 'CZK', 'IDR', 'BRL'];
    }
}
