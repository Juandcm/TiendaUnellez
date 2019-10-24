$(document).ready(function(){
	$(document).on('click', '.b-to-top', function () {
		$('html, body').animate({
			scrollTop: 0
		}, 500);
		return false;
	});
	
	/* Preloader */
	setTimeout(function() {
		$('.preloader').fadeOut();
	}, 500);

	if ($('.autonumber').length>0) {
		$('.autonumber').autoNumeric('init');
	}

});

// Este codigo borra todo cuando se cierra el modal
$('#registroTienda').on('hidden.bs.modal', function () {
	$('#formRegistro input').val('');
	if ($('#foto_usuario').val().trim() == '') {
		elimininarDespuesde();
	} else {}
});

$('#eliminarImagenForm').on('click', eliminarImagen());

function elimininarDespuesde() {
	setTimeout(function () {
		$("#eliminarImagenForm").click();
	}, 4000);
}

function eliminarImagen() {
	$('#foto_usuario').val('');
	$('#url_archivo').val('');
}

var swalWithBootstrapButtons = swal.mixin({
	confirmButtonClass: 'btn btn-success',
	cancelButtonClass: 'btn btn-danger',
	buttonsStyling: false
});

// Aqui muestra el swall alert del tipo error
function alertaError(valorestado, valormsg) {
	swal({
		type: valorestado,
		title: 'Error',
		text: valormsg,
		showConfirmButton: false,
		timer: 3000
	});
}
// Aqui muestra el swall alert del tipo success
function alertaSuccess(valorestado, valormsg) {
	swal({
		type: valorestado,
		title: 'Exito',
		text: valormsg,
		showConfirmButton: false,
		timer: 3000
	});
}

function recargarPagina(direccion) {
	if (direccion.length > 0) {
		setTimeout(function () {
			window.location.replace(direccion);
		}, 2000);
	} else {
		setTimeout(function () {
			window.location.reload(true);
		}, 2000);
	}

}



// Subida del articulo del usuario con Fine uploader
$("#fine-uploader-validation2").fineUploader({
	// Aqui me muestra la plantilla personalizada
	template: 'qq-template-validation',
	// Aqui me muestra los mensajes en la consola
	// debug: true,
	multiple: false,
	autoUpload: false,
	request: {
		endpoint: 'Assets/FineUploader/ArchivosUsuario.php'
	},
	thumbnails: {
		placeholders: {
			waitingPath: 'Assets/js/placeholders/waiting-generic.png',
			notAvailablePath: 'Assets/js/placeholders/not_available-generic.png'
		}
	},
	validation: {
		itemLimit: 1,
		sizeLimit: 512000, // 50 kB = 50 * 1024 bytes
		acceptFiles: "image/jpeg, image/jpeg, image/png, image/gif",
		allowedExtensions: ['jpeg', 'jpg', 'png', 'gif']
	},
	resume: {
		enabled: true
	},
	retry: {
		enableAuto: true,
		showButton: true
	},
	deleteFile: {
		enabled: true,
		endpoint: "Assets/FineUploader/ArchivosUsuario.php"
	}
}).on('error', function (event, id, name, reason) {
	console.log(event);
	console.log(reason);
}).on('complete', function (event, id, name, response) {
	ubicacionFoto = response.uuid + "/" + response.uploadName;
	valorFoto = $('#foto_articulo').val(ubicacionFoto);
});

// Subida de la foto del usuario con Fine uploader
$("#fine-uploader-validation").fineUploader({
	// Aqui me muestra la plantilla personalizada
	template: 'qq-template-validation',
	// Aqui me muestra los mensajes en la consola
	// debug: true,
	multiple: false,
	autoUpload: false,
	request: {
		endpoint: 'Assets/FineUploader/FotoUsuario.php'
	},
	thumbnails: {
		placeholders: {
			waitingPath: 'Assets/js/placeholders/waiting-generic.png',
			notAvailablePath: 'Assets/js/placeholders/not_available-generic.png'
		}
	},
	validation: {
		itemLimit: 1,
		sizeLimit: 512000, // 50 kB = 50 * 1024 bytes
		acceptFiles: "image/jpeg, image/jpeg, image/png, image/gif",
		allowedExtensions: ['jpeg', 'jpg', 'png', 'gif']
	},
	resume: {
		enabled: true
	},
	retry: {
		enableAuto: true,
		showButton: true
	},
	deleteFile: {
		enabled: true,
		endpoint: "Assets/FineUploader/FotoUsuario.php"
	}
}).on('error', function (event, id, name, reason) {
	console.log(event);
	console.log(reason);
}).on('complete', function (event, id, name, response) {
	ubicacionFoto = response.uuid + "/" + response.uploadName;
	valorFoto = $('#foto_usuario').val(ubicacionFoto);
});

$("#formRegistro").validate({
	rules: {
		correoRegistro: {
			required: true,
			validemail: true,
			email: true
		},
		nombreRegistro: {
			required: true,
			minlength: 2
		},
		apellidoRegistro: {
			required: true,
			minlength: 2
		},
		telefonoRegistro: "required",
		contrasenaRegistro: {
			required: true,
			minlength: 5
		}
			// ,
			// confirm_password: {
			// 	required: true,
			// 	minlength: 5,
			// 	equalTo: "#password"
			// }
		},
		messages: {
			correoRegistro: {
				required: "Por Favor, introduzca una dirección de correo",
				validemail: "Introduzca correctamente su correo",
				email: "Introduzca correctamente su correo"
			},
			nombreRegistro: {
				required: "Escribe tu nombre",
				minlength: "Tu Nombre es demasiado corto"
			},
			apellidoRegistro: {
				required: "Escribe tu apellido",
				minlength: "Tu Nombre es demasiado corto"
			},
			telefonoRegistro: "Escribe tu telefono",
			contrasenaRegistro: {
				required: "Escribe tu contraseña",
				minlength: "Tu contraseña debe tener más de 5 letras"
			}
			// ,
			// confirm_password: {
			// 	required: "Escribe tu contraseña",
			// 	minlength: "Tu contraseña debe tener más de 5 letras",
			// 	equalTo: "Tus contraseñas deben coincidir"
			// }
		},
		errorElement: "em",
		errorPlacement: function (error, element) {
			// Add the `help-block` class to the error element
			error.addClass("alert-danger");

			// Add `has-feedback` class to the parent div.form-group
			// in order to add icons to inputs
			element.parents(".input").addClass("has-feedback");

			// Add the span element, if doesn't exists, and apply the icon classes to it.
			if (!element.next("span")[0]) {
				$("<span class='form-control-feedback'></span>").insertAfter(element);
			}
		},
		success: function (label, element) {
			// Add the span element, if doesn't exists, and apply the icon classes to it.
			if (!$(element).next("span")[0]) {
				$("<span class='form-control-feedback'></span>").insertAfter($(element));
			}
		},
		highlight: function (element, errorClass, validClass) {
			$(element).addClass("is-invalid").removeClass("is-valid");
		},
		unhighlight: function (element, errorClass, validClass) {
			$(element).addClass("is-valid").removeClass("is-invalid");
		}
	});


// ///////////////////////


$("#cerrarSession").on('click', function(event) {
	event.preventDefault();

	valorestado = 'success';
	valormsg = 'Has salido correctamente del sistema';
	$.post("Controlador/usuario.php?op=salir", {}, function () {}).done(function () {
		$('body').html("");
		alertaSuccess(valorestado, valormsg);
		direccion = 'index.php';
		recargarPagina(direccion);
	});
});

// Registrando el articulo 
$("#botonRegistro").on('click', function (e) {
	e.preventDefault();
	if ($(".qq-thumbnail-selector").length>0) {
// Si se sube imagen
nuevosmas = 0;
do {
	if (nuevosmas==0) {
		$("#fine-uploader-validation").fineUploader('uploadStoredFiles');
		nuevosmas++;
		swalWithBootstrapButtons({
			title: 'Estas seguro de guardar los datos en el sistema',
			type: 'warning',
			showCancelButton: true,
			confirmButtonText: 'Si, deseo hacerlo',
			cancelButtonText: 'No',
			reverseButtons: true
		}).then((result) => {
			if (result.value) {
				email = $("#correoRegistro").val();
				nombres = $("#nombreRegistro").val();
				apellidos = $("#apellidoRegistro").val();
				telefono = $("#telefonoRegistro").val();
				password = $("#contrasenaRegistro").val();
				foto_usuario = $("#foto_usuario").val();

				$.post("Controlador/usuario.php?op=registrar", {
					"nombre": nombres,
					"apellido": apellidos,
					"email": email,
					"telefono": telefono,
					"password": password,
					"foto_usuario": foto_usuario
				}, function () {}).done(function (data) {
					datos = JSON.parse(data);
					valorestado = datos.estado.type;
					valormsg = datos.estado.msg;

					switch (valorestado) {
						case "error":
						$('#registroTienda').modal('hide');
						alertaError(valorestado, valormsg);
						break;
						case "success":
						$('#registroTienda').modal('hide');
						alertaSuccess(valorestado, valormsg);
						direccion = 'index.php';
						recargarPagina(direccion);
						break;
						
						default:
						break;
					}
					
				}).fail(function (data){
					console.log(data.responseText);
				});

		// setTimeout(() => {
		// 	$("#editarUsuario").modal('hide');
		// }, 800);
	} else if (result.dismiss === swal.DismissReason.cancel) {
		swalWithBootstrapButtons(
			'Editar usuario cancelado',
			'No se guardaron los cambios en el sistema ',
			'error',
			);
		$('#registroTienda').modal('hide');
	}
});

		break;

	}else{break;}
} while (nuevosmas < 2);
}else{

	// Si no se sube imagen
	nombres = $("#nombreRegistro").val();
	apellidos = $("#apellidoRegistro").val();
	email = $("#correoRegistro").val();
	telefono = $("#telefonoRegistro").val();
	password = $("#contrasenaRegistro").val();

	$.post("Controlador/usuario.php?op=registrar", {
		"nombre": nombres,
		"apellido": apellidos,
		"email": email,
		"telefono": telefono,
		"password": password
	}, function () {}).done(function (data) {
		datos = JSON.parse(data);
		valorestado = datos.estado.type;
		valormsg = datos.estado.msg;

		switch (valorestado) {
			case "error":
			$('#registroTienda').modal('hide');
			alertaError(valorestado, valormsg);
			break;
			case "success":
			$('#registroTienda').modal('hide');
			alertaSuccess(valorestado, valormsg);
			break;
			
			default:
			break;
		}
	}).fail(function (data){
		console.log(data.responseText);
	});
	
}
});
// Fin Registrando el usuario 


// Inicio de la entrada al sistema
$("#botonEntrar").on('click', function (e) {
	e.preventDefault();
	email = $("#correoEntrar").val();
	password = $("#contrasenaEntrar").val();


	$.post("Controlador/usuario.php?op=entrar", {
		"email": email,
		"password": password
	}, function () {}).done(function (data) {

		$('#registroTienda').modal('hide');
		datos = JSON.parse(data);
		valorestado = datos.estado.type;
		valormsg = datos.estado.msg;
		switch (valorestado) {
			case 'success':
			alertaSuccess(valorestado, valormsg);
			direccion = 'index.php';
			recargarPagina(direccion);

			break;
			case 'error':

			alertaError(valorestado, valormsg);
			break;
			default:
			break;
		}
	}).fail(function (dato) {
		valorestado = 'error';
		valormsg = 'Hubo un error al hacer la petición';
		alertaError(valorestado, valormsg);
	});
});
// Fin de la entrada al sistema







////////////////////////////////////////


// Inicio edicion del usuario 
$("#botonEditar").on('click', function (e) {
	e.preventDefault();
	if ($(".qq-thumbnail-selector").length>0) {
// Si se sube imagen
nuevosmas = 0;
do {
	if (nuevosmas==0) {
		$("#fine-uploader-validation").fineUploader('uploadStoredFiles');
		nuevosmas++;
		swalWithBootstrapButtons({
			title: 'Estas seguro de guardar los datos en el sistema',
			type: 'warning',
			showCancelButton: true,
			confirmButtonText: 'Si, deseo hacerlo',
			cancelButtonText: 'No',
			reverseButtons: true
		}).then((result) => {
			if (result.value) {
				email = $("#correoRegistro").val();
				nombres = $("#nombreRegistro").val();
				apellidos = $("#apellidoRegistro").val();
				telefono = $("#telefonoRegistro").val();
				password = $("#contrasenaRegistro").val();
				foto_usuario = $("#foto_usuario").val();

				$.post("Controlador/usuario.php?op=editar", {
					"nombre": nombres,
					"apellido": apellidos,
					"email": email,
					"telefono": telefono,
					"password": password,
					"foto_usuario": foto_usuario
				}, function () {}).done(function (data) {
	// console.log(data);
	datos = JSON.parse(data);
	valorestado = datos.estado.type;
	valormsg = datos.estado.msg;

	switch (valorestado) {
		case "error":
		$('#registroTienda').modal('hide');
		alertaError(valorestado, valormsg);
		break;
		case "success":
		$('#registroTienda').modal('hide');
		alertaSuccess(valorestado, valormsg);
		direccion = 'index.php';
		recargarPagina(direccion);
		break;
		
		default:
		break;
	}
	
}).fail(function (data){
	console.log(data.responseText);
});

		// setTimeout(() => {
		// 	$("#editarUsuario").modal('hide');
		// }, 800);
	} else if (result.dismiss === swal.DismissReason.cancel) {
		swalWithBootstrapButtons(
			'Editar usuario cancelado',
			'No se guardaron los cambios en el sistema ',
			'error',
			);
		$('#registroTienda').modal('hide');
	}
});

		break;

	}else{break;}
} while (nuevosmas < 2);
}else{

	// Si no se sube imagen
	nombres = $("#nombreRegistro").val();
	apellidos = $("#apellidoRegistro").val();
	email = $("#correoRegistro").val();
	telefono = $("#telefonoRegistro").val();
	password = $("#contrasenaRegistro").val();

	$.post("Controlador/usuario.php?op=editar", {
		"nombre": nombres,
		"apellido": apellidos,
		"email": email,
		"telefono": telefono,
		"password": password
	}, function () {}).done(function (data) {
	// console.log(data);
	datos = JSON.parse(data);
	valorestado = datos.estado.type;
	valormsg = datos.estado.msg;

	switch (valorestado) {
		case "error":
		$('#registroTienda').modal('hide');
		alertaError(valorestado, valormsg);
		break;
		case "success":
		$('#registroTienda').modal('hide');
		alertaSuccess(valorestado, valormsg);
		direccion = 'index.php';
		recargarPagina(direccion);
		break;
		
		default:
		break;
	}
}).fail(function (data){
	console.log(data.responseText);
});

}
});
// Fin edicion del usuario 


// Inicio de subida de articulo
$("#botonSubirArticulo").on('click', function (e) {
	e.preventDefault();
	if ($(".qq-thumbnail-selector").length>0) {
// Si se sube imagen
nuevosmas = 0;
do {
	if (nuevosmas==0) {
		$("#fine-uploader-validation2").fineUploader('uploadStoredFiles');
		nuevosmas++;
		swalWithBootstrapButtons({
			title: 'Estas seguro de guardar los datos en el sistema',
			type: 'warning',
			showCancelButton: true,
			confirmButtonText: 'Si, deseo hacerlo',
			cancelButtonText: 'No',
			reverseButtons: true
		}).then((result) => {
			if (result.value) {

				nombres = $("#nombreArticulo").val();
				descripcion = $("#descripcionArticulo").val();
				precio = $("#precioArticulo").val();
				cantidad = $("#cantidadArticulo").val();
				foto_articulo = $("#foto_articulo").val();

				$.post("Controlador/inventario.php?op=registrar", {
					"nombre": nombres,
					"descripcion": descripcion,
					"precio": precio,
					"cantidad": cantidad,
					"foto_articulo": foto_articulo
				}, function () {}).done(function (data) {
					datos = JSON.parse(data);
					valorestado = datos.estado.type;
					valormsg = datos.estado.msg;

					switch (valorestado) {
						case "error":
						$('#subirArticulo').modal('hide');
						alertaError(valorestado, valormsg);
						break;
						case "success":
						$('#subirArticulo').modal('hide');
						alertaSuccess(valorestado, valormsg);
						direccion = 'index.php?vista=inventario';
						recargarPagina(direccion);
						break;
						
						default:
						break;
					}
					
				}).fail(function (data){
					console.log(data.responseText);
				});

		// setTimeout(() => {
		// 	$("#editarUsuario").modal('hide');
		// }, 800);
	} else if (result.dismiss === swal.DismissReason.cancel) {
		swalWithBootstrapButtons(
			'Editar usuario cancelado',
			'No se guardaron los cambios en el sistema ',
			'error',
			);
		$('#subirArticulo').modal('hide');
	}
});

		break;

	}else{break;}
} while (nuevosmas < 2);
}else{

	// Si no se sube imagen
	nombres = $("#nombreArticulo").val();
	descripcion = $("#descripcionArticulo").val();
	precio = $("#precioArticulo").val();
	cantidad = $("#cantidadArticulo").val();
	foto_articulo = $("#foto_articulo").val();

	$.post("Controlador/inventario.php?op=registrar", {
		"nombre": nombres,
		"descripcion": descripcion,
		"precio": precio,
		"cantidad": cantidad,
		"foto_articulo": foto_articulo
	}, function () {}).done(function (data) {

		datos = JSON.parse(data);
		valorestado = datos.estado.type;
		valormsg = datos.estado.msg;

		switch (valorestado) {
			case "error":
			$('#subirArticulo').modal('hide');
			alertaError(valorestado, valormsg);
			break;
			case "success":
			$('#subirArticulo').modal('hide');
			alertaSuccess(valorestado, valormsg);
			break;
			
			default:
			break;
		}
	}).fail(function (data){
		console.log(data.responseText);
	});
	
}
});
// Fin de subida de articulo



	// Esto es para los tabs del datatable
	if ($('#tabs').length > 0) {
		$("#tabs").tabs({
			"show": function (event, ui) {
				var table = $.fn.dataTable.fnTables(true);
				if (table.length > 0) {
					$(table).dataTable().fnAdjustColumnSizing();
				}
			}
		});
	}

// funcion listar todos los articulos con estado 0 del usuario en la session
function listar0() {
	tabla0 = $("#listarEstado0").dataTable({
		"iDisplayLength": 5, //Paginacion
		language: {
			"url": "assets/js/Spanish.json"
		},
		"bDestroy": true,
		"bProcessing": true,
		"bServerSide": true,
		"bPaginate": true,
		"ajax": {
			url: 'Controlador/inventario.php?op=listar0',
			type: "post",
			dataType: "json",
			beforeSend: function () {
				$(".cuerpo").css('filter', 'blur(2px)');
			},
			error: function (e) {
				console.log(e.responseText);
			},
			complete: function () {
				$(".cuerpo").css('filter', 'blur(0px)');
			}
		},
		"order": [
		[0, "desc"]
		]
	}).dataTable();
}

// funcion listar todos los documentos con estado 1 del usuario en la session
function listar1() {
	tabla1 = $("#listarEstado1").dataTable({
		"iDisplayLength": 5, //Paginacion
		language: {
			"url": "assets/js/Spanish.json"
		},
		"bDestroy": true,
		"bProcessing": true,
		"bServerSide": true,
		"bPaginate": true,
		"ajax": {
			url: 'Controlador/inventario.php?op=listar1',
			type: "post",
			dataType: "json",
			beforeSend: function () {
				$(".cuerpo").css('filter', 'blur(2px)');
			},
			error: function (e) {
				console.log(e.responseText);
			},
			complete: function (e) {
				$(".cuerpo").css('filter', 'blur(0px)');
			}
		},
		"order": [
		[0, "desc"]
		]
	}).dataTable();
}

if ($(".demoCantidad").length>0) {            
	$("input[name='cantidad']").TouchSpin({
	});
}


function eliminarArticulo(id){
	swalWithBootstrapButtons({
		title: '¿Estas seguro de eliminar el articulo?',
		type: 'warning',
		showCancelButton: true,
		confirmButtonText: 'Si, deseo eliminarlo',
		cancelButtonText: 'No, cancelar eliminanación',
		reverseButtons: true
	}).then((result) => {
		if (result.value) {
			$.post("Controlador/inventario.php?op=eliminarArticulo", {
				"idArticulo": id
			}, function () {}).done(function (data) {
				datos = JSON.parse(data);
				valorestado = datos.estado.type;
				valormsg = datos.estado.msg;
				autoRefrescarsolo0();
				autoRefrescarsolo1();
				alertaSuccess(valorestado, valormsg);
			});
		} else if (result.dismiss === swal.DismissReason.cancel) {
			swalWithBootstrapButtons(
				'Eliminación cancelada',
				'El articulo no fue eliminado',
				'error'
				)
		}
	});
}

function editarArticulo(id){
	console.log(id);
}




// Mostrar solo estado 0 en el administrador
function listarSolo0() {
	tabla1 = $("#listarSoloEstado0").dataTable({
		"iDisplayLength": 5, //Paginacion
		language: {
			"url": "assets/js/Spanish.json"
		},
		"bDestroy": true,
		"bProcessing": true,
		"bServerSide": true,
		"bPaginate": true,
		"ajax": {
			url: 'Controlador/inventario.php?op=listarSoloEstado0',
			type: "post",
			dataType: "json",
			beforeSend: function () {
				$(".cuerpo").css('filter', 'blur(2px)');
			},
			error: function (e) {
				console.log(e.responseText);
			},
			complete: function (e) {
				$(".cuerpo").css('filter', 'blur(0px)');
			}
		},
		"order": [
		[0, "desc"]
		]
	}).dataTable();
}


// Mostrar solo estado 1 en el administrador

function listarSolo1() {
	tabla1 = $("#listarSoloEstado1").dataTable({
		"iDisplayLength": 5, //Paginacion
		language: {
			"url": "assets/js/Spanish.json"
		},
		"bDestroy": true,
		"bProcessing": true,
		"bServerSide": true,
		"bPaginate": true,
		"ajax": {
			url: 'Controlador/inventario.php?op=listarSoloEstado1',
			type: "post",
			dataType: "json",
			beforeSend: function () {
				$(".cuerpo").css('filter', 'blur(2px)');
			},
			error: function (e) {
				console.log(e.responseText);
			},
			complete: function (e) {
				$(".cuerpo").css('filter', 'blur(0px)');
			}
		},
		"order": [
		[0, "desc"]
		]
	}).dataTable();
}

// Mostrar todos los datos de la tienda al usuario normal

function tiendaUsuario() {

	var tablaindex = $("#tiendaUsuario").dataTable({
		"iDisplayLength": 5, //Paginacion
		language: {
			"url": "assets/js/Spanish.json"
		},
		"bFilter": true, // show search input 
		"bDestroy": true,
		"bProcessing": true,
		"bServerSide": true,
		"bPaginate": true,
		"ajax": {
			url: 'Controlador/inventario.php?op=tiendaUsuario',
			type: "post",
			dataType: "json",
			beforeSend: function () {
				$(".cuerpo").css('filter', 'blur(2px)');
			},
			error: function (e) {
				console.log(e.responseText);
			},
			complete: function (e) {
				$(".cuerpo").css('filter', 'blur(0px)');
				$("#tiendaUsuario_filter").css("display","none");
			}
		},
		"order": [
		[0, "desc"]
		]
	}).dataTable();

	/* Si se pulsa el botón de reset. */
	$('#boton_resetear').on('click', function(){
		$('#valor_a_comparar').prop('value', '');
		$('#boton_buscar').prop('disabled', true);
		$('#boton_resetear').prop('disabled', true);
		tablaindex.api().search('').draw();
	});

	/* Si se pulsa el botón de buscar. */
	$('#boton_buscar').on('click', function(){
		tablaindex.fnDestroy();
		tiendaUsuario();
		tablaindex.api().search($("#valor_a_comparar").prop("value")).draw();
	});

	/* Si se empieza a escribir. */
	$('#valor_a_comparar').on('keyup keypress change', function(){
		$('#boton_buscar').prop('disabled', ($('#valor_a_comparar').prop('value') == ""));
		$('#boton_resetear').prop('disabled', ($('#valor_a_comparar').prop('value') == ""));
	});


}



function tiendaUsuario2() {

	var tablaindexdos = $("#tiendaUsuario2").dataTable({
		"iDisplayLength": 5, //Paginacion
		language: {
			"url": "assets/js/Spanish.json"
		},
		"bFilter": true, // show search input 
		"bDestroy": true,
		"bProcessing": true,
		"bServerSide": true,
		"bPaginate": true,
		"ajax": {
			url: 'Controlador/inventario.php?op=tiendaUsuariodos',
			type: "post",
			dataType: "json",
			beforeSend: function () {
				$(".cuerpo").css('filter', 'blur(2px)');
			},
			error: function (e) {
				console.log(e.responseText);
			},
			complete: function (e) {
				$(".cuerpo").css('filter', 'blur(0px)');
				$("#tiendaUsuario2_filter").css("display","none");
			}
		},
		"order": [
		[0, "desc"]
		]
	}).dataTable();

	/* Si se pulsa el botón de reset. */
	$('#resetear').on('click', function(){
		$('#comparar').prop('value', '');
		$('#buscar').prop('disabled', true);
		$('#resetear').prop('disabled', true);
		tablaindexdos.api().search('').draw();
	});

	/* Si se pulsa el botón de buscar. */
	$('#buscar').on('click', function(){
		tablaindexdos.fnDestroy();
		tiendaUsuario2();
		tablaindexdos.api().search($("#comparar").prop("value")).draw();
	});

	/* Si se empieza a escribir. */
	$('#comparar').on('keyup keypress change', function(){
		$('#buscar').prop('disabled', ($('#comparar').prop('value') == ""));
		$('#resetear').prop('disabled', ($('#comparar').prop('value') == ""));
	});


}


listar0();
listar1();
listarSolo0();
listarSolo1();
if ($("#tiendaUsuario")) {
	tiendaUsuario();
}
if ($("#tiendaUsuario2")) {
	tiendaUsuario2();
}

// Autrorefrescar datables del usuario normal
function autoRefrescarsolo0() {
	$("#listarEstado0").DataTable().ajax.reload(null, false); // user paging is not reset on reload
}
// Autrorefrescar datables del usuario normal
function autoRefrescarsolo1() {
	$("#listarEstado1").DataTable().ajax.reload(null, false); // user paging is not reset on reload
}

// Autrorefrescar datables del usuario normal
function autoRefrescar0() {
	$("#listarSoloEstado0").DataTable().ajax.reload(null, false); // user paging is not reset on reload
}
// Autrorefrescar datables del usuario normal
function autoRefrescar1() {
	$("#listarSoloEstado1").DataTable().ajax.reload(null, false);
}


function aprobarArticulo(id){
	swalWithBootstrapButtons({
		title: '¿Estas seguro de aprobar el articulo?',
		type: 'warning',
		showCancelButton: true,
		confirmButtonText: 'Si, deseo aprobarlo',
		cancelButtonText: 'No, cancelar aprobación',
		reverseButtons: true
	}).then((result) => {
		if (result.value) {

			$.post("Controlador/inventario.php?op=aprobar", {
				"idArticulo": id
			}, function () {}).done(function (data) {
				autoRefrescar0();
				datos = JSON.parse(data);
				valorestado = datos.estado.type;
				valormsg = datos.estado.msg;
				alertaSuccess(valorestado, valormsg);
			});

		} else if (result.dismiss === swal.DismissReason.cancel) {
			swalWithBootstrapButtons(
				'Aprobación cancelada',
				'El documento no fue aprobado',
				'error'
				)
		}
	});
}
function desaprobarArticulo(id){
	swalWithBootstrapButtons({
		title: '¿Estas seguro de desaprobar el articulo?',
		type: 'warning',
		showCancelButton: true,
		confirmButtonText: 'Si, deseo desaprobarlo',
		cancelButtonText: 'No, cancelar desaprobación',
		reverseButtons: true
	}).then((result) => {
		if (result.value) {

			$.post("Controlador/inventario.php?op=desaprobar", {
				"idArticulo": id
			}, function () {}).done(function (data) {
				autoRefrescar1();

				datos = JSON.parse(data);
				valorestado = datos.estado.type;
				valormsg = datos.estado.msg;
				alertaSuccess(valorestado, valormsg);

			});

		} else if (result.dismiss === swal.DismissReason.cancel) {
			swalWithBootstrapButtons(
				'Desaprobación cancelada',
				'El documento no fue desaprobado',
				'error',
				);
		}
	});
}

// Mostrar articulo en la ventana modal

function comprarArticulo(id){
	$.post('Controlador/inventario.php?op=mostrarArticuloModal', {'idArticulo': id}, function() {}).done(function(data){
		datos = JSON.parse(data);
		valormsg = datos.estado.msg;
	$("#modalComprarArticulo").html(valormsg); //aqui va a ir todo el contenido
}).fail(function(data){
	console.log(data.responseText);
});
}

function finalizarCompra(id){
	cantidad = $(".demoCantidad").val();
	$.post('Controlador/compra.php?op=comprarArticulo', {'idArticulo':id,'cantidad':cantidad}, function() {}).done(function(data){
		datos = JSON.parse(data);
		valorestado = datos.estado.type;
		valormsg = datos.estado.msg;

		switch(valorestado){
			case 'error':
			$("#modalCompra").modal('hide');
			alertaError(valorestado, valormsg);
			break;

			case 'success':
			alertaSuccess(valorestado, valormsg);
			direccion = 'index.php?vista=compra';
			recargarPagina(direccion);
			break;
			default:
			break;
		}
	}).fail(function(data){
		console.log(data.responseText);
	});

}


// Ver todo los articulos principales
function verArticulosRecientes(){
	$.post('Controlador/inventario.php?op=verArticulosRecientes', {}, function() {}).done(function(data){
	// datos = JSON.parse(data);
	// valormsg = datos[0];
	$("#verArticulosRecientes").html(data);
}).fail(function(data){
	console.log(data.responseText);
});
}
verArticulosRecientes();

function verArticulo(id){
	console.log(id);
	$.post('Controlador/inventario.php?op=verArticuloModal', {'idArticulo': id}, function() {}).done(function(data){
		datos = JSON.parse(data);
		valormsg = datos.estado.msg;
	$("#modalVerArticuloCompleto").html(valormsg); //aqui va a ir todo el contenido
}).fail(function(data){
	console.log(data.responseText);
});
}


function verEstadisticas(){
	$.post('Controlador/inventario.php?op=verEstadisticas', {}, function() {}).done(function(data){
		datos = JSON.parse(data);
		valorarticulo = datos.estado.totalArticulo;
		valorarticulo0 = datos.estado.totalArticulo0;
		valorusuario = datos.estado.totalUsuario;
		$("#cantidadArticulosAprobados").html(valorarticulo);
		$("#cantidadArticulosDesprobados").html(valorarticulo0);
		$("#cantidadUsuario").html(valorusuario);

	}).fail(function(data){
		console.log(data.responseText);
	});
}

verEstadisticas();
mostrarCompras();
mostrarVentas();
// Mostrar solo estado 1 en el administrador

function mostrarCompras() {
	tabla1 = $("#compras").dataTable({
		"iDisplayLength": 5, //Paginacion
		language: {
			"url": "assets/js/Spanish.json"
		},
		"bDestroy": true,
		"bProcessing": true,
		"bServerSide": true,
		"bPaginate": true,
		"ajax": {
			url: 'Controlador/compra.php?op=compras',
			type: "post",
			dataType: "json",
			beforeSend: function () {
				$(".cuerpo").css('filter', 'blur(2px)');
			},
			error: function (e) {
				console.log(e.responseText);
			},
			complete: function (e) {
				$(".cuerpo").css('filter', 'blur(0px)');
				$("#compras_filter").css("display","none");
			}
		},
		"order": [
		[0, "desc"]
		]
	}).dataTable();
}

function verInformacion(id){
	$.post('Controlador/usuario.php?op=mostrarUsuarioModal', {'idUsuario': id}, function() {}).done(function(data){
		datos = JSON.parse(data);
		valormsg = datos.estado.msg;
	$("#modalUsuarioInformacion").html(valormsg); //aqui va a ir todo el contenido
}).fail(function(data){
	console.log(data.responseText);
});
}

function mostrarVentas() {
	tabla1 = $("#ventas").dataTable({
		"iDisplayLength": 5, //Paginacion
		language: {
			"url": "assets/js/Spanish.json"
		},
		"bDestroy": true,
		"bProcessing": true,
		"bServerSide": true,
		"bPaginate": true,
		"ajax": {
			url: 'Controlador/venta.php?op=ventas',
			type: "post",
			dataType: "json",
			beforeSend: function () {
				$(".cuerpo").css('filter', 'blur(2px)');
			},
			error: function (e) {
				console.log(e.responseText);
			},
			complete: function (e) {
				$(".cuerpo").css('filter', 'blur(0px)');
				$("#ventas_filter").css("display","none");
			}
		},
		"order": [
		[0, "desc"]
		]
	}).dataTable();
}