<?php

class Utils {

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

    public static function favorito($usuario, $id) {
        require_once 'models/likes.php';
        $likes = new Likes();
        $likes->setIdUser($usuario);
        $likes->setIdHtr($id);
        
        $like = $likes->getOne();

        return $like;
    }
}