<?php
require_once 'models/historias.php';
require_once 'models/categoria.php';
require_once 'models/likes.php';

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

    public function agregar() {
        if(isset($_SESSION['usuario'])) {
            require_once 'views/historias/agregarHistoria.php';
        }else{
            header("Location: ".base_url);
        }
        
    }

    public function guardar(){
        if(isset($_POST)) {
            // var_dump($_POST);
            // die();
            $titulo = isset($_POST['titulo']) ? $_POST['titulo'] : NULL;
            $historia = isset($_POST['historia']) ? $_POST['historia'] : NULL;            
            $cat = isset($_POST['categoria']) ? (int)$_POST['categoria'] : NULL;
            $estado = isset($_POST['estado']) ? $_POST['estado'] : 'Desactivado';

            if($estado != 'Activado' && $estado != 'Desactivado') {
                $estado = 'Desactivado';
            }
            
            if(empty($titulo) || empty($historia) || empty($cat)) {
                $_SESSION['error']['campo'] = 'Se deben llenar todos los campos obligatorios (*)';
            }else{

                if(isset($_SESSION['usuario'])) {
                    
                    $id = $_SESSION['usuario']->id_usuario;
                    $htr = new Historias();
                    //seteamos atributos y llamamos funcion add
                    $htr->setTitulo($titulo);
                    $htr->setHistoria($historia);
                    $htr->setIdCat($cat);
                    $htr->setEstadoh($estado);
                    $htr->setIdUsuario($id);

                    if(!isset($_SESSION['error'])) {
                    
                        $listo = $htr->add();  
    
                        if($listo){
                            $_SESSION['ejecucion']['guardar'] = 'La operación se realizó con exito!!';
                        }else{
                            $_SESSION['error']['insertar'] = 'Error al guardar los datos.';                        
                        }        
                    }                   
                }else{
                    require_once 'views/error/errorweb.php';
                }
                
            }   
            
        }
        header("Location: ".base_url.'historias/agregar');
        
    }

    public function error() {
        
        require_once 'views/error/errorweb.php';
    }

    // ---------------------------------------------------------------------------------

    public function misHistorias() {
        if(isset($_SESSION['usuario'])) {
            $id = $_SESSION['usuario']->id_usuario;

            $historias = new Historias();
            $historia = $historias->getAll(false, null, $id, true);
            require_once "views/historias/mis-historias.php";                              
        } else{
            header("Location:".base_url);
        }
    }

    // ---------------------------------------------------------------------------------
    public function cambiarEstado() {
        if(isset($_GET['id']) && isset($_GET['estado'])) {
            $id = $_GET['id'];
            $estado = $_GET['estado'];

            $historia = new Historias();
            $result = $historia->update($id,$estado);

            header("Location:".base_url);
        }
    }

    // ---------------------------------------------------------------------------------
    public function eliminarHistoria() {
    
        if(isset($_GET['id'])){
            $id = $_GET['id'];
        
            $historia = new Historias();
            $result = $historia->delete($id);

            if($result){
                header("Location:".base_url);
            }else{
                $_SESSION['error']['delete'] = 'Fallo al eliminar la historia.'; 
                //require_once "views/historias/ver.php";
                require_once 'views/error/errorweb.php';
            }
        }
    }
    // ---------------------------------------------------------------------------------
    public function likes() {
        if(isset($_GET['id']) && isset($_GET['usuario'])) {
            $id = $_GET['id'];
            $user = $_GET['usuario'];
            
            $likes = new Likes();
            $likes->setIdUser($user);
            $likes->setIdHtr($id);

            $likes->htrLikes();
            
            if($likes == true){
                
                header("Location:".base_url."historias/favoritos");
            }else{
                require_once 'views/error/errorweb.php';
            }        
        }
            
    }

    public function dislike() {
        if(isset($_GET['id']) ) {
            $id = $_GET['id'];
            
            $likes = new Likes();
            $likes->setIdLike($id);
            $like = $likes->htrDisLike();
            
            if($like == true){
                //$_SESSION['guardar']['likes'] = 'Acción ejecutada correctamente!!.';
                header("Location:".base_url."historias/favoritos");
            }else{
                require_once 'views/error/errorweb.php';
            }        
        }
        //require_once "views/historias/ver.php";     
    }

    public function favoritos() {
        if(isset($_SESSION['usuario'])){
            $like = new Likes();
            $likes = $like->getAll();            
            require_once 'views/historias/favoritos.php';
        }else{
            header("Location: ".base_url);
        }
    }
}