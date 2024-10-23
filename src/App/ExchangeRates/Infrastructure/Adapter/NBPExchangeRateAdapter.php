<?php

namespace App\ExchangeRates\Infrastructure\Adapter;

use App\ExchangeRates\Domain\Port\ExchangeRate;
use App\ExchangeRates\Domain\Port\ExchangeRateProvider;
use App\ExchangeRates\Domain\Port\Filter;

class NBPExchangeRateAdapter implements ExchangeRateProvider
{
    /** @return ExchangeRate[] */
    public function fetch(Filter $filter): array
    {
        $baseUrl = 'https://api.nbp.pl/api/exchangerates';
        $url = sprintf('%s/tables/A/%s?format=json', $baseUrl, $filter->getDate()->format('Y-m-d'));

        $response = json_decode(file_get_contents($url), true)[0];

        $response['rates'] = array_filter($response['rates'], function (array $rate) use ($filter) {
            return in_array($rate['code'], $filter->getCurrencies());
        });

        $result = [];

        foreach ($response['rates'] as $item) {
            $result[] = new ExchangeRate(
                $item['code'],
                $item['currency'],
                $item['mid']
            );
        }

        return $result;
    }
}
