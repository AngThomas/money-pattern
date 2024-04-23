<?php

namespace Mkt\MoneyPattern\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

class ExchangeRateTablePrgsql20240422211600 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $this->skipIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration is only supported on PostgreSQL.');
        $this->addSql('CREATE SCHEMA IF NOT EXISTS money_pattern');
        $this->addSql('CREATE TABLE IF NOT EXISTS money_pattern.exchange_rate (
            id SERIAL NOT NULL,
            source_currency VARCHAR(255) NOT NULL,
            target_currency VARCHAR(255) NOT NULL,
            rate DOUBLE PRECISION NOT NULL,
            last_update TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL,
            PRIMARY KEY(id)
        )');
    }

    public function down(Schema $schema): void
    {
        $this->skipIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration is only supported on PostgreSQL.');
        $this->addSql('DROP TABLE IF EXISTS money_pattern.exchange_rate');
        $this->addSql('DROP SCHEMA IF EXISTS money_pattern');
    }
}