<?php
namespace OCA\ClubSuiteSepa\Migrations;

use OCP\AppFramework\Db\SchemaTrait;
use OCP\Migration\IMigration;
use OCP\Migration\IOutput;

class Version20260105_AddIndexes implements IMigration {
    use SchemaTrait;

    public function changeSchema(IOutput $output) {
        $schema = $this->getSchema();
        if ($schema->hasTable('sepa_mandate')) {
            $t = $schema->getTable('sepa_mandate');
            if (!$t->hasIndex('idx_sepa_mandate_user')) $t->addIndex(['user_id'], 'idx_sepa_mandate_user');
            if (!$t->hasIndex('idx_sepa_mandate_mandateid')) $t->addIndex(['mandate_id'], 'idx_sepa_mandate_mandateid');
        }
        if ($schema->hasTable('sepa_payment_run')) {
            $t = $schema->getTable('sepa_payment_run');
            if (!$t->hasIndex('idx_sepa_payment_run_date')) $t->addIndex(['date'], 'idx_sepa_payment_run_date');
        }
        if ($schema->hasTable('sepa_payment')) {
            $t = $schema->getTable('sepa_payment');
            if (!$t->hasIndex('idx_sepa_payment_run')) $t->addIndex(['run_id'], 'idx_sepa_payment_run');
        }
    }

    public function up(IOutput $output) { $this->changeSchema($output); }
    public function down(IOutput $output) { }
}
