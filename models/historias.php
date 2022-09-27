<?php

class Historias {
    private $idHistoria;
    private $titulo;
    private $historia;
    private $fecha;
    private $estadoh;
    private $idCat;
    private $idUsuario;

    private $db;

    public function __construct() {
		$this->db = Database::connect();
	}
	
    //GETTERS
	function getIdHistoria() {
		return $this->idHistoria;
	}

	function getTitulo() {
		return $this->titulo;
	}

    function getHistoria() {
        return $this->historia;
    }

    function getFecha() {
        return $this->fecha;
    }

    function getIdCat() {
        return $this->idCat;
    }

    function getIdUsuario() {
        return $this->idUsuario;
    }
    //SETTERS
    function setIdHistoria($idHistoria) {
        $this->idHistoria = $idHistoria;
    }

    function setTitulo($titulo) {
        $this->titulo = $this->db->real_escape_string($titulo);
    }

    function setHistoria($historia) {
        $this->historia = $this->db->real_escape_string($historia);
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    } 

    function setIdCat($idCat) {
        $this->idCat = $idCat;
    }

    function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }

    //Main functions
    public function getAll() {
        $publicaciones = $this->db->query("SELECT * FROM publicacion ORDER BY id_publicacion DESC");
        return $publicaciones;
    }


}