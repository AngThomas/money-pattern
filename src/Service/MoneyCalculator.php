<?php

namespace Mkt\MoneyPattern\Service;

use Mkt\MoneyPattern\VO\Money;

final class MoneyCalculator
{
    public function __construct(private CurrencyConverter $currencyConverter)
    {
    }

    public function add(Money $money, Money $moneyToAdd): Money
    {
        if ($money->getCurrency() === $moneyToAdd->getCurrency()) {
            return $money->add($moneyToAdd);
        }
        $convertedMoneyToAdd = $this->currencyConverter->convertToCurrency($moneyToAdd, $money->getCurrency());
        return $money->add($convertedMoneyToAdd);
    }

    public function substract(Money $money, Money $moneyToSubstract)
    {
        if ($money->getCurrency() === $moneyToSubstract->getCurrency()) {
            return $money->substract($moneyToSubstract);
        }
        $convertedMoneyToSubstract = $this->currencyConverter->convertToCurrency($moneyToSubstract, $money->getCurrency());
        return $money->substract($convertedMoneyToSubstract);
    }
}