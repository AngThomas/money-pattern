<?php

namespace Mkt\MoneyPattern\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

class ExchangeRateTableMMySQL20240422211600 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $this->skipIf(!in_array($this->connection->getDatabasePlatform()->getName(), ['mysql', 'maria_db']), 'Migration is only supported on MySQL and MariaDb.');
        $this->addSql('CREATE SCHEMA IF NOT EXISTS money_pattern');
        $this->addSql('CREATE TABLE IF NOT EXISTS money_pattern.exchange_rate (
                        id INT AUTO_INCREMENT NOT NULL,
                        source_currency VARCHAR(255) NOT NULL,
                        target_currency VARCHAR(255) NOT NULL,
                        rate DOUBLE NOT NULL,
                        last_update TIMESTAMP NOT NULL,
                        PRIMARY KEY(id)
                    ) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB'
        );


    }

    public function down(Schema $schema): void
    {
        $this->skipIf(!in_array($this->connection->getDatabasePlatform()->getName(), ['mysql', 'maria_db']), 'Migration is only supported on MySQL and MariaDb.');
        $this->addSql('DROP TABLE IF EXISTS money_pattern.exchange_rate');
        $this->addSql('DROP DATABASE IF EXISTS money_pattern');


    }
}