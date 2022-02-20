<?php

namespace App\Entities;

class StudentGrade
{
    /** @var int */
    protected $grade;

    /** @var int */
    private $id;

    /** @var string */
    private $subject;

    public function __construct(int $id, int $grade, string $subject)
    {
        $this->id = $id;
        $this->grade = $grade;
        $this->subject = $subject;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getGrade(): int
    {
        return $this->grade;
    }

    /**
     * @return string
     */
    public function getSubject(): string
    {
        return $this->subject;
    }
}