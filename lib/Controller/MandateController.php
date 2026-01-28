<?php
namespace OCA\ClubSuiteSepa\Controller;

use OCP\AppFramework\OCSController;
use OCP\IRequest;
use OCP\AppFramework\Http\JSONResponse;
use OCA\ClubSuiteSepa\Service\MandateService;

class MandateController extends OCSController {
    private MandateService $mandateService;

    public function __construct(string $appName, IRequest $request, MandateService $mandateService) {
        parent::__construct($appName, $request);
        $this->mandateService = $mandateService;
    }

    public function listMandates(): JSONResponse {
        $limit = (int)$this->request->getParam('limit', 50);
        $offset = (int)$this->request->getParam('offset', 0);
        $sort = $this->request->getParam('sort', 'user_id');
        $order = $this->request->getParam('order', 'ASC');

        $service = new \OCA\ClubSuiteSepa\Service\MandateService($this->mandateService->mapper ?? $this->mandateService);
        $result = $service->listMandatesPaginated($limit, $offset, $sort, $order);
        return new \OCP\AppFramework\Http\JSONResponse($result);
    }

    public function createMandate(array $data): JSONResponse {
        try {
            $m = $this->mandateService->create($data);
            return new JSONResponse(['status' => 'success', 'mandate' => $m]);
        } catch (\Throwable $e) {
            return new JSONResponse(['status' => 'error', 'message' => $e->getMessage()], 400);
        }
    }
}
