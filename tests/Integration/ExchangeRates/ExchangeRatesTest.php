<?php

namespace Integration\ExchangeRates;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ExchangeRatesTest extends WebTestCase
{
    public function testFetch(): void
    {
        $client = static::createClient();

        $client->request('GET', '/api/exchange-rates');
        $this->assertResponseIsSuccessful();
        $response = $client->getResponse();
        $this->assertJson($response->getContent());
    }

    public function testFetchWithDate(): void
    {
        $client = static::createClient();

        $client->request('GET', '/api/exchange-rates?date=today');
        $this->assertResponseIsSuccessful();
        $response = $client->getResponse();
        $this->assertJson($response->getContent());
    }

    public function testFetchWithInvalidDate(): void
    {
        $client = static::createClient();

        $client->request('GET', '/api/exchange-rates?date=invalidDate');
        $this->assertTrue($client->getResponse()->getStatusCode() === 500);
    }
}
