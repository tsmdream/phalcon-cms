<?php
error_reporting(E_ALL);
class TestTask extends \Phalcon\CLI\Task
{
    public function mainAction()
    {
        echo "hello, world" . PHP_EOL;
        echo Bs\User\Models\Test::getTest();
        echo PHP_EOL;
    }
}

try {
    require dirname(__DIR__) . '/apps/Bootstrap.php';
    $boostrap = new Bootstrap();
    $boostrap->execCli(array(__FILE__, 'test'));
} catch (Phalcon\Exception $e) {
	echo $e->getMessage();
} catch (PDOException $e){
	echo $e->getMessage();
}
