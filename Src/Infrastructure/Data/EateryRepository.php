<?php

namespace Infrastructure\Data;

use Core\Application\Repository\EateryRepositoryInterface;
use Core\Entities\Eatery;
use Infrastructure\Persistence\DatabaseInterface;

class EateryRepository implements EateryRepositoryInterface
{
    private  $database;

    public function __construct(DatabaseInterface $database)
    {
        $this->database = $database->getInstance();
    }

    public function create(Eatery $eatery): int
    {
        $this->database->insert('EATERY', [
            'id' => $eatery->getId(),
            'name' => $eatery->getName(),
            'longitude' => $eatery->getLongitude(),
            'latitude' => $eatery->getLatitude(),
            'coverage_area' => $eatery->getCoverageArea()
        ]);
        
        if ($this->database->error()[2] != null)
        {
            echo $this->database->error()[2];
            return 500;
        }

        echo 'Successfully created instance.';
        return 201;
    }

    public function find(int $id): ?Eatery
    {
        $result = $this->database
            ->select(
                "EATERY", 
                "*", 
                [
                    "id" => $id
                ]
            );
    
        if ($result == false)
        {
            return null;
        }

        $eatery = new Eatery(
            $result[0]['ID'], 
            $result[0]['NAME'],
            $result[0]['LATITUDE'],
            $result[0]['LONGITUDE'],
            $result[0]['COVERAGE_AREA']
        );
        
        return $eatery;
    }

    public function findAllAndOrderByDistanceAsc($longitude, $latitude): array
    {
        $result = $this->database->query(
            "SELECT *
            FROM EATERY
            ORDER BY ((LATITUDE - $latitude)*(LATITUDE - $latitude)) + ((LONGITUDE - $longitude)*(LONGITUDE - $longitude)) ASC"
        )->fetchAll();

        if ($result == false)
        {
            return null;
        }

        $eateries = [];

        foreach ($result as $item)
        {
            $eateries[] = new Eatery(
                $item['ID'], 
                $item['NAME'],
                $item['LATITUDE'],
                $item['LONGITUDE'],
                $item['COVERAGE_AREA']
            );
        }

        return $eateries;
    }
}