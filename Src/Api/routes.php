<?php

use Api\Controllers\EateriesController;

$app->post('/eatery', [EateriesController::class, 'create']);
$app->get('/eatery/{id}', [EateriesController::class, 'get']);
$app->get('/eatery/location/{longitude},{latitude}', [EateriesController::class, 'getByLocation']);