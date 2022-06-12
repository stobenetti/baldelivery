<?php
namespace Core\Application\Service;

use Core\Entities\Eatery;
use Core\Application\Repository\EateryRepositoryInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Location\Coordinate;
use Location\Polygon;

class EateryService
{
    private $eateryRepository;

    public function __construct(EateryRepositoryInterface $eateryRepository)
    {
        $this->eateryRepository = $eateryRepository;
    }

    public function create(Request $request): int
    {
        $request = json_decode($request->getBody());

        $eatery = new Eatery(
            $request->id, 
            $request->name,
            $request->address->coordinates[0],
            $request->address->coordinates[1],
            json_encode($request->coverageArea->coordinates)
        );

        return $this->eateryRepository->create($eatery);
    }

    public function find(string $id): ?Eatery
    {
        return $this->eateryRepository->find($id);
    }

    public function findByLocationAndCoverageArea($longitude, $latitude): Eatery
    {
        $eateries = $this->findAllAndOrderByDistanceAsc($longitude, $latitude);

        return $eateries[0];
    }

    private function findAllAndOrderByDistanceAsc($longitude, $latitude): array
    {
        return $this->eateryRepository->findAllAndOrderByDistanceAsc(
            $longitude,
            $latitude
        );
    }
}