<?php

namespace App\ExchangeRates\Application\Service;

use App\ExchangeRates\Application\DTO\FetchDTO;
use App\ExchangeRates\Application\View\ExchangeRatesView;
use App\ExchangeRates\Domain\Port\ExchangeRateProvider;
use App\ExchangeRates\Domain\Port\Filter;
use App\ExchangeRates\Domain\Profit\ProfitManager;

class FetchService
{
    private $exchangeRateProvider;
    private $profitService;

    public function __construct(ExchangeRateProvider $exchangeRateProvider, ProfitManager $profitService)
    {
        $this->exchangeRateProvider = $exchangeRateProvider;
        $this->profitService = $profitService;
    }

    public function fetch(FetchDTO $dto): ExchangeRatesView
    {
        $exchangeRatesForToday = $this->exchangeRateProvider->fetch(
            new Filter($dto->getCurrencies(), new \DateTimeImmutable())
        );

        $exchangeRatesForDate = $this->exchangeRateProvider->fetch(
            new Filter($dto->getCurrencies(), $dto->getDate())
        );

        return new ExchangeRatesView(
            $this->profitService->modify(...$exchangeRatesForToday),
            $this->profitService->modify(...$exchangeRatesForDate)
        );
    }
}
