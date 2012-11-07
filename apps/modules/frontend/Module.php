<?php
namespace Bs\Frontend;
class Module
{
    public function registerAutoloaders()
    {
        $loader = new \Phalcon\Loader();
        $loader->registerNamespaces(array(
            'Bs\Frontend\Controllers' => '../apps/modules/frontend/controllers/',
            'Bs\Frontend\Models'      => '../apps/modules/frontend/models/',
        ));
        $loader->register();
    }

    public function registerServices($di)
    {
        $di->set('dispatcher', function() {
                $dispatcher = new \Phalcon\Mvc\Dispatcher();
                $dispatcher->setDefaultNamespace("Bs\Frontend\Controllers\\");
                return $dispatcher;
            });
    }
}
