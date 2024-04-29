<?php

namespace Mkt\MoneyPattern\Service;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Exception;
use Doctrine\DBAL\Schema\Exception\TableAlreadyExists;
use Doctrine\DBAL\Schema\Schema;

class SchemaBuilder
{
    private const TABLE_NAME = 'ExchangeRate';

    public function __construct(private Connection $connection)
    {
    }

    /**
     * @throws Exception
     */
    public function createTable()
    {
        $schema = new Schema();
        if ($schema->hasTable(self::TABLE_NAME)) {
            throw new TableAlreadyExists('Tale ExchangeRate alreadyExists');
        }

        $table = $schema->createTable(self::TABLE_NAME);
        $table->addColumn('id', 'integer', ['autoincrement' => true]);
        $table->addColumn('source_currency', 'string', ['notnull' => true]);
        $table->addColumn('target_currency', 'string', ['notnull' => true]);
        $table->addColumn('source_currency', 'float', ['notnull' => true]);
        $table->addColumn('last_update', 'datetime', ['notnull' => true]);
        $table->setPrimaryKey(['id']);
        $queries = $schema->toSql($this->connection->getDatabasePlatform());

        foreach ($queries as $query) {
            $this->connection->executeQuery($query);
        }

    }

    /**
     * @throws Exception
     */
    private function differentTableSameNameExists(): bool
    {
        $schemaManager = $this->connection->createSchemaManager();

        if (!$schemaManager->tableExists(self::TABLE_NAME)) {
            return false;
        }
        $tableColumns = $schemaManager->listTableColumns(self::TABLE_NAME);
        return true;
    }
}