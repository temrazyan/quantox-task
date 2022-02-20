<?php

namespace App\Responses;

class View implements IResponse
{

    /** @var string filename */
    protected $view;

    /** @var array */
    protected $data;

    public function __construct(string $view, array $data = [])
    {
        $this->view = $view;
        $this->data = $data;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        $root = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . '../views/';
        ob_start();
        extract($this->data);
        require $root . $this->view . '.php';

       return ob_get_clean();
    }
}