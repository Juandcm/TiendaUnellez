<?php 
require_once "Funciones.php";
class Compra extends Funciones
{

    public function comprarArticulo($idArticulo,$cantidad,$idUsuario,$creado){

        $datos='';

        $sqlPrecio = "SELECT i.inv_iden, u.usu_iden FROM inventario i INNER JOIN usuario u ON u.usu_iden = i.usu_iden WHERE i.inv_iden = '$idArticulo' AND u.usu_iden = '$idUsuario' LIMIT 1";
        $query = $this->ejecutarConsultaSimpleFila($sqlPrecio,$datos);

        if ($query) {
	// si se
           $sessData['estado']['type'] = 'error';
           $sessData['estado']['msg'] = 'No puedes comprar tu propio articulo, intentalo con algún producto diferente.';
       }else{
	// no se
        $sqlPrecio = "SELECT i.inv_prec, i.inv_cant, u.usu_iden FROM inventario i INNER JOIN usuario u ON u.usu_iden = i.usu_iden WHERE i.inv_iden = '$idArticulo' LIMIT 1";
        $query = $this->ejecutarConsultaSimpleFila($sqlPrecio,$datos);
// Revisar desde aqui
        if ($query) {
            $precioFinal = ($query->inv_prec * $cantidad);
            $actualizarCantidad = ($query->inv_cant - $cantidad);
            $usuarioVenta = $query->usu_iden;
        }

        $sql = "INSERT INTO compra(com_iden,usu_comp,usu_vent,inv_comp,com_prec,com_fech,com_cant) VALUES('','$idUsuario','$usuarioVenta','$idArticulo','$precioFinal','$creado','$cantidad')";
        $peticion = $this->ejecutarConsulta($sql,$datos);

        $sqlVenta = "INSERT INTO venta(ven_iden,usu_vent,usu_comp,inv_vent,ven_prec,ven_fech,ven_cant) VALUES('','$usuarioVenta','$idUsuario','$idArticulo','$precioFinal','$creado','$cantidad')";
        $peticionVenta = $this->ejecutarConsulta($sqlVenta,$datos);

        if($peticion && $peticionVenta){
            $sqlActualizar = "UPDATE inventario i SET i.inv_cant = '$actualizarCantidad' WHERE i.inv_iden='$idArticulo'";
            $peticionActualizar = $this->ejecutarConsulta($sqlActualizar,$datos);
            if ($peticionActualizar) {
                $sessData['estado']['type'] = 'success';
                $sessData['estado']['msg'] = 'Su compra se realizo correctamente, revisa la sesión de compras para ver más detalles.';
            }
        }else{
            $sessData['estado']['type'] = 'error';
            $sessData['estado']['msg'] = 'Ha ocurrido algún problema, por favor intente de nuevo.';
        }
    }


    echo json_encode($sessData);
}

public function compras($idUsuario){
    $requestData = $_POST;
    $columns = array( 
        0 =>'i.inv_nomb'
    );
    $datos='';

// getting total number records without any search
    $sql1 = "SELECT COUNT(c.com_iden) as totalcero FROM compra c INNER JOIN inventario i ON c.inv_comp = i.inv_iden INNER JOIN usuario u ON u.usu_iden = c.usu_comp WHERE c.usu_comp='$idUsuario'";
    $query=$this->ejecutarConsultaSimpleFila($sql1,$datos);
// Revisar desde aqui
    if ($query) {
        $totalData = $query->totalcero;
    }
    $sql = "SELECT c.usu_vent ,c.com_prec, c.com_fech, c.com_cant, i.inv_iden, i.inv_nomb, i.inv_desc, i.inv_prec, i.inv_foto FROM compra c INNER JOIN inventario i ON c.inv_comp = i.inv_iden INNER JOIN usuario u ON u.usu_iden = c.usu_comp WHERE c.usu_comp = '$idUsuario'";
// getting records as per search parameters
if( isset($requestData['search']) && $requestData['search'] !== "" ){   //name
    $sql.=" AND i.inv_nomb LIKE '%".addslashes($requestData['search']['value'])."%' ";
}
// Revisar esto
$query=$this->ejecutarConsultaCantidadRow($sql,$datos);
$totalFiltered = $query;

$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   ";  // adding length
$query=$this->ejecutarConsultaTodasFilas($sql,$datos);
$data=array();

if ($query) {
    foreach ($query as $row) {

// c.com_prec, c.com_fech, c.com_cant, i.inv_iden, i.inv_nomb, i.inv_desc, i.inv_prec, i.inv_foto
        $fechaOriginal = $row->com_fech;
        $fechaFormateada = date("d-m-Y", strtotime($fechaOriginal));
        $foto = empty($row->inv_foto)?'indice.png':$row->inv_foto;
        $data[]=array(  "0"=>'
            <div class="box bg-white product-view m-b-2"><div class="box-block"><div class="row">
            <div class="col-md-3">
            <div class="pv-images m-b-1 m-sm-b-0"><div class="m-b-1">
            <img class="img-fluid" src="SubidArchivos/archivos/articulosUsuario/'.$foto.'" alt="">
            </div></div>
            </div>

            <div class="col-md-8"> <div class="pv-content"><div class="pv-title">'.$row->inv_nomb.' 
            <a class="text-danger" href="#"><i class="fa fa-clock-o"></i> '.$fechaFormateada.'</a>
            </div>
            <p>'.$row->inv_desc.'</p><p>Cantidad de la compra: '.$row->com_cant.'</p><p></p></div>
            <div class="pv-form">
            <div class="pv-price">Precio del articulo: <span>'.$row->inv_prec.' Bs.S</span></div>
            <div class="pv-price">Precio de la compra: <span>'.$row->com_prec.' Bs.S</span></div>
            <div class="container-fluid">
            <div class="row">
            <div class="col-1 col-md-1">
            </div>
            <div class="col-3 col-md-3">
            <button type="button" class="btn btn-success" onclick="verInformacion(\''.$row->usu_vent.'\');" data-toggle="modal" data-target="#modalUsuario">Ver información del vendedor del articulo</button>
            </div>
            <div class="col-3 col-md-3">

            </div></div></div></div></div></div></div></div>'
        );

    }
}else{
    $data[]=array(  "0"=>'No hay nada');
}

$json_data = array(
    "sEcho"=>intval( $requestData['draw'] ),  //Informacion para el datatables
    "iTotalRecords"=>intval( $totalData ),//enviamos el total de registros al datatable 
    "iTotalDisplayRecords"=>intval( $totalFiltered ),//enviamos el total registros a visualizar 
    "aaData"=>$data
);
echo json_encode($json_data);  // send data as json format
}

}

?>