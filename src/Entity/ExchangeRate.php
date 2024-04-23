<?php

namespace Mkt\MoneyPattern\Entity;

use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(schema="money_pattern")
 */
class ExchangeRate {
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private int $id;

    /**
     * @ORM\Column(type="string")
     */
    private string $sourceCurrency;

    /**
     * @ORM\Column(type="string")
     */
    private string $targetCurrency;

    /**
     * @ORM\Column(type="float")
     */
    private float $rate;

    /**
     * @ORM\Column(type="datetime")
     */
    private DateTimeInterface $lastUpdate;

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