<?php

namespace App\ExchangeRates\Domain\Currency;

use App\ExchangeRates\Domain\Currency;

class CZK implements Currency
{
    private $averagePrice;

    public function __construct(float $averagePrice)
    {
        $this->averagePrice = $averagePrice;
    }

    public function getBuyPrice(): ?float
    {
        return null;
    }

    public function getSellPrice(): float
    {
        return $this->averagePrice + 0.15;
    }
}
