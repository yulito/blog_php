<?php

require_once 'models/categoria.php';

class categoriaController {

    public function index() {
        if(isset($_SESSION['admin'])){
            require_once 'views/categoria/categorias.php';
        }else{
            header("Location: ".base_url);
        }        
    }

    //---------------------------------------------------------
    public function agregarCat() {
        if(isset($_POST)) {
            $cat = isset($_POST['cat']) ? $_POST['cat'] : NULL;

            if(empty($cat)){
                $_SESSION['operacion']['error'] = "No se ha podido completar la operación.";
            }else{
                $categoria = new Categoria();
                $categoria->setNomCat($cat);

                $result = $categoria->add();
                if($result) {
                    $_SESSION['operacion']['guardar'] = "Ha Guardado la categoria correctamente!!";
                }else{
                    $_SESSION['operacion']['error'] = "No se ha podido completar la operación.";
                }
            }
        }
        header("Location:".base_url.'categoria/index');
    }

    //---------------------------------------------------------
    public function eliminarCat() { //fantasia, ficcion y humor... chistes, erotico
        if(isset($_GET['id'])) {
            $id = $_GET['id'];

            $cat = new Categoria();
            $result = $cat->delete($id);

            if($result){
                $_SESSION['operacion']['exito'] = "Ha eliminado la categoria seleccionada!!";
            }else{
                $_SESSION['operacion']['fallo'] = "No se ha podido completar la operación.";
            }
            
        }
        header("Location:".base_url.'categoria/index');
    }
}