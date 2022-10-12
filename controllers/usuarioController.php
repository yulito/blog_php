<?php
require_once 'models/usuario.php';
require_once 'models/historias.php';

class usuarioController {
    
    public function index() {

    }

    public function registro() {
        if(!isset($_SESSION['usuario'])) {
            require_once 'views/usuario/registro.php';
        } else{
            header("Location:".base_url);
        }      
    }

    public function guardar() {
        //obtener los post
        if(isset($_POST)){
            //validando datos post
            $usuario = isset($_POST['usuario']) ? $_POST['usuario'] : NULL;
            $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : NULL;
            $edad = isset($_POST['edad']) ? $_POST['edad'] : NULL;
            $sexo = isset($_POST['sexo']) ? (int)$_POST['sexo'] : NULL;
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
                if(is_numeric($sexo) ) { //este puede ser el problema
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
                        $_SESSION['ejecucion']['guardar'] = 'La operación se realizó con exito!!';

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
    
    public function login() {
        
        if(isset($_POST)) {
            $correo = isset($_POST['correo']) ? $_POST['correo'] : NULL;
            $password = isset($_POST['password']) ? $_POST['password'] : NULL;

            if(empty($correo) || empty($password)) {
                $_SESSION['error_login']['campos'] = 'Ingreso fallido. Debes rellenar los campos';
            }else{                                
                $usuario = new Usuario();
                $usuario->setCorreo($correo);

                $ingreso = $usuario->ingresar($password); //el valor $password no lo seteamos ya que se estaria codificando y no podriamos hacer la comparacion con dos claves codificadas.
                
                if($ingreso) {
                    Utils::deleteSession('error_login');
                    //En Utils validaremos si esta vigente                        
                    $_SESSION['usuario'] = $ingreso;
                    if($ingreso->id_rol == 2) {
                        $_SESSION['admin'] = true;
                    }
                }else{
                    $_SESSION['error_login']['identificacion'] = 'Identificación fallida !!';            
                }                                
            }
        }
        
        header("Location:".base_url);
        /*
            *** IMPORTANTE session = "ERROR_LOGIN"
            Los errores de sesion no lo recomiendo en este caso ya que estas quedan abiertas incluso
            cuando se refresca la pagina, a no ser de cambiar de pestaña. En vez de esto, es mejor 
            no hacer nada en las excepciones o "else" y dejar que la redireccion haga lo suyo. De este
            modo, solo se refrescara la pagina sin arrojar mensajes de error, pero también, SIN 
            EFECTUAR EL INGRESO dando a entender que no se realizo la sesion por algun fallo de campo, 
            completado o sistema.
            Pero para dejar el ejemplo de como se ve con session de errores, lo dejaremos así...
        */
    }
    // ---------------------------------------------------------------------------------------------

    public function logout() {
        if($_SESSION['admin'] == true) {
            unset($_SESSION['admin']);
                       
        }
        $usuario = new Usuario();
        $cerrar = $usuario->sesion($_SESSION['usuario']->id_usuario,2);

        if($cerrar){
            unset($_SESSION['usuario']);
        } 
        
        header("Location:".base_url);
    }

    // ---------------------------------------------------------------------------------------------

    public function seguridad() {
        if(isset($_SESSION['usuario'])) {
            require_once 'views/usuario/seguridad.php';
        } else{
            header("Location:".base_url);
        }
    }

    // ----------------------------------------------------------------------------------------------

    public function cambioRegistro() {
        if(isset($_POST)){
            $pass1 = isset($_POST['passwordNew']) ? $_POST['passwordNew'] : NULL;
            $pass2 = isset($_POST['passwordNew2']) ? $_POST['passwordNew2'] : NULL;

            if(empty($pass1) || empty($pass2)) {
                $_SESSION['error']['campos'] = 'Ingreso fallido. Debes rellenar los campos';
            }else{ 

                if(strlen($pass1) > 8 || strlen($pass1) < 4){
                    $_SESSION['error']['password'] = 'El password es superior o inferior al nro de caracteres permitidos';
                }
                if(strlen($pass2) > 8 || strlen($pass2) < 4){
                    $_SESSION['error']['password'] = 'El password es superior o inferior al nro de caracteres permitidos';
                }

                if(!isset($_SESSION['error'])){

                    if($pass1 == $pass2){

                        $usu = $_SESSION['usuario']->id_usuario;

                        $usuario = new Usuario();
                        $usuario->setPassword($pass2);
                        $usuario->setIdUsuario($usu);
                        
                        $accion = $usuario->updatePass();

                        if($accion){
                            $_SESSION['actualizacion']['correcta'] = 'Se han actualizado correctamente los datos';
                            
                        }else{
                            $_SESSION['actualizacion']['incorrecta'] = 'Ha fallado la operación. Por favor intente nuevamente';
                        }

                    }else{
                        $_SESSION['error']['comparacion'] = 'El password no coincide con el anterior';
                    }

                }
            }

        }else{
            require_once 'views/error/errorweb.php';
        }
        
        header("Location:".base_url."usuario/seguridad");
    }

    // ----------------------------------------------------------------------------------------------
    public function cuenta() {
            if(isset($_SESSION['usuario'])) {
                require_once "views/usuario/cuenta.php";                              
            } else{
                header("Location:".base_url);
            }        
    }
    // ----------------------------------------------------------------------------------------------

    public function editar(){        
        // var_dump($_POST);
        // die();
        $nombre = isset($_POST['usuario']) ? $_POST['usuario'] : NULL; 
        $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : NULL; 
        $edad = isset($_POST['edad']) ? $_POST['edad'] : NULL; 
        $foto = isset($_FILES['foto']) ? $_FILES['foto'] : NULL; 

        if(empty($nombre) || empty($edad)) {
            $_SESSION['error']['campos'] = 'Debes de rellenar los campos que son obligatorios.';
        }

        if(!is_numeric($edad)){
            $_SESSION['error']['tipo'] = 'Solo deben de ir datos de tipo numerico.';
        }

        if(empty($_SESSION['error'])){
            
            $id = $_SESSION['usuario']->id_usuario;

            $dato = new Usuario();
            $dato->setIdUsuario($id);
            $dato->setNomUsuario($nombre);
            $dato->setDescripcion($descripcion);
            $dato->setEdad($edad);
            
            if($foto['name'] == null || $foto['name'] == $_SESSION['usuario']->foto_perfil) {

                $foto['name'] = $_SESSION['usuario']->foto_perfil;
                $dato->setFoto($foto['name']);

            }else{

                $mimetype = $foto['type'];

                if($mimetype == "image/jpg" || $mimetype == 'image/jpeg' || $mimetype == 'image/png' || $mimetype == 'image/gif'){
                    if(!is_dir('media/images')){
                        mkdir('media/images', 0777, true);
                    }                   
                    $dato->setFoto($foto['name']);                    

                }else{
                    $dato->setFoto(NULL);
                }  
            }
            //----- SI NO HAY ERRORES ACTUALIZAR
            $guardado = $dato->update();  

            if($guardado){
                $_SESSION['ejecucion']['guardar'] = 'La operación se realizó con exito!!';

                //Si la foto NO es nula, almacenara en la carpeta una copia
                if(!is_null($foto['name'])){
                    move_uploaded_file($foto['tmp_name'], 'media/images/'.$foto['name']);
                }

            }else{
                $_SESSION['error']['insertar'] = 'Error al guardar los datos.';                        
            } 
        }
        
        header("Location:".base_url."usuario/cuenta");
    }
    // ----------------------------------------------------------------------------------

    public function ver() {
        if(isset($_GET['id'])) {
            $id = $_GET['id'];

            $usuario = new Usuario();
            $historias = new Historias();

            $datos = $usuario->getOne($id);
            if(isset($_SESSION['admin'])){                
                $htr = $historias->getAll(null, null, $id, true);
            }else{
                $htr = $historias->getAll(null, null, $id);
            }
            
            require_once "views/usuario/ver.php";
        }else{
            header("Location:".base_url);
        }
    }
    // ----------------------------------------------------------------------------------

    public function eliminarUsuario() {
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $usuario = new Usuario();
            $result = $usuario->delete($id);  
            if($result){
                if($_SESSION['admin'] == true) {
                    unset($_SESSION['admin']);                               
                }
                unset($_SESSION['usuario']);
                header("Location:".base_url);

            }else{
                require_once 'views/error/errorweb.php';
            }
        }        
    }

    // ----------------------------------------------------------------------------------

    public function gestion() {
        if(isset($_SESSION['admin'])){
            $usu = new Usuario();
            
            $usuario = $usu->getAll();
            require_once "views/usuario/gestion.php";            
        }else{
            header("Location:".base_url);
        }
    }
    // ---------------------------------------------------------------------------------
    public function cambiarEstado() {
        if(isset($_GET['id']) && isset($_GET['estado'])){
            $id = $_GET['id'];
            $estado = $_GET['estado'];

            $usuario = new Usuario();
            $result = $usuario->updateState($id,$estado);

            header("Location:".base_url."usuario/gestion");
        }
    }
}