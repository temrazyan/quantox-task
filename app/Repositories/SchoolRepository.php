<?php

namespace App\Repositories;

use App\DB;
use App\Entities\School;
use App\Entities\Student;

class SchoolRepository
{
    /**
     * Returns School object if row exists
     *
     * @param Student $student
     * @return School
     * @throws \Exception
     */
    public function getSchoolByStudent(Student $student): School
    {
        $query = $this->getBaseQuery() . "  WHERE id = :id LIMIT 1";
        $id = $student->getSchoolId();
        $statement = DB::getQueryStatement($query, ['id' => $id]);
        $row = $statement->fetch();

        if (!$row) {
            throw new \Exception('Student by this id: ' . $id . ' not exist.');
        }

        return $this->schoolFactory($row);
    }

    /**
     * Returns all schools in DB
     *
     * @return School[]
     */
    public function getSchools()
    {
        $statement = DB::getQueryStatement($this->getBaseQuery());

        $schools = [];
        while ($row = $statement->fetch(\PDO::FETCH_ASSOC)) {
            $schools[] = $this->schoolFactory($row);
        }

        return $schools;
    }

    /**
     * @return string
     */
    protected function getBaseQuery(): string
    {
        return '
            SELECT 
                id,
               name,
               pass_strategy,
               pass_val,
               pass_grade_quantities,
               response_type
            FROM schools
        ';
    }

    protected function schoolFactory(array $row): School
    {
        return new School($row['id'], $row['name'], $row['pass_strategy'], $row['pass_val'], $row['pass_grade_quantity'], $row['response_type']);
    }
}