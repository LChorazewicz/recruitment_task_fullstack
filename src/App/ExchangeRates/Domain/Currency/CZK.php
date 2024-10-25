<?php

namespace App\ExchangeRates\Domain\Currency;

use App\ExchangeRates\Domain\Currency;

class CZK implements Currency
{
    private $averagePrice;
    private $sellProfit;

    public function __construct(float $averagePrice, float $sellProfit)
    {
        $this->averagePrice = $averagePrice;
        $this->sellProfit = $sellProfit;
    }

    public function getBuyPrice(): ?float
    {
        return null;
    }

    public function getSellPrice(): float
    {
        return $this->averagePrice + $this->sellProfit;
    }
}
