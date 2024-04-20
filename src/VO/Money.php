<?php

namespace Mkt\MoneyPattern\VO;

use Mkt\MoneyPattern\Exception\DifferentCurrencyException;

class Money
{
     public function __construct(private int $amount, private string $currency)
     {
     }

     public function getAmount(): int
     {
         return $this->amount;
     }

     public function getCurrency(): string
     {
         return $this->currency;
     }

    /**
     * @throws DifferentCurrencyException
     */
    public function add(Money $moneyToAdd): Money
     {
         if ($this->currency !== $moneyToAdd->getCurrency()) {
             throw new DifferentCurrencyException();
         }
             $newAmount = $this->amount + $moneyToAdd->getAmount();
             return new Money($newAmount, $this->currency);


     }

    /**
     * @throws DifferentCurrencyException
     */
    public function substract(Money $moneyToSubstract): Money
    {
        if ($this->currency !== $moneyToSubstract->getCurrency()) {
            throw new DifferentCurrencyException();
        }
            $newAmount = $this->amount - $moneyToSubstract->getAmount();
            return new Money($newAmount, $this->currency);
    }
}