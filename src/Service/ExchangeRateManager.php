<?php

namespace Mkt\MoneyPattern\Service;

use Doctrine\ORM\EntityManagerInterface;
use InvalidArgumentException;
use Mkt\MoneyPattern\Entity\ExchangeRate;
use Mkt\MoneyPattern\Interfaces\ExchangeRatesDtoInterface;
use Mkt\MoneyPattern\Model\ExchangeRateModel;

class ExchangeRateManager
{
    private const BATCH_SIZE = 10;
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function addExchangeRate(ExchangeRateModel $exchangeRateModel): bool
    {
        $this->fillExchangeRateEntity($exchangeRateModel);
        $this->entityManager->flush();
        $this->entityManager->clear();
        return true;
    }

    public function setExchangeRates(ExchangeRatesDtoInterface $exchangeRatesDto): void
    {
        $batchCount = 0;
        $exchangeRatesArray = $exchangeRatesDto->toArray();
        $this->entityManager->beginTransaction();

        foreach ($exchangeRatesArray as $exchangeRateModel) {
            if (!($exchangeRateModel instanceof ExchangeRateModel::class)) {
                $this->entityManager->rollback();
                throw new InvalidArgumentException('exchangeRate argument is not an object of ExchangeRateModel class');
            }
            $this->fillExchangeRateEntity($exchangeRateModel);
            $batchCount++;

            if ($batchCount === self::BATCH_SIZE) {
                $this->entityManager->flush();
                $this->entityManager->clear();
                $batchCount = 0;
            }
        }
        $this->entityManager->flush();
        $this->entityManager->clear();
        $this->entityManager->commit();
    }

    public function getExchangeRate(string $sourceCurrency, string $targetCurrency): ?float
    {
        $result = $this->entityManager->getRepository(ExchangeRate::class)->findOneBy([
            'sourceCurrency' => $sourceCurrency,
            'targetCurrency' => $targetCurrency
        ]);

        return $result?->getRate();
    }

    private function fillExchangeRateEntity(ExchangeRateModel $exchangeRateModel)
    {
        $exchangeRate = new ExchangeRate();
        $exchangeRate->setSourceCurrency($exchangeRateModel->getSourceCurrency());
        $exchangeRate->setTargetCurrency($exchangeRateModel->getTargetCurrency());
        $exchangeRate->setRate($exchangeRateModel->getRate());
        $exchangeRate->setLastUpdate($exchangeRateModel->getLastUpdate());
        $this->entityManager->persist($exchangeRate);
    }
}