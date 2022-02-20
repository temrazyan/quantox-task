<?php

require __DIR__ . '/../vendor/autoload.php';

use App\Application;
use App\Controllers\AppController;
use App\Controllers\StudentController;

$app = new Application();

$app->registerRoute('get', '/', AppController::class, 'index');
$app->registerRoute('get', '/student', StudentController::class, 'index');


$app->handleRequest();