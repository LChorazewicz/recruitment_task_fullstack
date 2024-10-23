<?php

declare(strict_types=1);

namespace App\Controller;

use App\ExchangeRates\Application\DTO\FetchDTO;
use App\ExchangeRates\Application\Service\FetchService;
use App\ExchangeRates\Domain\Currencies;
use DateTimeImmutable;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ExchangeRatesController extends AbstractController
{
    private $fetchService;

    public function __construct(FetchService $fetchService)
    {
        $this->fetchService = $fetchService;
    }

    public function fetch(Request $request): JsonResponse
    {
        $result = $this->fetchService->fetch(new FetchDTO(
            $request->get('currencies', Currencies::getAvailable()),
            new DateTimeImmutable($request->get('date', 'today'))
        ));

        return new JsonResponse($result->toArray());
    }
}
