<?php

namespace App\Controllers;

use App\CheckGrade\CheckGradeStrategy;
use App\Repositories\SchoolRepository;
use App\Repositories\StudentGradesRepository;
use App\Repositories\StudentRepository;
use App\Responses\Json;
use App\Responses\View;
use App\Responses\Xml;

class StudentController implements IController
{

    /**
     * @throws \HttpUrlException
     * @throws \Exception
     */
    public function index()
    {
        $id = (int)($_GET['id'] ?? null);

        if (!$id) {
            throw new \HttpUrlException('Student Id is missing.');
        }

        $stRep = new StudentRepository();
        $student = $stRep->getStudent($id);
        $school = (new SchoolRepository())->getSchoolByStudent($student);
        $grades = (new StudentGradesRepository())->getStudentGrades($student);
        $passStrategy = new CheckGradeStrategy($school);
        $gradeArr = [];

        $sum = 0;
        foreach ($grades as $grade) {
            $sum += $grade->getGrade();
            $gradeArr[$grade->getSubject()] = $grade->getGrade();
        }

        $data = [
            'id' => $student->getId(),
            'name' => $student->getName(),
            'grades' => $gradeArr,
            'average' => number_format($sum / count($grades)),
            'status' => $passStrategy->checkStudentGrades($grades) ? 'pass' : 'fail'
        ];


        if ($school->getResponseType() == 'xml') {
            $response = new Xml(new View('xml', $data));
        } else {
            $response = new Json($data);
        }

        return $response;
    }
}