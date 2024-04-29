<?php

namespace Mkt\MoneyPattern\Service;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Exception;
use Doctrine\DBAL\Schema\Exception\TableAlreadyExists;
use Doctrine\DBAL\Schema\Schema;

class SchemaBuilder
{

    /**
     * @throws Exception
     */
    public function createSchema(Connection $connection)
    {
        $schema = new Schema();
        if ($schema->hasTable('ExchangeRate')) {
            throw new TableAlreadyExists('Tale ExchangeRate alreadyExists');
        }

        $table = $schema->createTable('ExchangeRate');
        $table->addColumn('id', 'integer', ['autoincrement' => true]);
        $table->addColumn('source_currency', 'string', ['notnull' => true]);
        $table->addColumn('target_currency', 'string', ['notnull' => true]);
        $table->addColumn('source_currency', 'float', ['notnull' => true]);
        $table->addColumn('last_update', 'datetime', ['notnull' => true]);
        $table->setPrimaryKey(['id']);
        $queries = $schema->toSql($connection->getDatabasePlatform());

        foreach ($queries as $query) {
            $connection->executeQuery($query);
        }

    }
}