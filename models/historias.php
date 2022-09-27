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

    //Queries functions
    public function getAll() {
        $publicaciones = $this->db->query("SELECT 
                                            id_publicacion, 
                                            titulo, 
                                            _publicacion, 
                                            fecha, 
                                            estado_p, 
                                            _cat, 
                                            _usuario 
                                            FROM publicacion INNER JOIN categoria USING(id_cat) 
                                            INNER JOIN usuario USING(id_usuario) 
                                            WHERE estado_p = 'Activado'
                                            ORDER BY id_publicacion DESC");
        return $publicaciones;
    }

    public function getOne() {
        $publicacion = $this->db->query("SELECT titulo,
                                            _publicacion,
                                            fecha,
                                            _cat,
                                            _usuario 
                                            FROM publicacion INNER JOIN categoria USING(id_cat) 
                                            INNER JOIN usuario USING(id_usuario)
                                            WHERE id_publicacion = {$this->getIdHistoria()}");
		return $publicacion->fetch_object();
    }
}