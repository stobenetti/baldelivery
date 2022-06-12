<?php
namespace Core\Application\Repository;

use Core\Entities\Eatery;

interface EateryRepositoryInterface
{
    public function create(Eatery $eatery): int;
    
    public function find(int $id):?Eatery;
}