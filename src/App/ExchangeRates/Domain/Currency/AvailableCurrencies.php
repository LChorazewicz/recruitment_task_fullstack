<?php

namespace App\ExchangeRates\Domain\Currency;

class AvailableCurrencies
{
    public static function getList(): array
    {
        return [EUR::NAME, USD::NAME, CZK::NAME, IDR::NAME, BRL::NAME];
    }
}
