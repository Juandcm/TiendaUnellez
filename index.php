<?php session_start();
// No me va a ningun error que puede tener el codigo php
error_reporting(-1);

$DataUsuario = !empty($_SESSION['DatosUsuario'])?$_SESSION['DatosUsuario']:'';


if (!isset($_SESSION['DatosUsuario'])) {
	include_once "Vista/frontend.php";
}else{

include_once "Vista/header.php";

include_once "Vista/footer.php";

}

?>
