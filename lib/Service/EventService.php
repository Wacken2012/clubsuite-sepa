<?php
namespace OCA\ClubSuiteSepa\Service;

use OCP\EventDispatcher\IEventDispatcher;
use OCA\ClubSuiteSepa\Events\SepaBasicEvent;
use OCA\ClubSuiteSepa\Events\SepaCallbackEvent;
use OCA\ClubSuiteSepa\Events\SepaRequestDataEvent;

class EventService {
    private IEventDispatcher $dispatcher;

    public function __construct(IEventDispatcher $dispatcher) {
        $this->dispatcher = $dispatcher;
    }

    public function dispatchBasicEvent(array $payload): void {
        $event = new SepaBasicEvent(uniqid('sepa_', true), time(), $payload);
        $this->dispatcher->dispatch($event);
    }

    public function dispatchCallbackEvent(array $payload, callable $callback): void {
        $event = new SepaCallbackEvent(uniqid('sepa_cb_', true), time(), $payload, $callback);
        $this->dispatcher->dispatch($event);
    }

    public function dispatchRequestDataEvent(callable $callback): void {
        $event = new SepaRequestDataEvent(uniqid('sepa_req_', true), time(), [], $callback);
        $this->dispatcher->dispatch($event);
    }
}
