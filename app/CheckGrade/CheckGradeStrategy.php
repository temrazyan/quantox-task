<?php

namespace App\CheckGrade;

use App\Entities\School;

class CheckGradeStrategy implements ICheckGrade
{

    /** @var School  */
    protected $school;

    public function __construct(School $school)
    {
        $this->school = $school;
    }


    /**
     * @throws \Exception
     */
    public function checkStudentGrades(array $grades): bool
    {
        switch ($this->school->getPassStrategy()) {
            case 'discard':
                $pass = new CheckGradeByDiscardLowest($this->school);
                break;
            case 'avg':
                $pass = new CheckGradeByAvg($this->school);
                break;
            default:
                throw new \Exception('Wrong strategy for school.');
        }

        return $pass->checkStudentGrades($grades);
    }
}