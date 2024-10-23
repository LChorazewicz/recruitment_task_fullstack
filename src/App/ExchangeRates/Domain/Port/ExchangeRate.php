<?php

namespace App\ExchangeRates\Domain\Port;

class ExchangeRate
{
    private $code;
    private $name;
    private $averagePrice;

    public function __construct(
        string $code,
        string $name,
        float $mid
    )
    {
        $this->code = $code;
        $this->name = $name;
        $this->averagePrice = $mid;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getAveragePrice(): float
    {
        return $this->averagePrice;
    }
}
