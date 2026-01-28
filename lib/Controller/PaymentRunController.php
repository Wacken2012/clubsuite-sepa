<?php
namespace OCA\ClubSuiteSepa\Controller;

use OCP\AppFramework\OCSController;
use OCP\IRequest;
use OCP\AppFramework\Http\JSONResponse;
use OCA\ClubSuiteSepa\Service\PaymentRunService;
use OCA\ClubSuiteSepa\Service\SepaXmlService;

class PaymentRunController extends OCSController {
    private PaymentRunService $runService;
    private SepaXmlService $sepaXmlService;

    public function __construct(string $appName, IRequest $request, PaymentRunService $runService, SepaXmlService $sepaXmlService) {
        parent::__construct($appName, $request);
        $this->runService = $runService;
        $this->sepaXmlService = $sepaXmlService;
    }

    public function listRuns(): JSONResponse {
        $limit = (int)$this->request->getParam('limit', 20);
        $offset = (int)$this->request->getParam('offset', 0);
        $sort = $this->request->getParam('sort', 'date');
        $order = $this->request->getParam('order', 'DESC');

        $service = new \OCA\ClubSuiteSepa\Service\PaymentRunService($this->runService->mapper ?? $this->runService);
        $result = $service->listRunsPaginated($limit, $offset, $sort, $order);
        return new \OCP\AppFramework\Http\JSONResponse($result);
    }

    public function generateSepaXml(int $id): JSONResponse {
        try {
            $xml = $this->sepaXmlService->generatePain008($id);
            return new JSONResponse(['status' => 'success', 'xml' => $xml]);
        } catch (\Throwable $e) {
            return new JSONResponse(['status' => 'error', 'message' => $e->getMessage()], 400);
        }
    }
}
