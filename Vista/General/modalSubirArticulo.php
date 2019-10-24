<!--Inicio Modal Entrar-->
<div class="modal animated flipInY small-modal in" id="subirArticulo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header cm-img img-cover" style="background-image: url(Assets/img/1.jpg);">
<div>
	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">X</span>
	</button>
<div class="gradient gradient-success"></div>
<div class="cm-content">
<div class="clearfix">
		<div class="modal-title p-a-2 text-xs-center">
		<h5 class="text-light">Subir articulo en la tienda</h5>
		</div>
</div>
<div class="m-5"></div>
</div>
</div>
</div>
     
<div class="box b-a-0">
	<form class="form-material m-b-1" id="formSubirArticulo">
	<div class="form-group">
		<div class="input-group">
		<input class="form-control" id="nombreArticulo" placeholder="Nombre del articulo" type="text">	
		</div>
	</div>
	
	<div class="form-group">
		<div class="input-group">
		<input class="form-control" id="descripcionArticulo" placeholder="Describe el articulo" type="text">
		</div>
	</div>

	<div class="form-group">
		<div class="input-group">
		<input class="form-control autonumber" id="precioArticulo" placeholder="Precio" type="text" data-a-sep="." data-a-dec=",">
		</div>
	</div>


	<div class="form-group">
		<div class="input-group">
		<input class="form-control" id="cantidadArticulo" placeholder="Cantidad total del articulo" type="number" min="1">
		</div>
	</div>

<div class="form-group">
<div id="fine-uploader-validation2"></div>
<input type="hidden" id="foto_articulo">
</div>



	<div class="p-x-2 form-group m-b-0">
		<button type="button" id="botonSubirArticulo" class="btn btn-success btn-block text-uppercase">Subir articulo</button>
	</div>
	</form>
</div>
</div>
</div>
</div>
<!--Fin Modal Entrar-->