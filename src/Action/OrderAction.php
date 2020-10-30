<?php

namespace App\Action;

use App\Domain\Order\Service\Order;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Routing\RouteContext;

final class OrderAction
{
    private $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {
        $routeContext = RouteContext::fromRequest($request);
        $route = $routeContext->getRoute();
        
        $id = $route->getArgument('id');
        $method = $route->getArgument('method');
        if ($id > 0 and filter_var($id, FILTER_VALIDATE_INT)) {
            $result = $this->order->getOrder($id);
            $response->getBody()->write((string)json_encode($result));
            return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(201);
        } elseif ($method === 'unpaid') {
            $result = $this->order->getUnpaidBills();
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
