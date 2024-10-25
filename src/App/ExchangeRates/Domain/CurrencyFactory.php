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
                return new USD($averagePrice, 0.05, 0.07);
            case 'EUR':
                return new EUR($averagePrice, 0.05, 0.07);
            case 'CZK':
                return new CZK($averagePrice, 0.15);
            case 'IDR':
                return new IDR($averagePrice, 0.15);
            case 'BRL':
                return new BRL($averagePrice, 0.15);
            default:
                throw new \InvalidArgumentException('Invalid currency code');
        }
    }
}
