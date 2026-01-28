<?php
namespace OCA\ClubSuiteSepa\Listener;
use OCP\EventDispatcher\Event;
use OCP\EventDispatcher\IEventListener;

use OCA\ClubSuiteSepa\Events\SepaCallbackEvent;

class SepaCallbackEventListener implements IEventListener {
    public function handle(Event $event): void {
        if (!($event instanceof SepaCallbackEvent)) {
            return;
        }
        $payload = $event->getPayload();
        $event->triggerCallback(['handledBy' => 'Sepa', 'payloadCount' => count($payload)]);
    }
}
