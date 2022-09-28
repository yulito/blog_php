<?php

class Utils {

    //Aquí solo devolveremos los valores de categoria y no una vista que los liste (eso lo hace el controlador)
    public static function showCategories(){        
        require_once 'models/categoria.php';
		$categoria = new Categoria();
		$categorias = $categoria->getAll();
		return $categorias;
    }


}