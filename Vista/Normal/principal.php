<?php 
include 'Vista/Normal/modalCompra.php';
?>
<!-- Centro de la Página web -->

<div class="box-header with-border">
  <h1 class="box-title">Tienda donde podra comprar lo que tu quieras</h1>
  <div class="box-tools pull-right"></div>
</div>

<div class="row">
  <div class="col-sm-3 col-md-3 col-lg-3"></div>
  <div class="col-sm-8 col-md-8 col-lg-8">
	

<div class="navbar-toggleable-sm">
	<div class="header-form pull-md-left m-md-r-1">
	<form class="form-inline m-b-1">
<div class="form-group">
	<label for="buscar">Buscar el articulo que desees</label>
	<input type="text" class="form-control b-a" placeholder="Buscar producto..." id="valor_a_comparar">
</div>
	<button type="button" class="btn btn-primary" id="boton_buscar">
		<i class="ti-search"></i>
	</button>
	<button type="button" class="btn btn-danger" id="boton_resetear">
		<i class="fa fa-remove"></i>
	</button>
	</form>
	</div>
</div>

</div>
</div>


<div class="panel-body table-responsive">
	<table cellpadding="0" cellspacing="0" border="0" id="tiendaUsuario" class="display table table-striped table-bordered table-condensed table-hover" style="width: 99%;">
    <thead class="cabecera">
    	<th>Información</th>
	</thead>
    <tbody class="cuerpo"></tbody>
    </table>
</div>




