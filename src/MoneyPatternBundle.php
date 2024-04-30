<?php

namespace Mkt\MoneyPattern;

use Doctrine\DBAL\Schema\Exception\TableAlreadyExists;
use Mkt\MoneyPattern\Service\SchemaBuilder;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Doctrine\DBAL\Exception;

class MoneyPatternBundle extends Bundle
{
    public function boot()
    {
        $connection = $this->container->get('doctrine.dbal.default_connection');
        $logger = $this->container->get(LoggerInterface::class);

        try {
            SchemaBuilder::createTable($connection);
        } catch (TableAlreadyExists $tae) {
            $logger->info('Table \'exchange_rate\' already exists in this database', ['channel' => 'mp']);
        } catch (Exception|\Exception $e) {
            $logger->error($e->getMessage().' '.$e->getTraceAsString(), ['channel' => 'mp']);
        }


    }
}