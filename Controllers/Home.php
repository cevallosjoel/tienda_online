<?php

class Home extends Controllers
{
    protected $views; // Definir explícitamente la propiedad

    public function __construct()
    {
        parent::__construct();
    }
    public function home()
    {
        $data['page_id'] = 1;
        $data['page_tag'] = "home";
        $data['page_title'] = "Pagina principal";
        $data['page_name'] = "home";
        $data['page_content'] = "lorekaaldkjaldla adalkjdlajdlk lkadkaklh";
        $this->views->getView($this, "home", $data);
    }
   
}
