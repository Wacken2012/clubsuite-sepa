<?php
declare(strict_types=1);

namespace OCA\ClubSuiteSepa\AppInfo;

use OCA\ClubSuiteSepa\Privacy\Register;
use OCP\AppFramework\App;
use OCP\AppFramework\Bootstrap\IBootContext;
use OCP\AppFramework\Bootstrap\IBootstrap;
use OCP\AppFramework\Bootstrap\IRegistrationContext;
use OCP\IContainer;
use OCA\ClubSuiteSepa\Service\CacheService;
use OCA\ClubSuiteSepa\Service\EventService;
use OCA\ClubSuiteSepa\Listener\SepaBasicEventListener;
use OCA\ClubSuiteSepa\Listener\SepaCallbackEventListener;
use OCA\ClubSuiteSepa\Listener\SepaRequestDataEventListener;
use OCA\ClubSuiteSepa\Events\SepaBasicEvent;
use OCA\ClubSuiteSepa\Events\SepaCallbackEvent;
use OCA\ClubSuiteSepa\Events\SepaRequestDataEvent;

if (!\class_exists('OCA\ClubSuiteSepa\AppInfo\Application', false)) {
class Application extends App implements IBootstrap {
    public const APP_ID = 'clubsuite-sepa';

    public function __construct(array $urlParams = []) {
        parent::__construct(self::APP_ID, $urlParams);
        $container = $this->getContainer();
        $container->registerService('CacheService', function(IContainer $c){ return new CacheService($c->query('ICache')); });
        $container->registerService('EventService', function(IContainer $c){ return new EventService(\OC::$server->getEventDispatcher()); });
    }

    public function register(IRegistrationContext $context): void {
        $context->registerEventListener(SepaBasicEvent::class, SepaBasicEventListener::class);
        $context->registerEventListener(SepaCallbackEvent::class, SepaCallbackEventListener::class);
        $context->registerEventListener(SepaRequestDataEvent::class, SepaRequestDataEventListener::class);
    }

    public function boot(IBootContext $context): void {
        $context->injectFn(function(\OCP\IContainer $c) {
            if (\interface_exists('\OCP\Privacy\IManager')) {
                $c->get(\OCP\Privacy\IManager::class)->registerProvider(Register::class);
            }
        });
    }
}

}
