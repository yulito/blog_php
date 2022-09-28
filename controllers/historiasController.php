<?php
require_once 'models/historias.php';
require_once 'models/categoria.php';

class historiasController{

    public function index() {

        $historia = new Historias();

        $historias = $historia->getAll(true);        

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

    public function porCategoria() {
        if(isset($_GET['id'])) {
            $id = $_GET['id'];
            
            $historia = new Historias();
            $categoria = new Categoria();
            $categoria->setId($id);
            $nomCat = $categoria->getOne();
            //$historia->setIdCat($id); esto esta muy enredado igual que arriba, es por esto que le meti parametros a la funcion
            $historias = $historia->getAll(false, $id);                               
        }
        require_once 'views/historias/seleccionCategoria.php';
    }

    public function error() {
        
        require_once 'views/error/errorweb.php';
    }
}