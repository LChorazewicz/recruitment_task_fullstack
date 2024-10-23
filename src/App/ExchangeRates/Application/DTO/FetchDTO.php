<?php

namespace App\ExchangeRates\Application\DTO;

class FetchDTO
{
    private $currencies;
    private $date;

    public function __construct(array $currencies, \DateTimeImmutable $date)
    {
        $this->currencies = $currencies;
        $this->date = $date;
    }

    public function getCurrencies(): array
    {
        return $this->currencies;
    }

    public function getDate(): \DateTimeImmutable
    {
        return $this->date;
    }
}
