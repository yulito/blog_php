<?php
    session_start();
    require_once 'autoload.php';
    require_once 'config/db.php';
    require_once 'config/parameters.php';
    require_once 'helpers/utils.php';
    require_once "views/layout/header.php";

    //VALIDAR CONTROLLER
    if(isset($_GET['controller'])){
        $nombre_controlador = $_GET['controller'].'Controller';
    
    }elseif(!isset($_GET['controller'])){
        $nombre_controlador = controller_default;
        
    }else{
        $nombre_controlador = controller_default;
    }
    
    //VALIDAR ACTION
    if(class_exists($nombre_controlador)){	

        $controlador = new $nombre_controlador();
        
        if(isset($_GET['action']) && method_exists($controlador, $_GET['action'])){
            $action = $_GET['action'];
            
        }elseif(isset($_GET['action']) && !method_exists($controlador, $_GET['action'])){
            $action = action_error;
 
        }else{
            $action = action_default;
        }
    }else{
        $nombre_controlador = controller_default;
        $action = action_error;
    }
    $controlador = new $nombre_controlador();
    $controlador->$action();

    require_once "views/layout/section.php";
    require_once "views/layout/footer.php";
?>