<?php
namespace OCA\ClubSuiteSepa\Migrations;

use Doctrine\DBAL\Schema\Schema;
use OCP\Migration\IChange;

class Version20260104 implements IChange {
    public function changeSchema(Schema $schema): void {
        if (!$schema->hasTable('sepa_mandate')) {
            $table = $schema->createTable('sepa_mandate');
            $table->addColumn('id', 'integer', ['autoincrement' => true]);
            $table->addColumn('user_id', 'string', ['length' => 64]);
            $table->addColumn('iban', 'string', ['length' => 34]);
            $table->addColumn('bic', 'string', ['length' => 11, 'notnull' => false]);
            $table->addColumn('mandate_id', 'string', ['length' => 64]);
            $table->addColumn('signature_date', 'date', ['notnull' => false]);
            $table->setPrimaryKey(['id']);
        }

        if (!$schema->hasTable('sepa_payment_run')) {
            $table = $schema->createTable('sepa_payment_run');
            $table->addColumn('id', 'integer', ['autoincrement' => true]);
            $table->addColumn('date', 'datetime');
            $table->addColumn('description', 'string', ['length' => 255, 'notnull' => false]);
            $table->setPrimaryKey(['id']);
        }

        if (!$schema->hasTable('sepa_payment')) {
            $table = $schema->createTable('sepa_payment');
            $table->addColumn('id', 'integer', ['autoincrement' => true]);
            $table->addColumn('run_id', 'integer');
            $table->addColumn('user_id', 'string', ['length' => 64]);
            $table->addColumn('amount', 'decimal', ['precision' => 10, 'scale' => 2]);
            $table->addColumn('purpose', 'string', ['length' => 255, 'notnull' => false]);
            $table->setPrimaryKey(['id']);
        }
    }

    public function getComment(): string { return 'Create sepa tables'; }
}
