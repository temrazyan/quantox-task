<?php

namespace App\CheckGrade;

use App\Entities\StudentGrade;

interface ICheckGrade
{

    /**
     * Returns true if grades is value
     *
     * @param StudentGrade[] $grades
     * @return bool
     */
    public function checkStudentGrades(array $grades): bool;
}