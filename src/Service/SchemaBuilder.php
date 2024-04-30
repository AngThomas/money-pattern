<?php

namespace Mkt\MoneyPattern\Service;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Exception;
use Doctrine\DBAL\Schema\Exception\TableAlreadyExists;
use Doctrine\DBAL\Schema\Schema;

class SchemaBuilder
{
    private const TABLE_NAME = 'ExchangeRate';

    /**
     * @throws Exception
     */
    public static function createTable(Connection $connection)
    {
        $schema = new Schema();

        if ($connection->createSchemaManager()->tableExists(self::TABLE_NAME)) {
            throw new TableAlreadyExists();
        }

        $table = $schema->createTable(self::TABLE_NAME);
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