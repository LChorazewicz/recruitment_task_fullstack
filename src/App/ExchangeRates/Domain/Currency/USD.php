<?php

namespace App\ExchangeRates\Domain\Currency;

use App\ExchangeRates\Domain\Currency;

class USD implements Currency
{
    private $averagePrice;
    private $buyProfit;
    private $sellProfit;

    public function __construct(float $averagePrice, float $buyProfit, float $sellProfit)
    {
        $this->averagePrice = $averagePrice;
        $this->buyProfit = $buyProfit;
        $this->sellProfit = $sellProfit;
    }

    public function getBuyPrice(): ?float
    {
        return $this->averagePrice - $this->buyProfit;
    }

    public function getSellPrice(): float
    {
        return $this->averagePrice + $this->sellProfit;
    }
}
