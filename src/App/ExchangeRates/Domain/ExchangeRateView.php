<?php

namespace App\ExchangeRates\Domain;

class ExchangeRateView
{
    private $code;
    private $name;
    private $sell;
    private $buy;
    private $averagePrice;

    public function __construct(
        string $code,
        string $name,
        float $sell,
        ?float $buy,
        float $averagePrice
    ) {
        $this->code = $code;
        $this->name = $name;
        $this->sell = $sell;
        $this->buy = $buy;
        $this->averagePrice = $averagePrice;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSell(): float
    {
        return $this->sell;
    }

    public function getBuy(): ?float
    {
        return $this->buy;
    }

    public function getAveragePrice(): float
    {
        return $this->averagePrice;
    }
}
