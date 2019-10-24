<?php session_start();
error_reporting(0);
require_once "../Modelo/Compra.php";
$Limpiarvar = new Funciones();
$usu_normal = new Compra();

$idArticulo = isset($_POST['idArticulo'])?$Limpiarvar->limpiar($_POST['idArticulo'],'1'):'';
$cantidad = isset($_POST['cantidad'])?$Limpiarvar->limpiar($_POST['cantidad'],'1'):'';

// Sesion del usuario
$DataUsuario = isset($_SESSION['DatosUsuario'])?$_SESSION['DatosUsuario']:'';
$idUsuario = !empty($DataUsuario['usuario']['id'])?$DataUsuario['usuario']['id']:'';
$creado = date("Y-m-d H:i:s");

$op = isset($_GET['op'])?$Limpiarvar->limpiar($_GET['op'],'0'):'No';

switch ($op) {

	case 'comprarArticulo':
	$usu_normal->comprarArticulo($idArticulo,$cantidad,$idUsuario,$creado);
	break;

	case 'compras':
	$usu_normal->compras($idUsuario);
	break;
	
	default:
	break;
}
?>