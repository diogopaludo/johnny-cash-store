<?php

namespace App\Action;

use App\Domain\Employee\Service\Employee;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Routing\RouteContext;

final class EmployeeAction
{
    private $employee;

    public function __construct(Employee $employee)
    {
        $this->employee = $employee;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {
        $routeContext = RouteContext::fromRequest($request);
        $route = $routeContext->getRoute();
        
        $id = $route->getArgument('id');
        if ($id > 0 and filter_var($id, FILTER_VALIDATE_INT)) {
            $result = $this->employee->getEmployee($id);
            $response->getBody()->write((string)json_encode($result));
            return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(201);
        } else {
            $response->getBody()->write((string)json_encode([]));
            return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(422);
        }
    }
}
