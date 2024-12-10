<?php

namespace Htmx;

use voku\helper\HtmlMin;
use Laminas\Mvc\MvcEvent;
use Laminas\EventManager\EventInterface;
use Laminas\ModuleManager\Feature\ConfigProviderInterface;
use Laminas\ModuleManager\Feature\BootstrapListenerInterface;

class Module implements ConfigProviderInterface, BootstrapListenerInterface {

    public function getConfig() {
        return include __DIR__ . '/../config/module.config.php';
    }

    public function onBootstrap(EventInterface $e): void {

        /* @var $headers \Laminas\Http\Headers */
        /* @var $response \Laminas\Http\PhpEnvironment\Response */
        
        $eventManager = $e->getApplication()->getEventManager();

        $eventManager->attach(MvcEvent::EVENT_DISPATCH, function (MvcEvent $e) {
            $headers = $e->getRequest()->getHeaders();
            if ($headers->has('HX-Request')) {
                $controller = $e->getTarget();
                $controller->layout("layout/empty");
            }
        });

        $eventManager->attach(MvcEvent::EVENT_DISPATCH_ERROR, function (MvcEvent $e) {
            $headers = $e->getRequest()->getHeaders();
            if ($headers->has('HX-Request')) {
                $vm = $e->getViewModel();
                $vm->setTemplate("layout/empty");
                $e->setViewModel($vm);
            }
        });

        $eventManager->attach(MvcEvent::EVENT_FINISH, function (MvcEvent $e) {
            $config = $e->getApplication()->getServiceManager()->get('Config');
            if ($config['htmx']['compressOutput'] === true) {
                $response = $e->getResponse();
                $content = $response->getContent();
                $cleancontent = $this->removeWhiteSpaces($content);
                $e->getResponse()->setContent($cleancontent);
            }
        });
    }

    private function removeWhiteSpaces(string $content): string {
        $minfier = new HtmlMin();
        return $minfier->minify($content);
    }
}
