<?php

class Database{
	public static function connect(){
		$db = new mysqli('localhost', 'root', '12345', 'cuenta_tu_historia');
		$db->query("SET NAMES 'utf8'");
		return $db;
	}
}