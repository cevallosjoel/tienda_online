<?php
class Controllers
{
    protected $model;
    protected $views; // Definir la propiedad $views
    public function __construct()
    {
        $this->views=new Views();
        $this->loadModel();
    }

    public function loadModel()
    {
        $modelClassName = get_class($this) . "Model";
        $modelFilePath = "Models/" . $modelClassName . ".php";

        if (file_exists($modelFilePath)) {
            require_once($modelFilePath);
            $this->model = new $modelClassName();
        } 
    }
}
