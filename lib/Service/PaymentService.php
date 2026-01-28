<?php
namespace OCA\ClubSuiteSepa\Service;

use OCA\ClubSuiteSepa\Db\PaymentMapper;

class PaymentService {
    private $mapper;
    public function __construct(PaymentMapper $mapper) { $this->mapper = $mapper; }

    public function listByRunPaginated(int $runId, int $limit = 100, int $offset = 0) : array {
        $result = $this->mapper->findByRunPaginated($runId, $limit, $offset);
        $rows = array_map(function($p){ return ['id'=>$p->getId(),'user_id'=>$p->getUserId(),'amount'=>$p->getAmount(),'purpose'=>$p->getPurpose()]; }, $result['rows']);
        return ['total'=>$result['total'],'limit'=>$limit,'offset'=>$offset,'rows'=>$rows];
    }
}
