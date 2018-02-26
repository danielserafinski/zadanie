<?php
require  __DIR__ . '/../vendor/autoload.php';

$app = new Slim\App([
    'settings' => [
        'displayErrorDetails' => true,
    ]
]);


$container = $app->getContainer();


$container['view'] = function ($container) {
    $view = new Slim\Views\Twig(
        __DIR__ . '/../templates/default',
        [
            'cache' => false
        ]
    );

    $view->addExtension(new \Slim\Views\TwigExtension(
       $container->router,
       $container->request->getUri()
    ));

    $view->addExtension(new Twig_Extension_Debug());


    return $view;

};


$container['HomeController'] = function ($container) {
    return new \App\Controllers\HomeController($container);
};

require  __DIR__ . '/../app/routes.php';