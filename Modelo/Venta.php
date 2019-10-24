<?php 
require_once "Funciones.php";
class Venta extends Funciones
{
public function ventas($idUsuario){

$requestData = $_POST;
$columns = array( 
    0 =>'i.inv_nomb'
);
$datos='';

// getting total number records without any search
$sql1 = "SELECT COUNT(v.ven_iden) as totalcero FROM venta v INNER JOIN inventario i ON v.inv_vent = i.inv_iden INNER JOIN usuario u ON u.usu_iden = v.usu_vent WHERE v.usu_vent='$idUsuario'";
$query=$this->ejecutarConsultaSimpleFila($sql1,$datos);
// Revisar desde aqui
if ($query) {
    $totalData = $query->totalcero;
}
$sql = "SELECT v.usu_comp, v.ven_prec, v.ven_fech, v.ven_cant, i.inv_iden, i.inv_nomb, i.inv_desc, i.inv_prec, i.inv_foto FROM venta v INNER JOIN inventario i ON v.inv_vent = i.inv_iden INNER JOIN usuario u ON u.usu_iden = v.usu_vent WHERE v.usu_vent='$idUsuario'";
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

    $fechaOriginal = $row->ven_fech;
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
        <p>'.$row->inv_desc.'</p><p>Cantidad de la venta: '.$row->ven_cant.'</p><p></p></div>
    <div class="pv-form">
    <div class="pv-price">Precio del articulo: <span>'.$row->inv_prec.' Bs.S</span></div>
    <div class="pv-price">Precio de la venta: <span>'.$row->ven_prec.' Bs.S</span></div>
<div class="container-fluid">
<div class="row">
<div class="col-1 col-md-1">
</div>
<div class="col-3 col-md-3">
    <button type="button" class="btn btn-success" onclick="verInformacion(\''.$row->usu_comp.'\');" data-toggle="modal" data-target="#modalUsuario">Ver información del comprador del articulo</button>
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