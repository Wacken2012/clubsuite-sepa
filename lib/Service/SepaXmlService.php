<?php
namespace OCA\ClubSuiteSepa\Service;

use OCA\ClubSuiteSepa\Db\PaymentRunMapper;
use OCA\ClubSuiteSepa\Db\PaymentMapper;
use OCA\ClubSuiteSepa\Db\MandateMapper;

/**
 * Minimal SEPA pain.008 generator scaffold. Replace with full XML builder for production.
 */
class SepaXmlService {
    private PaymentRunMapper $runMapper;
    private PaymentMapper $paymentMapper;
    private MandateMapper $mandateMapper;

    public function __construct(PaymentRunMapper $runMapper, PaymentMapper $paymentMapper, MandateMapper $mandateMapper) {
        $this->runMapper = $runMapper;
        $this->paymentMapper = $paymentMapper;
        $this->mandateMapper = $mandateMapper;
    }

    /**
     * Return a simple pain.008 XML string for the given run id.
     */
    public function generatePain008(int $runId): string {
        $run = $this->runMapper->findById($runId);
        if ($run === null) {
            throw new \InvalidArgumentException('Run not found');
        }
        $payments = $this->paymentMapper->findByRun($runId);

        $xml = new \SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><Document></Document>');
        $xml->addChild('MsgId', 'SEPA-RUN-' . $runId);
        $xml->addChild('CreDtTm', $run->getDate()->format(DATE_ATOM));
        $pmtList = $xml->addChild('Payments');
        foreach ($payments as $p) {
            $item = $pmtList->addChild('Payment');
            $item->addChild('UserId', $p->getUserId());
            $item->addChild('Amount', number_format($p->getAmount(), 2, '.', ''));
            $item->addChild('Purpose', $p->getPurpose() ?? '');
            $mandates = $this->mandateMapper->findAll();
            // Incomplete: real implementation should lookup mandate by user
            if (!empty($mandates)) {
                $item->addChild('MandateId', $mandates[0]->getMandateId());
            }
        }
        return $xml->asXML();
    }
}
