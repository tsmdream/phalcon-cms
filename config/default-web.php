<?php
$loader->registerDirs(
    array(
        $system.$config->phalcon->pluginsDir,
        $system.$config->phalcon->libraryDir,
        $system.$config->phalcon->modelsDir,
    ))->register();

$di->set('db', function() use ($config) {
        return new \Phalcon\Db\Adapter\Pdo\Mysql(array(
            "host" => $config->database->host,
            "username" => $config->database->username,
            "port"     => $config->database->port,
            "password" => $config->database->password,
            "dbname" => $config->database->name
        ));
    });

$di->set('modelsMetadata', function() use ($config) {
        if(isset($config->models->metadata)){
            $metaDataConfig = $config->models->metadata;
            $metadataAdapter = '\Phalcon\Mvc\Model\Metadata\\'.$metaDataConfig->adapter;
            return new $metadataAdapter();
        } else {
            return new \Phalcon\Mvc\Model\Metadata\Memory();
        }
    });

$di->set('url', function() use ($config){
        $url = new \Phalcon\Mvc\Url();
        $url->setBaseUri($config->phalcon->baseUri);
        return $url;
    });

$di->set('view', function() use ($system, $config) {
        $view = new \Phalcon\Mvc\View();
        $view->setViewsDir($system.$config->phalcon->viewsDir);
        return $view;
    });

$di->set('session', function(){
        $session = new \Phalcon\Session\Adapter\Files();
        $session->start();
        return $session;
    });

$di->set('flash', function(){
        $flash = new \Phalcon\Flash\Direct(array(
            'error' => 'alert alert-error',
            'success' => 'alert alert-success',
            'notice' => 'alert alert-info',
        ));
        return $flash;
    });

$di->set('elements', function(){
        return new \Elements();
    });

// 注册路由规则
$di->set('router', function() {
        $router = new \Phalcon\Mvc\Router();
        $router->setDefaultModule("frontend");
        $router->add("/products/:action/:params",
                     array("module" => "product",
                           "controller" => "products",
                           "action"  => 1,
                           "params"  => 2
                     ));
        $router->add("/invoices/:action/:params",
                     array('module' => 'user',
                           'controller' => 'invoices',
                           'action' => 1,
                           'params' => 2,
                     ));
        $router->add("/producttypes/:action/:params",
                     array("module" => "product",
                           "controller" => "producttypes",
                           "action"   => 1,
                           "params"   => 2,
                     ));
        $router->add("/user/:controller/:action/?",
                     array('module' => 'user',
                           'controller' => 1,
                           'action' => 2,
                     ));
        return $router;
    });

// 注册多模块
$application->registerModules(
    array(
        'frontend' => array(
            'className' => 'Bs\Frontend\Module',
            'path'      => $system.'/apps/modules/frontend/Module.php',
        ),
        'product' => array(
            'className' => 'Bs\Product\Module',
            'path'      => $system.'/apps/modules/product/Module.php',
        ),
        'user' => array(
            'className' => 'Bs\User\Module',
            'path'      => $system.'/apps/modules/user/Module.php',
        ),
    ));
