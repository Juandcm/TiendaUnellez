<?php 
require_once "Funciones.php";
class Usuario extends Funciones
{
// Inicio del registro del usuario
    public function RegistrarUsuario($creado,$nombre,$apellido,$email,$password,$telefono,$foto_usuario){
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
        {
            $sessData['estado']['type'] = 'error';
            $sessData['estado']['msg'] = 'El correo no es valido'; 
        }else{
// Aqui verifico de que el correo no este dentro del sistema
            $sql = "SELECT usu_corr FROM usuario WHERE usu_corr='$email' LIMIT 1";
            $datos = '';
            $prevUser = self::ejecutarConsultaSimpleFila($sql,$datos);
            if($prevUser){
                $sessData['estado']['type'] = 'error';
                $sessData['estado']['msg'] = 'Email existe, Por favor ingrese otro email.';
            }else{
// En este caso, queremos aumentar el coste predeterminado de BCRYPT a 12.
// Observe que también cambiamos a BCRYPT, que tendrá siempre 60 caracteres.
                $opciones = ['cost' => 12];
                $contrasenaFinal = password_hash($password, PASSWORD_BCRYPT,$opciones);
    // Aqui registro al usuario en el sistema
                $sql = "INSERT INTO usuario (usu_iden, usu_nomb, usu_apel, usu_corr, usu_cont, usu_tele, usu_foto, usu_fech, usu_perm, usu_esta) VALUES (:usu_iden, :usu_nomb, :usu_apel, :usu_corr, :usu_cont, :usu_tele, :usu_foto, :usu_fech, :usu_perm, :usu_esta)";
                $datos = array( 'usu_iden' => '', 'usu_nomb' => $nombre, 'usu_apel' => $apellido,'usu_corr'=>$email,'usu_cont'=>$contrasenaFinal,'usu_tele'=>$telefono,'usu_foto'=>$foto_usuario,'usu_fech'=>$creado,'usu_perm'=>'0','usu_esta'=>'1');

                $consulta = self::ejecutarConsulta($sql,$datos);
                if($consulta){
                    $sessData['estado']['type'] = 'success';
                    $sessData['estado']['msg'] = 'Te registraste exitosamente, inicia sesión con tus credenciales.';
                }else{
                    $sessData['estado']['type'] = 'error';
                    $sessData['estado']['msg'] = 'Ha ocurrido algún problema, por favor intente de nuevo.';
                }
            }
        }
        echo json_encode($sessData);
    }
// Fin del registro del usuario

// Inicio de la entrada a la tienda
    public function EntrarUsuario($email,$password){
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
        {
            $sessData['estado']['type'] = 'error';
            $sessData['estado']['msg'] = 'El correo no es valido'; 
        }else{
    // Aqui verifico si el usuario esta activo en el sistema
            $sql = "SELECT usu_iden, usu_nomb, usu_apel, usu_corr,usu_cont, usu_tele, usu_foto, usu_fech, usu_perm, usu_esta FROM usuario WHERE usu_corr='$email' AND usu_esta='1' LIMIT 1";
            $datos1='';
            $prevUser = self::ejecutarConsultaSimpleFila($sql,$datos1);

    // Aqui verifico si el usuario esta inactivo en el sistema
            $sql2 = "SELECT usu_corr FROM usuario WHERE usu_corr='$email' AND usu_esta='0' LIMIT 1";
            $datos2='';
            $prevUser2 = self::ejecutarConsultaSimpleFila($sql2,$datos2);

    //Aqui verifico solo el correo
            $sql3 = "SELECT usu_corr FROM usuario WHERE usu_corr='$email' LIMIT 1";
            $datos='';
            $prevUser3 = self::ejecutarConsultaSimpleFila($sql3,$datos);

            if($prevUser){
                if (password_verify($password, $prevUser->usu_cont)) {
                    $sessData['estado']['type'] = 'success';
                    $sessData['estado']['msg'] = 'Bienvenido '.$prevUser->usu_nomb;
    // // Aqui asigno la id del usuario a la session
                    $sessionUsuario['usuario']['id'] = $prevUser->usu_iden;
                    $sessionUsuario['usuario']['nombre'] = $prevUser->usu_nomb;
                    $sessionUsuario['usuario']['apellido'] = $prevUser->usu_apel;
                    $sessionUsuario['usuario']['email'] = $prevUser->usu_corr; 
                    $sessionUsuario['usuario']['telefono'] = $prevUser->usu_tele;
                    $sessionUsuario['usuario']['foto_usuario']=$prevUser->usu_foto;
                    $sessionUsuario['usuario']['permiso']=$prevUser->usu_perm;
                    $sessionUsuario['usuario']['creado']=$prevUser->usu_fech;
                    $_SESSION['DatosUsuario'] = $sessionUsuario;

                }else{
                    $sessData['estado']['type'] = 'error';
                    $sessData['estado']['msg'] = 'El email es correcto pero la contraseña no lo es, intenta de nuevo con otra contraseña';
                }
            }elseif($prevUser2>0) {
                $sessData['estado']['type'] = 'error';
                $sessData['estado']['msg'] = 'No puedes entrar ya que estas desactivado, revisa tu correo para poder entrar a la página web';
            }else{
                if ($prevUser3>0) {}else{
                    $sessData['estado']['type'] = 'error';
                    $sessData['estado']['msg'] = 'El Email que ingreso no se encuentra en el sistema, por favor ingrese el correo correctamente'; 
                }
            }
        }
        echo json_encode($sessData);    
    }
// Fin de la entrada a la tienda


    public function EditarUsuario($idUsuario,$nombre,$apellido,$email,$telefono,$password,$foto_usuario){
// En este caso, queremos aumentar el coste predeterminado de BCRYPT a 12.
// Observe que también cambiamos a BCRYPT, que tendrá siempre 60 caracteres.
        $opciones = ['cost' => 12];
        $contrasenaFinal = password_hash($password, PASSWORD_BCRYPT,$opciones);
        $datos='';

    // Aqui verifico de que el correo no este dentro del sistema
        $sqlCorreo = "SELECT usu_iden FROM usuario WHERE usu_corr='$email'";
        $revisarCorreo = $this->ejecutarConsultaSimpleFila($sqlCorreo,$datos);

        if($revisarCorreo > 0){
            $idRevisar = $revisarCorreo->usu_iden;
            if ($idUsuario == $idRevisar) {

// Actualizando el usuario

                if ($foto_usuario=='user-default.jpg') {
                    $sql2 = "UPDATE usuario SET usu_nomb='$nombre', usu_apel='$apellido', usu_corr='$email',usu_cont='$contrasenaFinal', usu_tele='$telefono' WHERE usu_iden = '$idUsuario'";
                }else{
                    $sql2 = "UPDATE usuario SET usu_nomb='$nombre', usu_apel='$apellido', usu_corr='$email',usu_cont='$contrasenaFinal', usu_tele='$telefono', usu_foto='$foto_usuario' WHERE usu_iden = '$idUsuario'";
                }    

                $insert = $this->ejecutarConsulta($sql2,$datos);
                if($insert){
                    $sql = "SELECT * FROM usuario WHERE usu_iden='$idUsuario'";
                    $prevUser = $this->ejecutarConsultaSimpleFila($sql,$datos);
                    if($prevUser > 0){
    // Aqui asigno la id del usuario a la session
                        $sessionUsuario['usuario']['id'] = $prevUser->usu_iden;
                        $sessionUsuario['usuario']['nombre'] = $prevUser->usu_nomb;
                        $sessionUsuario['usuario']['apellido'] = $prevUser->usu_apel;
                        $sessionUsuario['usuario']['email'] = $prevUser->usu_corr; 
                        $sessionUsuario['usuario']['telefono'] = $prevUser->usu_tele;
                        $sessionUsuario['usuario']['foto_usuario']=$prevUser->usu_foto;
                        $sessionUsuario['usuario']['permiso']=$prevUser->usu_perm;
                        $sessionUsuario['usuario']['creado']=$prevUser->usu_fech;
                        $_SESSION['DatosUsuario'] = $sessionUsuario;
                    }

                    $sessData['estado']['type'] = 'success';
                    $sessData['estado']['msg'] = 'Se actualizo el usuario.';


                }else{
                    $sessData['estado']['type'] = 'error';
                    $sessData['estado']['msg'] = 'Ha ocurrido algún problema, por favor intente de nuevo.';
                }


            }else{
                $sessData['estado']['type'] = 'error';
                $sessData['estado']['msg'] = 'Este email ya esta en uso en el sistema por favor ingresa otro email.';
            }
        }else{


// Actualizando el usuario
            if ($foto_usuario=='user-default.jpg') {
                $sql2 = "UPDATE usuario SET usu_nomb='$nombre', usu_apel='$apellido', usu_corr='$email',usu_cont='$contrasenaFinal', usu_tele='$telefono' WHERE usu_iden = '$idUsuario'";
            }else{
                $sql2 = "UPDATE usuario SET usu_nomb='$nombre', usu_apel='$apellido', usu_corr='$email',usu_cont='$contrasenaFinal', usu_tele='$telefono', usu_foto='$foto_usuario' WHERE usu_iden = '$idUsuario'";
            }

            $insert = $this->ejecutarConsulta($sql2,$datos);
            if($insert){
                $sql = "SELECT * FROM usuario WHERE usu_iden='$idUsuario'";
                $prevUser = $this->ejecutarConsultaSimpleFila($sql,$datos);
                if($prevUser > 0){
    // Aqui asigno la id del usuario a la session
                    $sessionUsuario['usuario']['id'] = $prevUser->usu_iden;
                    $sessionUsuario['usuario']['nombre'] = $prevUser->usu_nomb;
                    $sessionUsuario['usuario']['apellido'] = $prevUser->usu_apel;
                    $sessionUsuario['usuario']['email'] = $prevUser->usu_corr; 
                    $sessionUsuario['usuario']['telefono'] = $prevUser->usu_tele;
                    $sessionUsuario['usuario']['foto_usuario']=$prevUser->usu_foto;
                    $sessionUsuario['usuario']['permiso']=$prevUser->usu_perm;
                    $sessionUsuario['usuario']['creado']=$prevUser->usu_fech;
                    $_SESSION['DatosUsuario'] = $sessionUsuario;
                }

                $sessData['estado']['type'] = 'success';
                $sessData['estado']['msg'] = 'Se actualizo el usuario.';


            }else{
                $sessData['estado']['type'] = 'error';
                $sessData['estado']['msg'] = 'Ha ocurrido algún problema, por favor intente de nuevo.';
            }

        }

        echo json_encode($sessData);
    }

    public function mostrarUsuarioModal($idUsuario2){
        $datos='';
        $sql1 = "SELECT u.usu_nomb, u.usu_apel, u.usu_corr, u.usu_tele, u.usu_foto FROM usuario u WHERE u.usu_iden ='$idUsuario2'";
        $query=$this->ejecutarConsultaSimpleFila($sql1,$datos);
// Revisar desde aqui
        if ($query) {
            $foto = empty($query->usu_foto)?'user-default.jpg':$query->usu_foto;      
            $sessData['estado']['msg'] = '<div class="modal-header">
            <h4 class="modal-title" id="exampleModalLabel"><p id="parrafo"><div class="pv-title">'.$query->usu_nomb.' '.$query->usu_apel.'</div></p></h4>
            </div>
            <div class="modal-body">
            <div class="row">
            <div class="col-12">
            <div class="box-block"><div class="row">
            <div class="col-md-4 col-sm-5">
            <div class="pv-images m-b-1 m-sm-b-0"><div class="m-b-1">
            <img class="img-fluid" src="SubidArchivos/archivos/fotosUsuario/'.$foto.'" alt="">
            </div></div>
            </div>

            <div class="col-md-8 col-sm-7"> <div class="pv-content">
            <p></p></div>
            <div class="pv-form">

            <div class="container-fluid">
            <div class="row">
            <div class="col-md-12">
            <h6><div class="pv-price">Correo: <span>'.$query->usu_corr.'</span></div></h6>
            <h6><div class="pv-price">Telefono: <span>'.$query->usu_tele.'</span></div></h6>
            </div>

            </div></div>

            </div></div></div></div>
            </div>
            </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal" id="cerrarModal">Cerrar</button>
            </div>
            ';
        }else{
            $sessData['estado']['msg'] = 'Ha ocurrido algún problema, por favor intente de nuevo más tarde.';
        }
        echo json_encode($sessData);
    }

}

?>

