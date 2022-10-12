<?php

class Categoria{
	private $id;
	private $nomcat;
	private $db;
	
	public function __construct() {
		$this->db = Database::connect();
	}
	
	function getId() {
		return $this->id;
	}

	function getNomcat() {
		return $this->nomcat;
	}

	function setId($id) {
		$this->id = $id;
	}

	function setNomcat($nomcat) {
		$this->nomcat = $this->db->real_escape_string($nomcat);
	}

	public function getAll(){
		$categorias = $this->db->query("SELECT * FROM categoria ORDER BY id_cat DESC;");
		return $categorias;
	}
	
	public function getOne(){
		$categoria = $this->db->query("SELECT * FROM categoria WHERE id_cat ={$this->getId()}");
		return $categoria->fetch_object();
	}

	public function delete($id) {
		
		// para eliminar en cascada de una tabla que influye al resto (categoria) eliminamos con un ciclo (porque arroja varios registros en una sola consulta)
		// la tabla que es menos directa, hasta la que tiene una relación mas directa, finalizando con la tabla raiz (categoria).		
		$sql = "SELECT id_publicacion FROM publicacion WHERE id_cat = '$id'";
		$cursor = $this->db->query($sql);
		while($lista = $cursor->fetch_object()){
			$sql1 = "DELETE FROM likes WHERE id_publicacion = '$lista->id_publicacion'";
			$ciclo = $this->db->query($sql1);
		}
		//------------------
		$sql2 = "DELETE FROM publicacion WHERE id_cat = '$id'";
		$sql3 = "DELETE FROM categoria WHERE id_cat = '$id'";

		$publicacion = $this->db->query($sql2);
		$cat = $this->db->query($sql3);

		if($cat){
			$result = true;
		}
		return $result;
	}

	public function add(){
		$sql = "INSERT INTO categoria VALUES(NULL, '{$this->getNomCat()}');";

		$cat = $this->db->query($sql);

		if($cat){
			$result = true;
		}
		return $result;
	}
}