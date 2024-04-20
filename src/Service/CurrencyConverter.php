<?php

namespace Mkt\MoneyPattern\Service;


use Mkt\MoneyPattern\Exception\CurrencyNotSupportedException;
use Mkt\MoneyPattern\VO\Money;

class CurrencyConverter
{
    public function __construct(private ExchangeRateManager $exchangeRateManager)
    {
    }

    /**
     * @throws CurrencyNotSupportedException
     */
    public function convertToCurrency(Money $money, string $currency): Money
    {
        if ($money->getCurrency() === $currency) {
            return $money;
        }

        $exchangeRate = $this->exchangeRateManager->getExchangeRate($money->getCurrency(), $currency);

        if (!isset($exchangeRate)) {
            throw new CurrencyNotSupportedException();
        }

        return new Money($money->getAmount() * $exchangeRate, $currency);
    }


}