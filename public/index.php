<?php

require __DIR__ . '/../vendor/autoload.php';

use App\Application;
use App\Controllers\AppController;

$app = new Application();

$app->registerRoute('get', '/', AppController::class, 'index');


$app->handleRequest();