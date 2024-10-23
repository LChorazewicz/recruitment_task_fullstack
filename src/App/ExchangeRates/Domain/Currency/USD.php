<?php

namespace App\ExchangeRates\Domain\Currency;

use App\ExchangeRates\Domain\Currency;

class USD implements Currency
{
    private $averagePrice;

    public function __construct(float $averagePrice)
    {
        $this->averagePrice = $averagePrice;
    }

    public function getBuyPrice(): ?float
    {
        return $this->averagePrice - 0.05;
    }

    public function getSellPrice(): float
    {
        return $this->averagePrice + 0.07;
    }
}
