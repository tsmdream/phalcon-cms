<?php
namespace Bs\Product;
class Module
{
    public function registerAutoloaders()
    {
        $loader = new \Phalcon\Loader();
        $loader->registerNamespaces(array(
            'Bs\Product\Controllers' => '../apps/modules/product/controllers/',
            'Bs\Product\Models'      => '../apps/modules/product/models/',
        ));
        $loader->register();
    }

    public function registerServices($di)
    {
        $di->set('dispatcher', function() {
                $dispatcher = new \Phalcon\Mvc\Dispatcher();
                $dispatcher->setDefaultNamespace("Bs\Product\Controllers\\");
                return $dispatcher;
            });
    }
}
