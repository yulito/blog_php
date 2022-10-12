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

    function getEstadoh() {
        return $this->estadoh;
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

    function setEstadoh($estadoh) {
        $this->estadoh = $estadoh;
    }

    function setIdCat($idCat) {
        $this->idCat = $idCat;
    }

    function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }

    //Queries functions
    public function getAll($limit=null, $cat=null, $usu=null, $estado=null, $estUsuario=null) {
        $sql="SELECT 
                id_publicacion, 
                titulo, 
                _publicacion, 
                fecha, 
                estado_p,
                id_cat, 
                _cat, 
                _usuario,
                estado 
                    FROM publicacion INNER JOIN categoria USING(id_cat) 
                    INNER JOIN usuario USING(id_usuario)
                    ";

        if(!empty($estado)){
            $sql .= " WHERE estado_p LIKE '%ado' ";
        }else{
            $sql .= " WHERE estado_p = 'Activado' ";
        }

        if(!empty($estUsuario)){
            $sql .= " AND estado LIKE '%ado' ";
        }else{
            $sql .= " AND estado = 'Activado' ";
        }

        if(!empty($cat)) {
            $sql .= " AND id_cat = '$cat'";  
        }

        if(!empty($usu)) {
            $sql .= " AND id_usuario = '$usu'";  
        }

        $sql .=" ORDER BY id_publicacion DESC";

        if($limit == true) {
            $sql .=" LIMIT 6";
        }
        
        $publicaciones = $this->db->query($sql);
        return $publicaciones;
    }

    public function getOne() {
        $publicacion = $this->db->query("SELECT id_publicacion,
                                            titulo,
                                            _publicacion,
                                            fecha,
                                            id_cat,
                                            _cat,
                                            _usuario,
                                            estado_p, 
                                            id_usuario
                                            FROM publicacion INNER JOIN categoria USING(id_cat) 
                                            INNER JOIN usuario USING(id_usuario)
                                            WHERE id_publicacion = {$this->getIdHistoria()}");
		return $publicacion->fetch_object();
    }

    public function add() {

        $sql = "INSERT INTO publicacion VALUES(NULL,'{$this->getTitulo()}','{$this->getHistoria()}',CURDATE(),'{$this->getEstadoh()}','{$this->getIdCat()}','{$this->getIdUsuario()}')";
        $publicacion = $this->db->query($sql);

        if($publicacion){
            $result = true;
        }

        return $result;
        
    }

    //-----------------------------------------------------------------------------------------

    public function update($id,$estado){
        if($estado == 'Activado'){
            $estado = 'Desactivado';
        }else{
            $estado = 'Activado';
        }
        $sql = "UPDATE publicacion SET estado_p = '$estado' WHERE id_publicacion = '$id'";
        $publicacion = $this->db->query($sql);

        if($publicacion){
            $result = true;
        }

        return $result;
    }

    //-----------------------------------------------------------------------------------------

    public function delete($id) {
        
        $sql = "DELETE FROM publicacion WHERE id_publicacion = '$id'";

        $publicacion = $this->db->query($sql);

        if($publicacion){
            $result = true;
        }

        return $result;        
    }
    
}