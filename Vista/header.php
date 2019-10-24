	<?php 
	$DataUsuario = !empty($_SESSION['DatosUsuario'])?$_SESSION['DatosUsuario']:'';
	$permiso = isset($DataUsuario['usuario']['permiso'])?$DataUsuario['usuario']['permiso']:'';
	?>
	<!DOCTYPE html>
	<html lang="es">
	<head>
	<!-- Meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="description" content="Pagina de una tienda de la universidad Unellez">
	<meta name="author" content="Juan Colmenares">
	<link rel="shortcut icon" type="image/x-icon" href="Assets/icon/logo.ico">
		<!-- Title -->
	<title>Tienda Unellez</title>
	<!-- Vendor CSS -->
		<link rel="stylesheet" type="text/css" href="Assets/css/normalize.css">
		<link rel="stylesheet" href="Assets/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="Assets/icon/themify-icons/themify-icons.css">
		<link rel="stylesheet" href="Assets/icon/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="Assets/css/animate.min.css">
		<link rel="stylesheet" type="text/css" href="Assets/css/sweetalert2.min.css">
		<link rel="stylesheet" href="Assets/js/jscrollpane/jquery.jscrollpane.css">
		<link rel="stylesheet" type="text/css" href="Assets/css/fine-uploader-new.css">
		<link rel="stylesheet" type="text/css" href="Assets/css/jquery.dataTables.min.css">

		<link rel="stylesheet" type="text/css" href="Assets/css/jquery.bootstrap-touchspin.css">
	<!-- Neptune CSS -->
		<link rel="stylesheet" href="Assets/css/core.css">

	<!-- Datatable -->
	<link rel="stylesheet" href="Assets/css/datatable/jquery.dataTables.min.css">
	<link rel="stylesheet" href="Assets/css/datatable/responsive.dataTables.min.css">
	<link rel="stylesheet" href="Assets/css/jquery-ui.custom.css">

		<link rel="stylesheet" type="text/css" href="Assets/css/estilos.css">
	</head>

	<body class="large-sidebar fixed-sidebar fixed-header">
	<!-- Preloader -->
	<div class="preloader"></div>

	<?php 

	switch ($permiso) {
		case '0':
		include('normal.php');
		break;
		
		case '1':
		include('administrador.php');
		break;
		
		default:
		break;
	}


	?>










Esto puede ayudar en la parte de compras
file:///C:/xampp/htdocs/Pagina%20Castinblanco/PaginAdmin/cubic-minisidebar/invoice.html
file:///C:/xampp/htdocs/Pagina Castinblanco/PaginAdmin/cubic-minisidebar/profile.html