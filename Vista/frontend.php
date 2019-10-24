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
		<link rel="stylesheet" type="text/css" href="Assets/css/fine-uploader-new.css">
	<!-- Datatable -->
	<link rel="stylesheet" href="Assets/css/datatable/jquery.dataTables.min.css">
	<link rel="stylesheet" href="Assets/css/datatable/responsive.dataTables.min.css">
	<link rel="stylesheet" href="Assets/css/jquery-ui.custom.css">

		<link rel="stylesheet" type="text/css" href="Assets/css/jquery.bootstrap-touchspin.css">

	<link rel="stylesheet" type="text/css" href="Assets/css/owl.carousel.min.css">

	<!-- Neptune CSS -->
		<link rel="stylesheet" href="Assets/css/core.css">
		<link rel="stylesheet" type="text/css" href="Assets/css/estilos.css">


	</head>

	<body>
	<?php 
	include 'Vista/General/modalEntrar.php';
	include 'Vista/General/modalRegistro.php';
	include 'Vista/General/modalVerArticulo.php';
	include 'Vista/General/modalContacto.php';
	include 'Vista/General/modalAyuda.php';
	?>


	<!-- Inicio -->
	<div class="frontend-wrapper bg-white">
	<!-- INICIO HEADER COMPLETO-->

	<div class="preloader"></div>

	<div class="header text-xs-center img-cover" style="background-image: url(Assets/img/1.jpg);">
	<div class="gradient gradient-warning"></div>
	<div class="h-content">
		<div class="clearfix">
			<div class="h-logo pull-xs-left"><a class="text-white" href="#">Tienda Unellez</a></div>
		<div class="h-menu pull-xs-right">
		<ul class="list-inline m-b-0">
			<li class="list-inline-item"><a class="text-gray-dark" href="#" data-toggle="modal" data-target="#modalAyuda">Ayuda</a></li>
			<li class="list-inline-item"><a class="text-gray-dark" href="#" data-toggle="modal" data-target="#modalContacto">Contactame</a></li>
		</ul>
		</div>
		</div>
	<!-- Fin header -->

	<!-- Inicio centro header -->
	<div class="row">
		<div class="col-md-8 offset-md-2">
		<div class="h-title">Tienda de la Unellez</div>
			<div class="img-fluid">
		<img src="Assets/img/logo.png" class="img-thumbnail" alt="">
			</div>
		<div class="h-text text-gray-dark">Esta tienda se ha creado para el proposito de comprar y vender cualquier cosa que se desee. por eso esta página web tratara de hacer todo lo posible en ayudarte en ese sentido</div>
		<div class="h-buttons">
			<button class="btn btn-danger btn-rounded btn-lg" data-toggle="modal" data-target="#entrarTienda">Entrar</button>
			<button class="btn btn-outline-white btn-rounded btn-lg" data-toggle="modal" data-target="#registroTienda">Registrar</button>
		</div>
		</div>
	</div>
	<!-- fin centro header -->
		
	</div>
	</div>
	<!-- FIN HEADER COMPLETO-->


	<!-- Inicio del contenido -->
	<div class="block-1">
	<div class="container-fluid">
		<h3 class="title-1"><span class="b-t-danger">Los productos más recientes</span></h3>
		<div class="text-muted text-xs-center m-b-3">A continuación se muestran los productos más recientes subidos por los usuarios que usted podra comprar en el sitio web.</div>


		


	<div class="row">
		<!-- Inicio slider -->
	<div id="verArticulosRecientes">
		
	</div>
	    <!-- Fin slider -->
	</div>

	</div>
	</div>
	<!-- Fin del contenido -->

	<!-- Inicio del segundo contenido -->
	<div class="block-2 bg-transparent">
	<div class="container-fluid">
	<div class="row">

	  <div class="col-sm-2 col-md-2 col-lg-2"></div>
	  <div class="col-sm-8 col-md-8 col-lg-8">


	<?php 
	include 'Vista/General/mostrarArticulos.php';
	?>			


	</div>
	</div>
	</div>
	<!-- FIN del segundo contenido -->

	<!-- Inicio del tercer contenido -->
	<div class="block-9 img-cover img-fixed" style="background-image: url(Assets/img/12.jpg);">
	<div class="container-fluid">
	<div class="row">
	<div class="col-md-4 animate fadeInUp" data-gen="fadeInUp" data-gen-offset="90%" style="">
		<div class="b-number" id="cantidadUsuario"></div>
		<div class="b-title">Usuarios</div>
		<div class="b-text">Actualmente existen registrados esa cantidad de usuarios.</div>
	</div>

	<div class="col-md-4 animate fadeInBottom" data-gen="fadeInBottom" data-gen-offset="90%" style="">
		<div class="b-number" id="cantidadArticulosAprobados"></div>
		<div class="b-title">Productos</div>
		<div class="b-text">Actualmente existen registrados esa cantidad de productos que se encuentran aprobados para la venta.</div>
	</div>
	<div class="col-md-4 animate fadeInBottom" data-gen="fadeInBottom" data-gen-offset="90%" style="">
		<div class="b-number" id="cantidadArticulosDesprobados"></div>
		<div class="b-title">Productos</div>
		<div class="b-text">Actualmente existen registrados esa cantidad de productos que no se encuentran aprobados para la venta.</div>
	</div>


	</div>
	</div>
	</div>
	<!-- Fin del tercer contenido -->

	<!-- Inicio del ultimo contenido -->
	<div class="block-4">
	<div class="container-fluid">
	<div class="m-b-2">
	Realizado en el 2018 
	<br>
	 Por <span class="text-danger">Juan Colmenares</span>
	</div>
	<div class="b-to-top"><i class="ti-angle-double-up"></i></div>
	</div>
	</div>
			
	</div>

	<!-- Fin -->


	<script type="text/template" id="qq-template-validation">
	  <?php include "Vista/PlantillaSubidaFiles.php"; ?>
	</script>

		<!-- Vendor JS -->
		<script type="text/javascript" src="Assets/js/jquery.min.js"></script>
		<script src="Assets/js/modernizr-custom.js"></script>
		<script type="text/javascript" src="Assets/js/tether/js/tether.min.js"></script>
		<script type="text/javascript" src="Assets/bootstrap/js/bootstrap.min.js"></script>
		<script src="Assets/js/sweetalert2.min.js"></script>

	<!-- Datatables -->
	<script src="Assets/js/datatable/jquery.dataTables.min.js"></script>
	<script src="Assets/js/datatable/dataTables.buttons.min.js"></script>
	<script src="Assets/js/datatable/dataTables.responsive.min.js"></script>
	<script src="Assets/js/jquery-ui-tabs.js"></script>
	<!-- Subida de archivos -->
	<script src="Assets/js/jquery.fine-uploader.min.js"></script>

	<script src="Assets/js/jquery.validate.min.js"></script>
		<!-- Neptune JS -->
		<script type="text/javascript" src="Assets/js/owl.carousel.min.js"></script>
		<script src="Assets/js/interaccion.js"></script>

		</body>
	</html>