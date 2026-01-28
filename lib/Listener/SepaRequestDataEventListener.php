<?php
namespace OCA\ClubSuiteSepa\Listener;
use OCP\EventDispatcher\Event;
use OCP\EventDispatcher\IEventListener;

use OCA\ClubSuiteSepa\Events\SepaRequestDataEvent;

class SepaRequestDataEventListener implements IEventListener {
    public function handle(Event $event): void {
        if (!($event instanceof SepaRequestDataEvent)) {
            return;
        }
        $data = ['app' => 'Sepa', 'status' => 'ready'];
        $event->respond($data);
    }
}
