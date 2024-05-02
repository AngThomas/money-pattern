<?php

namespace Mkt\MoneyPattern\Interfaces;

interface ExchangeRatesDtoInterface
{
    public function fromRequest(string $request): void;
    public function toArray(): array;

}