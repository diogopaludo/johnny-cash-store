<?php

namespace App\Action;

use App\Domain\Sku\Service\Sku;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Routing\RouteContext;

final class SkuAction
{
    private $sku;

    public function __construct(Sku $sku)
    {
        $this->sku = $sku;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {
        // Collect the id from the route
        $routeContext = RouteContext::fromRequest($request);
        $route = $routeContext->getRoute();
        
        $id = $route->getArgument('id');
        $method = $route->getArgument('method');

        if (!empty($id)) {
            $sku = $this->sku->getSku($id);
            $result = [
                'sku' => $sku
            ];
            $response->getBody()->write((string)json_encode($result));
            return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(201);
        } elseif (!empty($method) and $method === 'top-selling') {
            $initialDate = $route->getArgument('one');
            $finalDate = $route->getArgument('two');
            $result = $this->sku->getTopSelling($initialDate, $finalDate);
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
