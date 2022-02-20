<?php

namespace App\Controllers;

use App\Responses\View;

class AppController implements IController
{

    public function index(): View
    {
        return new View('index');
    }
}