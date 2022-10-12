<?php

class Utils {

    //Aquí solo devolveremos los valores de categoria y no una vista que los liste (eso lo hace el controlador)
    public static function showCategories(){        
        require_once 'models/categoria.php';
		$categoria = new Categoria();
		$categorias = $categoria->getAll();
		return $categorias;
    }

    public static function deleteSession($session) {
        if(isset($session)) {
            $_SESSION[$session] = null;
            unset($_SESSION[$session]);
        }
        return $session;
    }

    public static function mostrarUsuario($id){
        require_once 'models/usuario.php';
        $usuario = new Usuario();
        $perfil = $usuario->getOne($id);  
        return $perfil;      
    }

    
}