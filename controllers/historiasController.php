<?php
require_once 'models/historias.php';

class historiasController{

    public function index() {

        $historia = new Historias();

        $historias = $historia->getAll();        

        require_once 'views/historias/destacados.php';
    }
}