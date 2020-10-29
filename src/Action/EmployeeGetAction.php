<?php

namespace App\Action;

use App\Domain\Employee\Service\EmployeeGetter;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Routing\RouteContext;

final class EmployeeGetAction
{
    private $employeeGetter;

    public function __construct(EmployeeGetter $employeeGetter)
    {
        $this->employeeGetter = $employeeGetter;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {
        // Collect the id from the route
        $routeContext = RouteContext::fromRequest($request);
        $route = $routeContext->getRoute();
        
        $id = $route->getArgument('id');

        // Invoke the Domain with inputs and retain the result
        $employee = $this->employeeGetter->getEmployee($id);

        // Transform the result into the JSON representation
        $result = [
            'employee' => $employee
        ];

        // Build the HTTP response
        $response->getBody()->write((string)json_encode($result));

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(201);
    }
}
