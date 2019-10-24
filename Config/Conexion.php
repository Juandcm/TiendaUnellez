<?php 
require_once 'Global.php';
setlocale(LC_ALL, 'es_VE');
setlocale(LC_MONETARY, 'it_IT');
// Setea el huso horario del servidor...
date_default_timezone_set('America/Caracas');

class Conexion{

	protected $conexion;
	public function __construct(){

		try{
			$this->conexion = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USERNAME, DB_PASSWORD,array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES '.DB_ENCODE));
			$this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			return $this->conexion;
		}catch (PDOException $e) {
			echo "¡Error!:".$e->getMessage();
			die();
		}
	}
}

?>