<?php

use Phalcon\DI\FactoryDefault;
use Phalcon\Loader;
use Phalcon\Mvc\Application;
use Phalcon\Mvc\Url as UrlProvider;
use Phalcon\Mvc\View;

require_once __DIR__ . '/../vendor/autoload.php';

try {

    // Register an autoloader
    $loader = new Loader();
    $loader->registerDirs(array(
        __DIR__ . '/app/controllers/',
    ))->register();

    // Create a DI
    $di = new FactoryDefault();

    // Setup the view component
    $di->set('view', function () {
        $view = new View();
        $view->setViewsDir(__DIR__ . '/app/views/');
        $view->registerEngines(
            array(
                ".latte" => function ($view, $di) {
                    $factory = new \Phalette\Platte\Latte\LatteFactory();
                    $factory->setTempDir(__DIR__ . '/cache');
                    $factory->setAutoRefresh(TRUE);
                    return new \Phalette\Platte\LatteTemplateAdapter($view, $di, $factory);
                },
                ".phtml" => 'Phalcon\Mvc\View\Engine\Php'
            )
        );
        return $view;
    });

    // Handle the request
    $application = new Application($di);

    echo $application->handle()->getContent();

} catch (\Exception $e) {
    echo "PhalconException: ", $e->getMessage();
}