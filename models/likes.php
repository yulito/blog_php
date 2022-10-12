<?php

class Likes{
    private $idLike;
    private $idUser;
    private $idHtr;    

    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    //GETTERS
    function getIdLike(){
        return $this->idLike;
    }

    function getIdUser(){
        return $this->idUser;
    }

    function getIdHtr(){
        return $this->idHtr;
    }

    //SETTERS
    function setIdLike($idLike){
        $this->idLike = $idLike;
    }

    function setIdUser($idUser){
        $this->idUser = $idUser;
    }

    function setIdHtr($idHtr){
        $this->idHtr = $idHtr;
    }
    /////////////////////////////////////////
    public function getAll() {
        $usuario = $_SESSION['usuario']->id_usuario;
        //el sig. join lo hago de esta manera ya que tanto la tabla publicacion como like comparten usuario (esto genera ambiguedad)
        $sql = "SELECT id_like,
                    u._usuario as autor, 
                    p.titulo as titulo,
                    p.id_publicacion as id
                    FROM likes l INNER JOIN publicacion p ON(l.id_publicacion = p.id_publicacion)
                                INNER JOIN usuario u ON(u.id_usuario = p.id_usuario)
                                WHERE l.id_usuario = '$usuario' AND p.estado_p = 'Activado';";
        $query = $this->db->query($sql);
        $result = false;
		if($query){
			$result = $query;
		}
		return $result;
    }
    // ---------------------------------
    public function getOne(){
        $sql = "SELECT * FROM likes WHERE id_usuario = '{$this->getIdUser()}' AND id_publicacion = '{$this->getIdHtr()}';";        
        $query = $this->db->query($sql);
        return $query;
    }

    public function htrLikes() {

        $sql = "INSERT INTO likes VALUES(NULL, '{$this->getIdUser()}','{$this->getIdHtr()}')";
        $likes = $this->db->query($sql);
        if($likes){
            return true;
        }
        
    }

    public function htrDisLike() {

        $sql = "DELETE FROM likes WHERE id_like = '{$this->getIdLike()}';";
        
        $likes = $this->db->query($sql);  

        if($likes){
            return true;
        }
    }

    

}