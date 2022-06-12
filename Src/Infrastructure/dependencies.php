<?php

use Core\Application\Repository\EateryRepositoryInterface;
use Infrastructure\Data\EateryRepository;
use Infrastructure\Persistence\DatabaseInterface;
use Infrastructure\Persistence\SqliteDatabase;

return [
    DatabaseInterface::class => DI\create(SqliteDatabase::class),
    EateryRepositoryInterface::class => DI\create(EateryRepository::class)
        ->constructor(DI\get(DatabaseInterface::class))
];