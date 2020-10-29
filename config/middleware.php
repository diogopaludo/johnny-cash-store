<?php

use Selective\BasePath\BasePathMiddleware;
use Selective\Validation\Middleware\ValidationExceptionMiddleware;
use Slim\App;

return function (App $app) {
    // Parse json, form data and xml
    $app->addBodyParsingMiddleware();

    // Add the Slim built-in routing middleware
    $app->addRoutingMiddleware();
    
    $app->add(BasePathMiddleware::class);
    
    // Catch exceptions and errors
    $app->add(ValidationExceptionMiddleware::class);
};
