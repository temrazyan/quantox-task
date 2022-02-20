<?php

namespace App\Entities;

class Student
{

    /** @var int */
    protected $id;

    /** @var string */
    protected $name;

    /** @var int */
    protected $school_id;


    public function __construct(
        int $id,
        string $name,
        int $school_id
    ) {
        $this->id = $id.
        $this->name = $name;
        $this->school_id = $school_id;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return ucfirst($this->name);
    }

    /**
     * @return int
     */
    public function getSchoolId(): int
    {
        return $this->school_id;
    }

}