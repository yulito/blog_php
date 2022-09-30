<?php
require_once 'models/usuario.php';

class usuarioController {
    
    public function index() {

    }

    public function registro() {
        require_once 'views/usuario/registro.php';
    }

    public function guardar() {
        //obtener los post
        if(isset($_POST)){
            // var_dump($_POST);
            // die();
            //validando datos post
            $usuario = isset($_POST['usuario']) ? $_POST['usuario'] : NULL;
            $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : NULL;
            $edad = isset($_POST['edad']) ? $_POST['edad'] : NULL;
            $sexo = isset($_POST['sexo']) ? $_POST['sexo'] : NULL;
            $correo = isset($_POST['correo']) ? $_POST['correo'] : NULL;
            $password = isset($_POST['password']) ? $_POST['password'] : NULL;

            //VALIDAR REGISTRO
            //************************************************************** */
            //ver si vienen vacios o nulos. Solo los datos de campo obligatorio
            if(empty($usuario) || empty($edad) || empty($sexo) || empty($correo) || empty($password)) {
                //guardamos una sesion de error y redireccionamos a la vista
                $_SESSION['error']['registro'] = 'Registro fallido. Debes rellenar los campos oblicatorios (*)';

            }else{
                //validar reglas
                if(!is_numeric($edad) && preg_match("/[a-zA-Z]/",$edad) || $edad <= 8 ) {
                    $_SESSION['error']['edad'] = 'Ingrese una edad valida';
                }
                //sexo
                if(is_numeric($sexo) && preg_match("/[1-3]/", $sexo)) {
                    switch($sexo){
                        case 1:
                            $sexo = "Masculino";
                            break;
                        case 2:
                            $sexo = "Femenino";
                            break;
                        case 3:
                            $sexo = "Otro";
                            break;
                        default:
                            $_SESSION['error']['sexo'] = 'Ingrese un dato valido';
                            break;
                    }
                }
                //correo
                if(!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
                    $_SESSION['error']['correo'] = 'Ingrese un correo valido';
                }
                //password
                if(strlen($password) > 8 || strlen($password) < 4){
                    $_SESSION['error']['password'] = 'El password es superior o inferior al nro de caracteres permitidos';
                }

                //----- SETEAR LOS DATOS ------
                $DatosUsuario = new Usuario();
                $DatosUsuario->setNomUsuario($usuario);
                $DatosUsuario->setDescripcion($descripcion);
                $DatosUsuario->setEdad($edad);
                $DatosUsuario->setSexo($sexo);
                $DatosUsuario->setCorreo($correo);
                $DatosUsuario->setPassword($password);

                if(isset($_FILES['foto'])) {
                    $foto = $_FILES['foto'];                
                    $mimetype = $foto['type'];
    
                    if($mimetype == "image/jpg" || $mimetype == 'image/jpeg' || $mimetype == 'image/png' || $mimetype == 'image/gif'){
                        if(!is_dir('media/images')){
                            mkdir('media/images', 0777, true);
                        }
    
                        $nombreFoto = $foto['name'];                    
                        $DatosUsuario->setFoto($nombreFoto);                    
    
                    }else{
                        $nombreFoto = NULL;
                        $DatosUsuario->setFoto($nombreFoto);
                    }
                }else{
                    $nombreFoto = NULL;
                    $DatosUsuario->setFoto($nombreFoto);
                }

                //----- SI NO HAY ERRORES GUARDAR
                if(empty($_SESSION['error'])) {
                    
                    $guardado = $DatosUsuario->guardarUsuario();  

                    if($guardado){
                        //Si la foto NO es nula, almacenara en la carpeta una copia
                        if(!is_null($nombreFoto)){
                            move_uploaded_file($foto['tmp_name'], 'media/images/'.$nombreFoto);
                        }

                    }else{
                        $_SESSION['error']['insertar'] = 'Error al guardar los datos.';                        
                    }        
                }
            }        
        }

        header("Location:".base_url.'usuario/registro');
    }

    //======================================================================================0
    
}

