
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

// Inicio Registrando el usuario 
$("#botonRegistro").on('click', function (e) {
	e.preventDefault();
	nombres = $("#nombreRegistro").val();
	apellidos = $("#apellidoRegistro").val();
	email = $("#correoRegistro").val();
	telefono = $("#telefonoRegistro").val();
	password = $("#contrasenaRegistro").val();
	console.log(nombres);
$.post("Controlador/usuario.php?op=registrar", {
	"nombre": nombres,
	"apellido": apellidos,
	"email": email,
	"telefono": telefono,
	"password": password
}, function () {}).done(function (data) {
	// datos = JSON.parse(data);
	// valorestado = datos.estado.type;
	// valormsg = datos.estado.msg;
}).fail(function (data){
	console.log(data.responseText);
});
});
// Fin Registrando el usuario 

// Inicio entrada del usuario 
$("#botonEntrar").on('click', function (e) {
	e.preventDefault();
	email = $("#correoEntrar").val();
	password =  $("#contrasenaEntrar").val();
$.post("Controlador/usuario.php?op=entrar", {
	"email": email,
	"password": password
}, function () {}).done(function (data) {
	direccion = 'index.php';
	recargarPagina(direccion);

}).fail(function (data){
	console.log(data.responseText);
});
});
// Fin entrada del usuario 