<?php
namespace Bs\User\Controllers;

class IndexController extends \Phalcon\Mvc\Controller
{
    public function indexAction()
    {
        echo "Hello,I'm here: Daishu\User\IndexController";
        echo "<br />";
        echo \Bs\User\Models\Test::getTest();
        exit;
    }
}