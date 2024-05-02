<?php

namespace Mkt\MoneyPattern\Model;

use DateTimeInterface;

class ExchangeRateModel
{
    public function __construct(
    private string $sourceCurrency,
    private string $targetCurrency,
    private float $rate,
    private DateTimeInterface $lastUpdate
    )
    {}

    /**
     * @return string
     */
    public function getSourceCurrency(): string
    {
        return $this->sourceCurrency;
    }

    /**
     * @param string $sourceCurrency
     */
    public function setSourceCurrency(string $sourceCurrency): void
    {
        $this->sourceCurrency = $sourceCurrency;
    }

    /**
     * @return string
     */
    public function getTargetCurrency(): string
    {
        return $this->targetCurrency;
    }

    /**
     * @param string $targetCurrency
     */
    public function setTargetCurrency(string $targetCurrency): void
    {
        $this->targetCurrency = $targetCurrency;
    }

    /**
     * @return float
     */
    public function getRate(): float
    {
        return $this->rate;
    }

    /**
     * @param float $rate
     */
    public function setRate(float $rate): void
    {
        $this->rate = $rate;
    }

    /**
     * @return DateTimeInterface
     */
    public function getLastUpdate(): DateTimeInterface
    {
        return $this->lastUpdate;
    }

    /**
     * @param DateTimeInterface $lastUpdate
     */
    public function setLastUpdate(DateTimeInterface $lastUpdate): void
    {
        $this->lastUpdate = $lastUpdate;
    }



}