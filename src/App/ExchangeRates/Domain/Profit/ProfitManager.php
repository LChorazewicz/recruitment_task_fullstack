<?php

namespace App\ExchangeRates\Domain\Profit;

use App\ExchangeRates\Domain\ExchangeRateView;
use App\ExchangeRates\Domain\Port\ExchangeRate;

interface ProfitManager
{
    /** @return ExchangeRateView[] */
    public function modify(ExchangeRate ...$exchangeRates): array;
}
