<?php session_start();
error_reporting(0);
require_once "../Modelo/Inventario.php";
$Limpiarvar = new Funciones();
$usu_normal = new Inventario();

$nombre = isset($_POST['nombre'])?$Limpiarvar->limpiar($_POST['nombre'],'0'):'';
$descripcion = isset($_POST['descripcion'])?$Limpiarvar->limpiar($_POST['descripcion'],'0'):'';
$precio = isset($_POST['precio'])?$Limpiarvar->limpiar($_POST['precio'],'1'):'';
$cantidad = isset($_POST['cantidad'])?$Limpiarvar->limpiar($_POST['cantidad'],'1'):'';
$foto_articulo = isset($_POST['foto_articulo'])?$Limpiarvar->limpiar($_POST['foto_articulo'],'1'):'user-default.jpg';

$idArticulo = isset($_POST['idArticulo'])?$Limpiarvar->limpiar($_POST['idArticulo'],'1'):'';

// Sesion del usuario
$DataUsuario = isset($_SESSION['DatosUsuario'])?$_SESSION['DatosUsuario']:'';
$idUsuario = !empty($DataUsuario['usuario']['id'])?$DataUsuario['usuario']['id']:'';
$creado = date("Y-m-d H:i:s");

$op = isset($_GET['op'])?$Limpiarvar->limpiar($_GET['op'],'0'):'No';

switch ($op) {
	case 'registrar':
    $usu_normal->registrarArticulo($idUsuario,$nombre,$descripcion,$precio,$creado,$foto_articulo,$cantidad);
    break;
    

    case 'listar0':
    $usu_normal->listar0($idUsuario);
    break;


    case 'listar1':
    $usu_normal->listar1($idUsuario);
    break;

    case 'listarSoloEstado0':
    $usu_normal->listarSoloEstado0();
    break;

    case 'listarSoloEstado1':
    $usu_normal->listarSoloEstado1();
    break;

    case 'aprobar':
    $usu_normal->aprobar($idArticulo);
    break;

    case 'desaprobar':
    $usu_normal->desaprobar($idArticulo);
    break;
    
    case 'tiendaUsuario':
    $usu_normal->tiendaUsuario();
    break;

    case 'tiendaUsuariodos':
    $usu_normal->tiendaUsuario2();
    break;
    
    case 'mostrarArticuloModal':
    $usu_normal->mostrarArticuloModal($idArticulo);
    break;

    case 'verArticulosRecientes':
    $usu_normal->verArticulosRecientes();        
    break;

    case 'verArticuloModal':
    $usu_normal->verArticuloModal($idArticulo);    
    break;

    case 'verEstadisticas':
    $usu_normal->verEstadisticas();
    break;

    case 'eliminarArticulo':
    $usu_normal->eliminarArticulo($idArticulo);
    break;
    
    default:
    break;
}


?>