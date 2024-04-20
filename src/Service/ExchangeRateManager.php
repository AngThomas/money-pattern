<?php

namespace Mkt\MoneyPattern\Service;

use Doctrine\ORM\EntityManagerInterface;
use Mkt\MoneyPattern\Entity\ExchangeRate;

class ExchangeRateManager
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function addExchangeRate(string $sourceCurrency, string $targetCurrency, float $rate): bool
    {
        return true;
    }

    public function setExchangeRates(ExchangeRatesDtoInterface $exchangeRatesDto)
    {

    }

    public function getExchangeRate(string $sourceCurrency, string $targetCurrency): ?float
    {
        $result = $this->entityManager->getRepository(ExchangeRate::class)->findOneBy([
            'sourceCurrency' => $sourceCurrency,
            'targetCurrency' => $targetCurrency
        ]);

        return $result?->getRate();
    }
}