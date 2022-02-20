<?php

namespace App\Responses;

class Json implements IResponse
{
    /** @var array */
    protected $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function __toString(): string
    {

        $json = json_encode($this->data);

        if (json_last_error() != JSON_ERROR_NONE) {
            throw new \UnexpectedValueException('Invalid data was passed int json response.', 500);
        }

        header('Content-Type: application/json; charset=utf-8');

        return $json;
    }
}