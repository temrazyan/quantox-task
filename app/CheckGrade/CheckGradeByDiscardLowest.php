<?php

namespace App\CheckGrade;

use App\Entities\School;
use App\Entities\StudentGrade;

class CheckGradeByDiscardLowest implements ICheckGrade
{
    protected $school;

    public function __construct(School $school)
    {
        $this->school = $school;
    }

    /**
     * @param StudentGrade[] $grades
     * @return bool
     */
    public function checkStudentGrades(array $grades): bool
    {
        if (count($grades) < $this->school->getPassGradeQuantities()) {
            return false;
        }

        $passed = false;
        foreach ($grades as $grade) {
            if ($grade->getGrade() >= $this->school->getPassVal()) {
                $passed = true;
                break;
            }
        }

        return $passed;
    }
}