<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240219190617 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Add `reservation.invoice_number` field.';
    }

    public function up(Schema $schema) : void
    {
        $this->addSql('ALTER TABLE reservation ADD invoice_number VARCHAR(20) DEFAULT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_42C849552DA68207 ON reservation (invoice_number)');
    }

    public function down(Schema $schema) : void
    {
        $this->addSql('DROP INDEX UNIQ_42C849552DA68207 ON reservation');
        $this->addSql('ALTER TABLE reservation DROP invoice_number');
    }
}
