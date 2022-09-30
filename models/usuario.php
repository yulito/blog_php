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

}