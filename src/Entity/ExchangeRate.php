<?php

namespace Mkt\MoneyPattern\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class ExchangeRate {
    /**
     * @ORM\Id
     * @ORM\Column(type="string")
     */
    private string $sourceCurrency;

    /**
     * @ORM\Id
     * @ORM\Column(type="string")
     */
    private string $targetCurrency;

    /**
     * @ORM\Column(type="float")
     */
    private float $rate;

}