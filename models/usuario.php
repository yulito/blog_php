<?php

class Usuario {

    private $idUsuario;
    private $nomUsuario;
    private $descripcion;
    private $foto;
    private $edad;
    private $sexo;
    private $correo;
    private $password;
    private $estado;
    private $idRol;

    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    //GETTERS
    function getIdUsuario() {
        return $this->idUsuario;
    }

    function getNomUsuario() {
        return $this->nomUsuario;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getFoto() {
        return $this->foto;
    }

    function getEdad() {
        return $this->edad;
    }

    function getSexo() {
        return $this->sexo;
    }

    function getCorreo() {
        return $this->correo;
    }

    function getPassword() {
        return $this->password;
    }

    function getEstado() {
        return $this->estado;
    }

    function getIdRol() {
        return $this->idRol;
    }

    //SETTERS
    function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }

    function setNomUsuario($nomUsuario) {
        $this->nomUsuario = $this->db->real_escape_string($nomUsuario);
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $this->db->real_escape_string($descripcion);
    }

    function setFoto($foto) {
        $this->foto = $foto;
    }

    function setEdad($edad) {
        $this->edad = $edad;
    }

    function setSexo($sexo) {
        $this->sexo = $this->db->real_escape_string($sexo);
    }

    function setCorreo($correo) {
        $this->correo = $this->db->real_escape_string($correo);
    }

    function setPassword($password) {
        $this->password = password_hash($this->db->real_escape_string($password), PASSWORD_BCRYPT, ['cost' => 4]);        
    }

    function setEstado($estado) {
        $this->estado = $this->db->real_escape_string($estado);
    }

    function setIdRol($idRol) {
        $this->idRol = $idRol;
    }
    //-------------------------------------------
    public function guardarUsuario() {
        $sql="INSERT INTO usuario VALUES(NULL,'{$this->getNomUsuario()}','{$this->getDescripcion()}','{$this->getFoto()}','{$this->getEdad()}','{$this->getSexo()}','{$this->getCorreo()}','{$this->getPassword()}','Activado',1)";
        $guardar = $this->db->query($sql);
		
		$result = false;
		if($guardar){
			$result = true;
		}
		return $result;
    }
    //------------------------------------------

    public function getOne($id) {
        $sql = "SELECT * FROM usuario WHERE id_usuario = '$id';";
        $query = $this->db->query($sql);
		$q = $query->fetch_object();

		$result = false;
		if($q){
			$result = $q;
		}
		return $result;
    }
    //------------------------------------------

    public function getAll() {
        $sql = "SELECT * FROM usuario ORDER BY id_usuario DESC;";
        $query = $this->db->query($sql);   
        
		$result = false;
		if($query){
			$result = $query;
		}
		return $result;
    }
    // ------------------------------------------

    public function sesion($id, $estado){

        $sql = "INSERT INTO sesion VALUES(NULL, NOW(),'$estado','$id');";
        $query = $this->db->query($sql);
        if($query){
            $result = true;
        }
        return $result;
    }

    //-------------------------------------------
    public function ingresar($pass) {
        //$result = false;
		$correo = $this->correo;
		//$password = $this->password;
		
		// Comprobar si existe el usuario
		$sql = "SELECT * FROM usuario WHERE correo = '$correo' AND estado = 'Activado';";
		$login = $this->db->query($sql);
		
		
		if($login && $login->num_rows == 1){
			$usuario = $login->fetch_object();
			
			// Verificar la contraseña
			$verify = password_verify($pass, $usuario->password); //$password, $usuario->password
			
			if($verify){
                //Guardamos la sesion
                $this->sesion($usuario->id_usuario, 1);

                //enviamos datos del  usuairo
				$result = $usuario;
			}
		}

        return $result;
    }

    //-------------------------------------------

    public function updatePass() {

        $pass = $this->getPassword();
        $usuario = $this->getIdUsuario();
        $sql = "UPDATE usuario SET password = '$pass' WHERE id_usuario = '$usuario';";

        $actualizado = $this->db->query($sql);

        if($actualizado) {
            $result = true;
        }

        return $result;

    }

    // -------------------------------------------

    public function update() {
        $sql = "UPDATE usuario 
                SET _usuario ='{$this->getNomUsuario()}',
                descripcion ='{$this->getDescripcion()}',
                edad ='{$this->getEdad()}',
                foto_perfil ='{$this->getFoto()}' 
                WHERE id_usuario ='{$this->getIdUsuario()}';";
        $actualizado = $this->db->query($sql);
        if($actualizado) {
            $result = true;
        }
        return $result;
    }
    
    //---------------------------------------------------------------------------
    public function delete($id){
        $sql1 = "DELETE FROM publicacion WHERE id_usuario = '$id';";
        $sql2 = "DELETE FROM sesion WHERE id_usuario = '$id';";
        $sql3 = "DELETE FROM usuario WHERE id_usuario = '$id';";

        $publicacion = $this->db->query($sql1);
        $sesion = $this->db->query($sql2);
        $usuario = $this->db->query($sql3);

        if($usuario){
            $result = true;
        }
        return $result;
    }
    //----------------------------------------------------
    public function updateState($id,$estado){
        if($estado == 'Activado'){
            $estado = 'Desactivado';
        }else{
            $estado = 'Activado';
        }
        
        $sql2 = "UPDATE usuario SET estado = '$estado' WHERE id_usuario = '$id'";
        $usuario = $this->db->query($sql2);

        if($usuario){
            $result = true;
        }

        return $result;
    }
}