<?php
namespace OCA\ClubSuiteSepa\Db;

class PaymentMapper {
    private $connection;

    public function __construct($connection) { $this->connection = $connection; }

    public function findByRun(int $runId): array {
        $sql = 'SELECT * FROM `*PREFIX*sepa_payment` WHERE `run_id` = ? ORDER BY `id` ASC';
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$runId]);
        $res = [];
        while ($row = $stmt->fetch()) {
            $p = new PaymentEntity((int)$row['run_id'], $row['user_id'], (float)$row['amount']);
            $p->setId((int)$row['id']);
            $p->setPurpose($row['purpose'] ?? null);
            $res[] = $p;
        }
        return $res;
    }

    /**
     * Paginated listing of payments for a run.
     */
    public function findByRunPaginated(int $runId, int $limit = 100, int $offset = 0): array {
        $countSql = 'SELECT COUNT(*) as c FROM `*PREFIX*sepa_payment` WHERE `run_id` = ' . (int)$runId;
        $total = (int)$this->connection->query($countSql)->fetch()['c'];

        $sql = 'SELECT `id`,`run_id`,`user_id`,`amount`,`purpose` FROM `*PREFIX*sepa_payment` WHERE `run_id` = ? ORDER BY `id` ASC LIMIT ? OFFSET ?';
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$runId, (int)$limit, (int)$offset]);
        $rows = [];
        while ($row = $stmt->fetch()) {
            $p = new PaymentEntity((int)$row['run_id'], $row['user_id'], (float)$row['amount']);
            $p->setId((int)$row['id']);
            $p->setPurpose($row['purpose'] ?? null);
            $rows[] = $p;
        }
        return ['total'=>$total,'rows'=>$rows];
    }

    public function create(PaymentEntity $p): int {
        $sql = 'INSERT INTO `*PREFIX*sepa_payment` (`run_id`,`user_id`,`amount`,`purpose`) VALUES (?,?,?,?)';
        $this->connection->prepare($sql)->execute([$p->getRunId(), $p->getUserId(), $p->getAmount(), $p->getPurpose()]);
        return (int)$this->connection->lastInsertId();
    }
}
