<?php

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\App;

return function (App $app) {
    $app->get('/employee/{id:[0-9]+}', \App\Action\EmployeeAction::class);
    $app->get('/employee/{id:[0-9]+}/{method}', \App\Action\EmployeeAction::class);
    $app->get('/sku/{id:[0-9]+}', \App\Action\SkuAction::class);
    $app->get('/sku/{method}/{one}/{two}', \App\Action\SkuAction::class);
    $app->get('/order/{id:[0-9]+}', \App\Action\OrderAction::class);
    $app->get('/order/{method}', \App\Action\OrderAction::class);
    //$app->get('/sku/{method}[/{one}[/{two}]]', \App\Action\SkuAction::class);
};
