<!--Inicio Modal Registrar-->
<div class="modal animated flipInX small-modal in" id="editarUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
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
								<h5 class="text-white">Editar usuario</h5>
							</div>
						</div>
						<div class="m-5"></div>
					</div>
				</div>
			</div>
			
			<div class="box b-a-0">
				<form class="form-material m-b-1" id="formRegistro">
					<div class="form-group">
						<div class="input-group">
							<input class="form-control" id="nombreRegistro" placeholder="Nombre" type="text">
						</div>
					</div>
					<div class="form-group">
						<div class="input-group">
							<input class="form-control" id="apellidoRegistro" placeholder="Apellido" type="text">
						</div>
					</div>
					<div class="form-group">
						<div class="input-group">
							<input class="form-control" id="correoRegistro" placeholder="Correo" type="email">
						</div>
					</div>
					<div class="form-group">
						<div class="input-group">
							<input class="form-control" id="telefonoRegistro" placeholder="Telefono" type="email">
						</div>
					</div>
					
					<div class="form-group">
						<div class="input-group">
							<input class="form-control" id="contrasenaRegistro" placeholder="Contraseña" type="password">
						</div>
					</div>


					<div class="form-group">
						<div id="fine-uploader-validation"></div>
						<input type="hidden" id="foto_usuario">
					</div>

					<div class="p-x-2 form-group m-b-0">
						<button type="button" id="botonEditar" class="btn btn-success btn-block text-uppercase">Registrar</button>
					</div>
				</form>
			</div>
		</div>
	</div>


</div>
<!--Fin Modal REGISTRAR-->