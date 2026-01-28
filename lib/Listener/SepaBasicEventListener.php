<?php
namespace OCA\ClubSuiteSepa\Listener;
use OCP\EventDispatcher\Event;
use OCP\EventDispatcher\IEventListener;

use OCA\ClubSuiteSepa\Events\SepaBasicEvent;

class SepaBasicEventListener implements IEventListener {
    public function handle(Event $event): void {
        if (!($event instanceof SepaBasicEvent)) {
            return;
        }
        error_log('SepaBasicEvent received in Sepa: ' . $event->getId());
    }
}
