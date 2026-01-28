<?php
namespace OCA\ClubSuiteSepa\Service;

use OCA\ClubSuiteSepa\Db\PaymentRunMapper;

class PaymentRunService {
    private $mapper;
    public function __construct(PaymentRunMapper $mapper) { $this->mapper = $mapper; }

    public function listRunsPaginated(int $limit = 20, int $offset = 0, string $sort = 'date', string $order = 'DESC') : array {
        $result = $this->mapper->findAllPaginated($limit, $offset, $sort, $order);
        $rows = array_map(function($r){ return ['id'=>$r->getId(),'date'=>$r->getDate()?->format('c'),'description'=>$r->getDescription()]; }, $result['rows']);
        return ['total'=>$result['total'],'limit'=>$limit,'offset'=>$offset,'rows'=>$rows];
    }
}
<?php
namespace OCA\ClubSuiteSepa\Service;

use OCA\ClubSuiteSepa\Db\PaymentRunMapper;
use OCA\ClubSuiteSepa\Db\PaymentRunEntity;

class PaymentRunService {
    private PaymentRunMapper $mapper;

    public function __construct(PaymentRunMapper $mapper) { $this->mapper = $mapper; }

    public function listRuns(): array { return $this->mapper->findAll(); }
    public function getRun(int $id): ?PaymentRunEntity { return $this->mapper->findById($id); }
    public function createRun(PaymentRunEntity $r): int { return $this->mapper->create($r); }
}
