<?php

namespace App\ExchangeRates\Domain;

use App\ExchangeRates\Domain\Currency\BRL;
use App\ExchangeRates\Domain\Currency\CZK;
use App\ExchangeRates\Domain\Currency\EUR;
use App\ExchangeRates\Domain\Currency\IDR;
use App\ExchangeRates\Domain\Currency\USD;

class CurrencyFactory
{
    public static function create(string $code, float $averagePrice): Currency
    {
        switch ($code) {
            case 'USD':
                return new USD($averagePrice);
            case 'EUR':
                return new EUR($averagePrice);
            case 'CZK':
                return new CZK($averagePrice);
            case 'IDR':
                return new IDR($averagePrice);
            case 'BRL':
                return new BRL($averagePrice);
            default:
                throw new \InvalidArgumentException('Invalid currency code');
        }
    }
}
