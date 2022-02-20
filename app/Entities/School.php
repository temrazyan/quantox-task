<?php

namespace App\Entities;

class School
{

    /** @var int */
    protected $id;

    /** @var string */
    protected $name;

    /** @var string */
    protected $passStrategy;

    /** @var int */
    protected $passVal;

    /** @var int */
    protected $passGradeQuantities;

    /** @var string */
    protected $responseType;

    public function __construct(int $id, string $name, string $passStrategy, int $passVal, ?int $passGradeQuantities, string $responseType)
    {
        $this->id = $id;
        $this->name = $name;
        $this->passStrategy = $passStrategy;
        $this->passVal = $passVal;
        $this->passGradeQuantities = $passGradeQuantities;
        $this->responseType = $responseType;
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
        return $this->name;
    }

    /**
     * @return string
     */
    public function getPassStrategy(): string
    {
        return $this->passStrategy;
    }

    /**
     * @return int
     */
    public function getPassVal(): int
    {
        return $this->passVal;
    }

    /**
     * @return integer
     */
    public function getPassGradeQuantities(): ?int
    {
        return $this->passGradQuantities;
    }

    /**
     * @return string
     */
    public function getResponseType(): string
    {
        return $this->responseType;
    }

}