<?php
namespace Core\Entities;

class Eatery
{
    public function __construct(
        $id,
        $name,
        $longitude,
        $latitude,
        $coverageArea
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->longitude = $longitude;
        $this->latitude = $latitude;
        $this->coverageArea = $coverageArea;
    }

    public $id;
    public $name;
    public $longitude;
    public $latitude;
    public $coverageArea;

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getLongitude()
    {
        return $this->longitude;
    }

    public function getLatitude()
    {
        return $this->latitude;
    }

    public function getCoverageArea()
    {
        return $this->coverageArea;
    }
}