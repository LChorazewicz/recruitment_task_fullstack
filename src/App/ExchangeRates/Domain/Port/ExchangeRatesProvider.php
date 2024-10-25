<?php

namespace App\ExchangeRates\Domain\Port;

interface ExchangeRatesProvider
{
    /** @return ExchangeRate[] */
    public function fetch(Filter $filter): array;
}
