<?php

namespace App\ExchangeRates\Domain\Profit;

use App\ExchangeRates\Domain\CurrencyFactory;
use App\ExchangeRates\Domain\ExchangeRateView;
use App\ExchangeRates\Domain\Port\ExchangeRate;

class ProfitManagerImpl implements ProfitManager
{
    public function modify(ExchangeRate ...$exchangeRates): array
    {
        $result = [];
        foreach ($exchangeRates as $item) {
            $currency = CurrencyFactory::create($item->getCode(), $item->getAveragePrice());

            $result[] = new ExchangeRateView(
                $item->getCode(),
                $item->getName(),
                $currency->getSellPrice(),
                $currency->getBuyPrice(),
                $item->getAveragePrice()
            );
        }

        return $result;
    }
}
