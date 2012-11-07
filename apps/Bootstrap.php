<?php
final class Bootstrap
{
    protected $config      = null;
    protected $di          = null;
    protected $application = null;
    protected $loader      = null;
    protected $rootPath    = null;

    // 运行环境
    const ENV = "dev";
    
    public function exec()
    {
        $this->rootPath = dirname(__DIR__);
        $this->config   = new \Phalcon\Config\Adapter\Ini($this->rootPath . '/config/'. self::ENV .'.ini');
        $this->loader   = new \Phalcon\Loader();
    }
    
    public function execWeb()
    {
        $this->exec();
        $this->di          = new \Phalcon\DI\FactoryDefault();
        $this->application = new \Phalcon\Mvc\Application();
        // 加载所需组件
        $this->load($this->rootPath.'/config/default-web.php');
        $this->application->setDI($this->di);
        echo $this->application->handle()->getContent();
    }

    public function execCli($argv)
    {
        $this->exec();
        $this->di          = new \Phalcon\DI\FactoryDefault\CLI();
        $this->application = new \Phalcon\CLI\Console();
        // 加载所需组件
        $this->load($this->rootPath.'/config/default-cli.php');
        $this->application->setDI($this->di);
        $this->application->handle($argv);
    }
    
    public function load($file)
    {
        $system      = $this->rootPath;
        $loader      = $this->loader;
        $config      = $this->config;
        $application = $this->application;
        $di          = $this->di;
        return require $file;
    }
}
