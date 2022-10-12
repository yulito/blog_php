<?php

class Database{
	public static function connect(){
		$db = new mysqli('localhost', 'usuario', 'pass', 'nombre_db');
		$db->query("SET NAMES 'utf8'");
		return $db;
	}
}