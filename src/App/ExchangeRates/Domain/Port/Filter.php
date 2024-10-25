<?php

namespace App\ExchangeRates\Domain\Port;

use App\ExchangeRates\Domain\Currency\AvailableCurrencies;

class Filter
{
    private $currencies;
    private $date;

    public function __construct(array $currencies, \DateTimeImmutable $date)
    {
        $this->validateCurrencies($currencies);
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

    private function validateCurrencies(array $currencies): void
    {
        foreach ($currencies as $currency) {
            if (!in_array($currency, AvailableCurrencies::getList())) {
                throw new \InvalidArgumentException('Invalid currency');
            }
        }
    }
}
