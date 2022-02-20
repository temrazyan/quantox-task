<?php

namespace App\Responses;

interface IResponse
{
    public function __toString(): string;
}