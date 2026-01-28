<?php
namespace OCA\ClubSuiteSepa\Controller;

use OCP\AppFramework\OCSController;
use OCP\IRequest;
use OCP\AppFramework\Http\JSONResponse;
use OCA\ClubSuiteSepa\Db\PaymentMapper;

class PaymentController extends OCSController {
    private PaymentMapper $paymentMapper;

    public function __construct(string $appName, IRequest $request, PaymentMapper $paymentMapper) {
        parent::__construct($appName, $request);
        $this->paymentMapper = $paymentMapper;
    }

    public function listByRun(int $runId): JSONResponse {
        $limit = (int)$this->request->getParam('limit', 100);
        $offset = (int)$this->request->getParam('offset', 0);
        $service = new \OCA\ClubSuiteSepa\Service\PaymentService($this->paymentMapper);
        $result = $service->listByRunPaginated($runId, $limit, $offset);
        return new \OCP\AppFramework\Http\JSONResponse($result);
    }

    public function createPayment(array $data): JSONResponse {
        try {
            $p = $this->paymentMapper->create($data);
            return new JSONResponse(['status' => 'success', 'payment' => $p]);
        } catch (\Throwable $e) {
            return new JSONResponse(['status' => 'error', 'message' => $e->getMessage()], 400);
        }
    }
}
