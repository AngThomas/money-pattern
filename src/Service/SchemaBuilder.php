<?php

namespace Mkt\MoneyPattern\Service;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Exception;
use Doctrine\DBAL\Schema\Schema;

class SchemaBuilder
{

    public function createSchema(Connection $connection)
    {
        $schema = new Schema();
        $table = $schema->createTable('ExchangeRate');
        $table->addColumn('id', 'integer', ['autoincrement' => true]);
        $table->addColumn('source_currency', 'string', ['notnull' => true]);
        $table->addColumn('target_currency', 'string', ['notnull' => true]);
        $table->addColumn('source_currency', 'float', ['notnull' => true]);
        $table->addColumn('last_update', 'datetime', ['notnull' => true]);
        $table->setPrimaryKey(['id']);

        try {
            $queries = $schema->toSql($connection->getDatabasePlatform());
        } catch(Exception $e) {

        }

        foreach ($queries as $query) {
            $connection->executeQuery($query);
        }
    }
}