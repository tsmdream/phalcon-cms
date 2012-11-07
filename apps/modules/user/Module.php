<?php
namespace Bs\User;

class Module
{
    public function registerAutoloaders()
    {
        $loader = new \Phalcon\Loader();

        $loader->registerNamespaces(array(
            'Bs\User\Controllers' => '../apps/modules/user/controllers/',
            'Bs\User\Models' => '../apps/modules/user/models/',
        ));
        $loader->register();
    }

   /**
    *
    * Register the services here to make them module-specific
    *
    */
    public function registerServices($di)
    {
        //Registering a dispatcher
        $di->set('dispatcher', function () {
                $dispatcher = new \Phalcon\Mvc\Dispatcher();
                $dispatcher->setDefaultNamespace("Bs\User\Controllers\\");
                return $dispatcher;
            });
    }
}