<?php

namespace App\ExchangeRates\Domain;

interface Currency
{
    public function getBuyPrice(): ?float;
    public function getSellPrice(): float;
}
