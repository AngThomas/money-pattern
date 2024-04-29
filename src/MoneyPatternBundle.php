<?php

namespace Mkt\MoneyPattern;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class MoneyPatternBundle extends Bundle
{
    public function boot()
    {
        $connection = $this->container->get('doctrine.dbal.default_connection');

    }
}