<?php
namespace OCA\ClubSuiteSepa\Service;

use OCA\ClubSuiteSepa\Db\MandateMapper;

class MandateService {
    private $mapper;
    public function __construct(MandateMapper $mapper) { $this->mapper = $mapper; }

    public function listMandatesPaginated(int $limit = 50, int $offset = 0, string $sort = 'user_id', string $order = 'ASC') : array {
        $result = $this->mapper->findAllPaginated($limit, $offset, $sort, $order);
        $rows = array_map(function($m){
            return ['id'=>$m->getId(),'user_id'=>$m->getUserId(),'iban'=>$m->getIban(),'mandate_id'=>$m->getMandateId(),'signature_date'=>$m->getSignatureDate()?->format('c')];
        }, $result['rows']);
        return ['total'=>$result['total'],'limit'=>$limit,'offset'=>$offset,'rows'=>$rows];
    }
}
<?php
namespace OCA\ClubSuiteSepa\Service;

use OCA\ClubSuiteSepa\Db\MandateMapper;
use OCA\ClubSuiteSepa\Db\MandateEntity;

class MandateService {
    private MandateMapper $mapper;

    public function __construct(MandateMapper $mapper) { $this->mapper = $mapper; }

    public function listMandates(): array { return $this->mapper->findAll(); }
    public function getMandate(int $id): ?MandateEntity { return $this->mapper->findById($id); }
    public function createMandate(MandateEntity $m): int { return $this->mapper->create($m); }
    public function deleteMandate(int $id): void { $this->mapper->delete($id); }
}
