<?php
$loader->registerDirs(
    array(
        $system.$config->phalcon->pluginsDir,
        $system.$config->phalcon->libraryDir,
        $system.$config->phalcon->modelsDir,
    ))->register();

$di->set('db', function() use ($config) {
        return new \Phalcon\Db\Adapter\Pdo\Mysql(array(
            "host"     => $config->database->host,
            "username" => $config->database->username,
            "port"     => $config->database->port,
            "password" => $config->database->password,
            "dbname"   => $config->database->name
        ));
    });

$di->set('modelsMetadata', function() use ($config) {
        if(isset($config->models->metadata)){
            $metaDataConfig  = $config->models->metadata;
            $metadataAdapter = '\Phalcon\Mvc\Model\Metadata\\'.$metaDataConfig->adapter;
            return new $metadataAdapter();
        } else {
            return new \Phalcon\Mvc\Model\Metadata\Memory();
        }
    });

$di->set('router', function() {
        $router = new \Phalcon\CLI\Router();
        return $router;
    });

$loader->registerNamespaces(array(
    'Bs\User\Controllers' => $system . '/apps/modules/user/controllers/',
    'Bs\User\Models' => $system . '/apps/modules/user/models/',
));
$loader->register();
