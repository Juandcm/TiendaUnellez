<?php session_start();
error_reporting(0);
require_once "../Modelo/Usuario.php";
$Limpiarvar = new Funciones();
$usu_normal = new Usuario();

$creado = date("Y-m-d H:i:s");

$nombre = isset($_POST['nombre'])?$Limpiarvar->limpiar($_POST['nombre'],'0'):'';
$apellido = isset($_POST['apellido'])?$Limpiarvar->limpiar($_POST['apellido'],'0'):'';
$email = isset($_POST['email'])?$Limpiarvar->limpiar($_POST['email'],'1'):'';
$telefono = isset($_POST['telefono'])?$Limpiarvar->limpiar($_POST['telefono'],'1'):'';
$password = isset($_POST['password'])?$Limpiarvar->limpiar($_POST['password'],'1'):'';
$foto_usuario = isset($_POST['foto_usuario'])?$Limpiarvar->limpiar($_POST['foto_usuario'],'0'):'user-default.jpg';



// Sesion del usuario
$DataUsuario = isset($_SESSION['DatosUsuario'])?$_SESSION['DatosUsuario']:'';
$idUsuario = !empty($DataUsuario['usuario']['id'])?$DataUsuario['usuario']['id']:'';

$idUsuario2 = isset($_POST['idUsuario'])?$Limpiarvar->limpiar($_POST['idUsuario'],'1'):'';


$op = isset($_GET['op'])?$Limpiarvar->limpiar($_GET['op'],'0'):'No';

switch ($op) {
	case 'registrar':
	$usu_normal->RegistrarUsuario($creado,$nombre,$apellido,$email,$password,$telefono,$foto_usuario);
	break;

	case 'entrar':
	$usu_normal->EntrarUsuario($email,$password);
	break;

	case 'editar':
	$usu_normal->EditarUsuario($idUsuario,$nombre,$apellido,$email,$telefono,$password,$foto_usuario);	
	break;
	
	case 'salir':
	if(!empty($_REQUEST['op'])){
		unset($_SESSION['DatosUsuario']);
		session_destroy();
	}
	break;

	case 'mostrarUsuarioModal':
	$usu_normal->mostrarUsuarioModal($idUsuario2);
	break;

	default:
	break;
}










/**
 * 
 */
class ClassName extends AnotherClass
{
public function EditarUsuario($idUsuario, $user_editar, $user_email_editar, $user_telefono_editar, $user_password_editar, $foto_usuario, $foto_usuario_sesion, $permiso, $fechaOriginal, $creado)
    {
        // $idUsuario, $user_editar, $user_email_editar, $user_telefono_editar, $user_password_editar, $foto_usuario, $foto_usuario_sesion

        // En este caso, queremos aumentar el coste predeterminado de BCRYPT a 12.
        // Observe que también cambiamos a BCRYPT, que tendrá siempre 60 caracteres.
        $opciones = ['cost' => 12];
        $contrasenaFinal = password_hash($user_password_editar, PASSWORD_BCRYPT, $opciones);
        $datos = '';

        // Aqui verifico de que el correo no este dentro del sistema
        $sqlCorreo = "SELECT usu_id FROM usuario WHERE usu_correo='$user_email_editar'";
        $revisarCorreo = $this->ejecutarConsultaSimpleFila($sqlCorreo, $datos);

        if ($revisarCorreo > 0) {
            $idRevisar = $revisarCorreo->usu_id;
            if ($idUsuario == $idRevisar) {

                // Actualizando el usuario

                if ($foto_usuario == '') {
                    $sql2 = "UPDATE usuario SET usu_nombre='$user_editar', usu_correo='$user_email_editar', usu_teleno='$telefono', usu_password='$contrasenaFinal', usu_actualizado='$creado' WHERE usu_id = '$idUsuario'";
                } else {
                    $sql2 = "UPDATE usuario SET usu_nombre='$user_editar', usu_correo='$user_email_editar', usu_teleno='$user_telefono_editar', usu_password='$contrasenaFinal',  usu_imagen='$foto_usuario', usu_actualizado='$creado' WHERE usu_id = '$idUsuario'";
                }

                $insert = $this->ejecutarConsulta($sql2, $datos);
                if ($insert) {
                        // Aqui asigno la id del usuario a la session
                        $sessionUsuario['usuario']['id'] = $idUsuario;
                        $sessionUsuario['usuario']['nombre'] = $user_editar;
                        $sessionUsuario['usuario']['email'] = $user_email_editar;
                        $sessionUsuario['usuario']['telefono'] = $user_telefono_editar;
                        $sessionUsuario['usuario']['foto_usuario'] = $foto_usuario;
                        // Revisar aqui
                        $sessionUsuario['usuario']['permiso'] = $permiso;
                        $sessionUsuario['usuario']['creado'] = $fechaOriginal;
                        $_SESSION['DatosUsuario'] = $sessionUsuario;
// $idUsuario, $user_editar, $user_email_editar, $user_telefono_editar, $user_password_editar, $foto_usuario,

                    $sessData['estado']['type'] = 'success';
                    $sessData['estado']['msg'] = 'Se actualizo el usuario.';
                } else {
                    $sessData['estado']['type'] = 'error';
                    $sessData['estado']['msg'] = 'Ha ocurrido algún problema, por favor intente de nuevo.';
                }
            } else {
                $sessData['estado']['type'] = 'error';
                $sessData['estado']['msg'] = 'Este email ya esta en uso en el sistema por favor ingresa otro email.';
            }
        } else {


            // Actualizando el usuario
                if ($foto_usuario == '') {
                    $sql2 = "UPDATE usuario SET usu_nombre='$user_editar', usu_correo='$user_email_editar', usu_teleno='$telefono', usu_password='$contrasenaFinal', usu_actualizado='$creado' WHERE usu_id = '$idUsuario'";
                } else {
                    $sql2 = "UPDATE usuario SET usu_nombre='$user_editar', usu_correo='$user_email_editar', usu_teleno='$user_telefono_editar', usu_password='$contrasenaFinal',  usu_imagen='$foto_usuario', usu_actualizado='$creado' WHERE usu_id = '$idUsuario'";
                }


            $insert = $this->ejecutarConsulta($sql2, $datos);
            if ($insert) {
                    // Aqui asigno la id del usuario a la session
                        $sessionUsuario['usuario']['id'] = $idUsuario;
                        $sessionUsuario['usuario']['nombre'] = $user_editar;
                        $sessionUsuario['usuario']['email'] = $user_email_editar;
                        $sessionUsuario['usuario']['telefono'] = $user_telefono_editar;
                        $sessionUsuario['usuario']['foto_usuario'] = $foto_usuario;
                        // Revisar aqui
                        $sessionUsuario['usuario']['permiso'] = $permiso;
                        $sessionUsuario['usuario']['creado'] = $fechaOriginal;
                        $_SESSION['DatosUsuario'] = $sessionUsuario;
                    $_SESSION['DatosUsuario'] = $sessionUsuario;
                

                $sessData['estado']['type'] = 'success';
                $sessData['estado']['msg'] = 'Se actualizo el usuario.';
            } else {
                $sessData['estado']['type'] = 'error';
                $sessData['estado']['msg'] = 'Ha ocurrido algún problema, por favor intente de nuevo.';
            }
        }

        echo json_encode($sessData);
    }

}

 


?>



