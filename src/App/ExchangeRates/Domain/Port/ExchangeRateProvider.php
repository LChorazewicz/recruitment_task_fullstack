<?php

namespace App\ExchangeRates\Domain\Port;

interface ExchangeRateProvider
{
    /** @return ExchangeRate[] */
    public function fetch(Filter $filter): array;
}
