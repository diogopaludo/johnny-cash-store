<?php

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\App;

return function (App $app) {
    $app->get('/employee/{id:[0-9]+}', \App\Action\EmployeeGetAction::class);
    $app->get('/sku/{id:[0-9]+}', \App\Action\SkuAction::class);
    $app->get('/sku/{method}/{one}/{two}', \App\Action\SkuAction::class);
    //$app->post('/employee', \App\Action\EmployeeCreateAction::class);
};
