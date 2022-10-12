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
		$sql1 = "DELETE FROM publicacion WHERE id_cat = '$id'";
		$sql2 = "DELETE FROM categoria WHERE id_cat = '$id'";

		$publicacion = $this->db->query($sql1);
		$cat = $this->db->query($sql2);

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