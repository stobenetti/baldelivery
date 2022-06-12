<?php
namespace Api\Controllers;

use Psr\Http\Message\{
    ServerRequestInterface as Request,
    ResponseInterface as Response
};
use Core\Entities\Eatery;
use Core\Application\Service\EateryService;

class EateriesController
{
    private $eateryService;

    public function __construct(EateryService $eateryService)
    {
        $this->eateryService = $eateryService;
    }

    public function create(Request $request, Response $response)
    {
        $statusCode = $this->eateryService->create($request);

        return $response->withStatus($statusCode);
    }
    
    public function get(Response $response, $id)
    {
        $eatery = $this->eateryService->find($id);

        $response
            ->getBody()
            ->write(json_encode($eatery));

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }

    public function getByLocation(
        Response $response, 
        $longitude,
        $latitude
    )
    {
        $eatery = $this->eateryService->findByLocationAndCoverageArea($longitude, $latitude);

        $response
            ->getBody()
            ->write(json_encode($eatery));

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }
}