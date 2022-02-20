<?php

namespace App\Controllers;

use App\Repositories\SchoolRepository;
use App\Repositories\StudentRepository;
use App\Responses\View;

class AppController implements IController
{

    public function index(): View
    {
        $schools = (new SchoolRepository())->getSchools();
        $schoolIds = [];

        foreach ($schools as $school) {
            $schoolIds[] = $school->getId();
        }

        if (count($schoolIds)) {
            $students = (new StudentRepository())->getSchoolsStudents($schoolIds);
        }

        return new View('index', [
            'students' => $students ?? [],
            'schools' => $schools
        ]);
    }
}