<?php
require_once 'models/historias.php';

class historiasController{

    public function index() {

        $historia = new Historias();

        $historias = $historia->getAll();        

        require_once 'views/historias/destacados.php';
    }

    public function ver() {
        if(isset($_GET['id'])) {
            $id = $_GET['id'];

            $historia = new Historias();

            $historia->setIdHistoria($id);
            $htr = $historia->getOne();            
        }
        require_once 'views/historias/ver.php';
    }

    public function error() {
        
        require_once 'views/error/errorweb.php';
    }
}