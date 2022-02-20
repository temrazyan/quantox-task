<?php

namespace App\CheckGrade;

use App\Entities\School;

class CheckGradeByAvg implements ICheckGrade
{
    protected $school;

    public function __construct(School $school)
    {
        $this->school = $school;
    }

    /**
     * @param array $grades
     * @return bool
     */
    public function checkStudentGrades(array $grades): bool
    {
        $sum = 0;
        foreach ($grades as $grade) {
            $sum += $grade->getGrade();
        }

        return $sum / count($grades) > $this->school->getPassVal();
    }
}