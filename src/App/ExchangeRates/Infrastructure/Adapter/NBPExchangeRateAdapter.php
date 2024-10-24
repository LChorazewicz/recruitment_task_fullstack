<?php

namespace App\ExchangeRates\Infrastructure\Adapter;

use App\ExchangeRates\Domain\Port\ExchangeRate;
use App\ExchangeRates\Domain\Port\ExchangeRateProvider;
use App\ExchangeRates\Domain\Port\Filter;
use App\ExchangeRates\Infrastructure\Logger\Logger;

class NBPExchangeRateAdapter implements ExchangeRateProvider
{
    private $logger;

    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }

    /** @return ExchangeRate[] */
    public function fetch(Filter $filter): array
    {
        $baseUrl = 'https://api.nbp.pl/api/exchangerates';
        $url = sprintf('%s/tables/A/%s?format=json', $baseUrl, $filter->getDate()->format('Y-m-d'));

        $rates = [];
        try {
            $response = json_decode(file_get_contents($url), true)[0];

            $rates = array_filter($response['rates'], function (array $rate) use ($filter) {
                return in_array($rate['code'], $filter->getCurrencies());
            });
        } catch (\Exception $exception) {
            $this->logger->log($exception);
        }

        $result = [];

        foreach ($rates as $item) {
            $result[] = new ExchangeRate(
                $item['code'],
                $item['currency'],
                $item['mid']
            );
        }

        return $result;
    }
}
