<?php

namespace App\ExchangeRates\Application\Service;

use App\ExchangeRates\Application\DTO\FetchDTO;
use App\ExchangeRates\Application\View\ExchangeRatesView;
use App\ExchangeRates\Domain\Port\ExchangeRatesProvider;
use App\ExchangeRates\Domain\Port\Filter;
use App\ExchangeRates\Domain\Profit\ProfitManager;

class FetchService
{
    private $exchangeRatesProvider;
    private $profitService;

    public function __construct(ExchangeRatesProvider $exchangeRateProvider, ProfitManager $profitService)
    {
        $this->exchangeRatesProvider = $exchangeRateProvider;
        $this->profitService = $profitService;
    }

    public function fetch(FetchDTO $dto): ExchangeRatesView
    {
        $exchangeRatesForToday = $this->exchangeRatesProvider->fetch(
            new Filter($dto->getCurrencies(), new \DateTimeImmutable())
        );

        $exchangeRatesForDate = $this->exchangeRatesProvider->fetch(
            new Filter($dto->getCurrencies(), $dto->getDate())
        );

        return new ExchangeRatesView(
            $this->profitService->handle(...$exchangeRatesForToday),
            $this->profitService->handle(...$exchangeRatesForDate)
        );
    }
}
