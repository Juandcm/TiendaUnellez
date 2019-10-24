<?php 
include 'Vista/General/modalEditarUsuario.php';
$DataUsuario = !empty($_SESSION['DatosUsuario'])?$_SESSION['DatosUsuario']:'';
$vista = isset($_REQUEST['vista'])?$_REQUEST['vista']:'No';

$active1='';
$active2='';
$active3='';
$active4='';


switch ($vista) {
	case 'No':
	$active1='active';
	break;
	case 'compra':	
	$active2='active';
	break;
	case 'venta':	
	$active3='active';
	break;
	case 'inventario':
	$active4='active';
	break;
	default:
	$active1='active';
	break;
}
if (!empty($DataUsuario['usuario']['nombre']) || !empty($DataUsuario['usuario']['apellido']) || !empty($DataUsuario['usuario']['email']) || !empty($DataUsuario['usuario']['telefono'])) {

  $id = $DataUsuario['usuario']['id'];
  $nombre = $DataUsuario['usuario']['nombre'];
  $apellido = $DataUsuario['usuario']['apellido'];
  $email = $DataUsuario['usuario']['email'];
  $telefono = $DataUsuario['usuario']['telefono'];
  $foto_usuario = !empty($DataUsuario['usuario']['foto_usuario'])?$DataUsuario['usuario']['foto_usuario']:'user-default.jpg';

  $fechaOriginal = $DataUsuario['usuario']['creado'];
  $fechaFormateada = date("d-m-Y", strtotime($fechaOriginal));
  $creado=$fechaFormateada;

?>

<div class="wrapper">

<!-- Revisar desde aca para cambiar -->
<!-- Sidebar -->
<div class="site-sidebar-overlay"></div>
<div class="site-sidebar">
<a class="logo" href="index.html">
	<span class="l-text">Tienda Unellez</span>
	<span class="l-icon"></span>
</a>

<div class="custom-scroll custom-scroll-light">

<!-- Perfil corto -->
<div>
	<div class="nav-fold">
	<a href="">
	    <span class="pull-left">
	      <img src="SubidArchivos/archivos/fotosUsuario/<?=$foto_usuario?>" alt="..." class="w-40 r">
	    </span>
	    <span class="clear hidden-folded p-x">
	      <span class="block _500"><?=$nombre." ".$apellido?></span>
	      <small class="block text-muted">Bienvenido usuario</small>
	    </span>
	</a>
</div>
</div>
<!--fin Perfil corto -->

<!-- Inicio de barra navegacion -->
	<ul class="sidebar-menu">
	<li class="menu-title m-t-0-5">Menú Principal de la tienda</li>
<!-- Inicio del menu -->
	<li class="<?= $active1 ?>">
	<a href="index.php" class="waves-effect  waves-light">
		<!-- <span class="s-caret"><i class="fa fa-angle-down"></i></span> -->
		<!-- <span class="s-icon"><i class="ti-settings"></i></span> -->
		<span class="s-text">Tienda</span>
	</a>
	</li>

	<li class="<?= $active2 ?>">
	<a href="index.php?vista=compra" class="waves-effect  waves-light">
		<!-- <span class="s-caret"><i class="fa fa-angle-down"></i></span> -->
		<!-- <span class="s-icon"><i class="ti-settings"></i></span> -->
		<span class="s-text">Compras</span>
	</a>
	</li>

	<li class="<?= $active3 ?>">
	<a href="index.php?vista=venta" class="waves-effect  waves-light">
		<!-- <span class="s-caret"><i class="fa fa-angle-down"></i></span> -->
		<!-- <span class="s-icon"><i class="ti-settings"></i></span> -->
		<span class="s-text">Ventas</span>
	</a>
	</li>

	<li class="<?= $active4 ?>">
	<a href="index.php?vista=inventario" class="waves-effect  waves-light">
		<!-- <span class="s-caret"><i class="fa fa-angle-down"></i></span> -->
		<!-- <span class="s-icon"><i class="ti-settings"></i></span> -->
		<span class="s-text">Inventario</span>
	</a>
	</li>
<!-- Aqui pueden ir otros menu Fin -->

</ul>
<!-- fin de barra navegacion -->
</div>
</div>

<!-- Parte del header nav -->

<div class="site-header">
	<nav class="navbar navbar-light">
	<ul class="nav navbar-nav">
	<li class="nav-item m-r-1 hidden-lg-up">
		<a class="nav-link collapse-button" href="#">
		<i class="ti-menu"></i>
		</a>
	</li>
	</ul>
	<ul class="nav navbar-nav pull-xs-right">
	

<!-- Perfil usuario -->
<li class="nav-item dropdown">
	<a class="nav-link" href="#" data-toggle="dropdown" aria-expanded="false">
	<div class="avatar box-32">
		<img src="SubidArchivos/archivos/fotosUsuario/<?=$foto_usuario?>" alt="">
	</div>
	</a>
	<div class="dropdown-menu dropdown-menu-right animated flipInY">
	<a class="dropdown-item" href="#" data-toggle="modal" data-target="#editarUsuario">
		<i class="ti-user m-r-0-5"></i> Editar Perfil
	</a>
	<div class="dropdown-divider"></div>
	<a class="dropdown-item" href="#" id="cerrarSession"><i class="ti-power-off m-r-0-5"></i> Cerrar sesión</a>
	</div>
</li>
<!-- Fin Perfil usuario -->


</ul>

</nav>
</div>


<!-- Contenido principal  -->
<div class="site-content">
<!-- Content -->
<div class="content-area p-y-1">

<div class="container-fluid">

<?php 
switch ($vista) {
	case 'No':
	include 'Vista/Normal/principal.php';
	break;

	case 'compra':
	include 'Vista/Normal/compra.php';	
	break;

	case 'venta':
	include 'Vista/Normal/venta.php';	
	break;

	case 'inventario':
	include 'Vista/Normal/inventario.php';	
	break;
	
	default:
	include 'Vista/Normal/principal.php';
	break;
}
?>

</div>



</div>

	
	<!-- Footer -->
<footer class="footer">
	<div class="container-fluid">
	2018 © Unellez
	</div>
</footer>
</div>

<!-- Fin del Contenido principal  -->
<!-- Revisar hasta aca para cambiar -->

</div>

<?php 
}else{
	// No me va a mostrar nada
}
?>