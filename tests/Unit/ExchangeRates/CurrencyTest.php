<?php

namespace Unit\ExchangeRates;

use App\ExchangeRates\Domain\Currency\BRL;
use App\ExchangeRates\Domain\Currency\USD;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CurrencyTest extends WebTestCase
{
    public function testUsd(): void
    {
        $basePrice = 1.0;
        $buyPrice = 0.1;
        $sellPrice = 0.2;

        $currency = new USD($basePrice, $buyPrice, $sellPrice);

        $this->assertEquals($basePrice - $buyPrice, $currency->getBuyPrice());
        $this->assertEquals($basePrice + $sellPrice, $currency->getSellPrice());
    }

    public function testBrl(): void
    {
        $basePrice = 1.0;
        $sellPrice = 0.2;

        $currency = new BRL($basePrice, $sellPrice);

        $this->assertEquals(null, $currency->getBuyPrice());
        $this->assertEquals($basePrice + $sellPrice, $currency->getSellPrice());
    }
}
