<?php session_start();
error_reporting(0);
require_once "../Modelo/Venta.php";
$Limpiarvar = new Funciones();
$usu_normal = new Venta();

$nombre = isset($_POST['nombre'])?$Limpiarvar->limpiar($_POST['nombre'],'0'):'';

// Sesion del usuario
$DataUsuario = isset($_SESSION['DatosUsuario'])?$_SESSION['DatosUsuario']:'';
$idUsuario = !empty($DataUsuario['usuario']['id'])?$DataUsuario['usuario']['id']:'';

$op = isset($_GET['op'])?$Limpiarvar->limpiar($_GET['op'],'0'):'No';

switch ($op) {

	case 'ventas':
	$usu_normal->ventas($idUsuario);
	break;
	
	default:
	break;
}

?>