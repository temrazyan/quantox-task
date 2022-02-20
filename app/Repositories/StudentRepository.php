<?php

namespace App\Repositories;

use App\DB;
use App\Entities\Student;

class StudentRepository
{
    /**
     * @param int $id
     * @return Student
     * @throws \Exception
     */
    public function getStudent(int $id): Student
    {
        $query = $this->getBaseQuery() . ' WHERE id = :id LIMIT 1';
        $statement = DB::getQueryStatement($query, ['id' => $id]);

        $row = $statement->fetch(\PDO::FETCH_ASSOC);

        if (!$row) {
            throw new \Exception('Student by this id: ' . $id . ' not exist.');
        }

        return $this->studentFactory($row);
    }

    /**
     * @return Student[]
     */
    public function getSchoolsStudents(array $schoolsIds): array
    {
        $query = $this->getBaseQuery();
        $query .= ' WHERE school_id in ( ' . join(',', $schoolsIds) . ' )';
        $statement = DB::getQueryStatement($query);

        $students = [];


        while ($row = $statement->fetch(\PDO::FETCH_ASSOC)) {
            $student = $this->studentFactory($row);

            if (!isset($students[$student->getSchoolId()])) {
                $students[$student->getSchoolId()] = [];
            }

            $students[$student->getSchoolId()][] = $student;
        }

        return $students;
    }

    /**
     * Returns base query
     *
     * @return string
     */
    protected function getBaseQuery(): string
    {
        return 'SELECT id, name, school_id FROM students';
    }

    /**
     * @param array $row
     * @return Student
     */
    private function studentFactory(array $row): Student
    {
        return new Student($row['id'], $row['name'], $row['school_id']);
    }
}