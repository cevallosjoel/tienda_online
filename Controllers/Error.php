<?php

class Errors extends Controllers
{
    protected $views; // Definir explícitamente la propiedad
    public function __construct()
    {
        parent::__construct();
    }
    public function notFound()
    {
        $this->views->getView($this,"error");
    }
}
$notFound = new Errors();
$notFound->notFound();