<?php

namespace App\Repositories;

use App\DB;
use App\Entities\Student;
use App\Entities\StudentGrade;

class StudentGradesRepository
{

    /**
     * @param Student $student
     * @return StudentGrade[]
     */
    public function getStudentGrades(Student $student): array
    {
        $query = $this->getBaseQuery() . ' WHERE student_id = :student_id';

        $statement = DB::getQueryStatement($query, ['student_id' => $student->getId()]);
        $grades = [];

        while ($row = $statement->fetch(\PDO::FETCH_ASSOC)) {
            $grades[] = $this->gradeFactory($row);
        }

        return $grades;
    }

    /**
     * @return string
     */
    protected function getBaseQuery(): string
    {
        return 'SELECT id, grade, subject FROM student_grades';
    }

    /**
     * Creates and return StudentGrade
     *
     * @param array $row
     * @return StudentGrade
     */
    protected function gradeFactory(array $row): StudentGrade
    {
        return new StudentGrade($row['id'], $row['grade'], $row['subject']);
    }
}