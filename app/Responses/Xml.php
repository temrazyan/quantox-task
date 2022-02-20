<?php

namespace App\Responses;

class Xml implements IResponse
{
    /** @var View */
    protected $xml;

    public function __construct(View $xmlView)
    {
        $this->xml = $xmlView;
    }

    public function __toString(): string
    {
        header('Content-Type: application/xml; charset=utf-8');

        return $this->xml;
    }
}