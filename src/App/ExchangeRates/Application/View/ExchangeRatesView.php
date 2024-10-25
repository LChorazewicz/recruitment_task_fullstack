<?php

namespace App\ExchangeRates\Application\View;

use App\ExchangeRates\Domain\ExchangeRateView;

class ExchangeRatesView
{
    public $exchangeRatesForToday;
    public $exchangeRatesForDate;

    /**
     * @param ExchangeRateView[] $exchangeRatesForToday
     * @param ExchangeRateView[] $exchangeRatesForDate
     */
    public function __construct(array $exchangeRatesForToday, array $exchangeRatesForDate)
    {
        $this->exchangeRatesForToday = $exchangeRatesForToday;
        $this->exchangeRatesForDate = $exchangeRatesForDate;
    }

    public function toArray(): array
    {
        $resultForToday = [];
        $resultForDate = [];

        foreach ($this->exchangeRatesForToday as $item) {
            $resultForToday[] = [
                'code' => $item->getCode(),
                'name' => $item->getName(),
                'sell' => $item->getSell(),
                'buy' => $item->getBuy(),
                'base' => $item->getAveragePrice(),
            ];
        }

        foreach ($this->exchangeRatesForDate as $item) {
            $resultForDate[] = [
                'code' => $item->getCode(),
                'name' => $item->getName(),
                'sell' => $item->getSell(),
                'buy' => $item->getBuy(),
                'base' => $item->getAveragePrice(),
            ];
        }

        return [
            'today' => $resultForToday,
            'date' => $resultForDate
        ];
    }
}
