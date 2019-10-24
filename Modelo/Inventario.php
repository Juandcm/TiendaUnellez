<?php 
require_once "Funciones.php";
class Inventario extends Funciones
{

    public function listar1($idUsuario){
        $requestData = $_POST;
        $columns = array( 
            0 =>'i.inv_nomb'
        );
        $datos='';

// inv_iden, usu_iden, inv_nomb, inv_desc, inv_prec, inv_fech, inv_foto, inv_cant, inv_esta
// getting total number records without any search
        $sql1 = "SELECT COUNT(i.inv_iden) as totalcero FROM inventario i INNER JOIN usuario u ON u.usu_iden = i.usu_iden WHERE i.inv_esta='1' AND u.usu_iden='$idUsuario'";
        $query=$this->ejecutarConsultaSimpleFila($sql1,$datos);
// Revisar desde aqui
        if ($query) {
            $totalData = $query->totalcero;
        }
        $sql = "SELECT i.inv_iden,i.inv_nomb, i.inv_desc, i.inv_prec, i.inv_fech, i.inv_foto, i.inv_cant FROM inventario i INNER JOIN usuario u ON u.usu_iden = i.usu_iden WHERE u.usu_iden='$idUsuario' AND i.inv_esta='1'";
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
        $fechaOriginal = $row->inv_fech;
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
            <!-- <a class="text-danger" href="#"><i class="fa fa-clock-o"></i> '.$fechaFormateada.'</a> -->
            </div>
            <p>'.$row->inv_desc.'</p><p>Cantidad: '.$row->inv_cant.'</p><p></p></div>
            <div class="pv-form">
            <div class="pv-price">Precio: <span>'.$row->inv_prec.' Bs.S</span></div>

            <div class="container-fluid">
            <div class="row">
            <div class="col-3 col-md-3">

            <button type="button" class="btn btn-success" onclick="editarArticulo(\''.$row->inv_iden.'\');">Editar articulo</button>
   
            </div>
            <div class="col-3 col-md-3">
            </div>
            <div class="col-3 col-md-3">

            <button type="button" class="btn btn-danger" onclick="eliminarArticulo(\''.$row->inv_iden.'\');">Eliminar articulo</button>


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

public function listar0($idUsuario){
    $requestData = $_POST;
    $columns = array( 
        0 =>'i.inv_nomb'
    );
    $datos='';

// inv_iden, usu_iden, inv_nomb, inv_desc, inv_prec, inv_fech, inv_foto, inv_cant, inv_esta
// getting total number records without any search
    $sql1 = "SELECT COUNT(i.inv_iden) as totalcero FROM inventario i INNER JOIN usuario u ON u.usu_iden = i.usu_iden WHERE i.inv_esta='0' AND u.usu_iden='$idUsuario'";
    $query=$this->ejecutarConsultaSimpleFila($sql1,$datos);
// Revisar desde aqui
    if ($query) {
        $totalData = $query->totalcero;
    }
    $sql = "SELECT i.inv_iden,i.inv_nomb, i.inv_desc, i.inv_prec, i.inv_fech, i.inv_foto, i.inv_cant FROM inventario i INNER JOIN usuario u ON u.usu_iden = i.usu_iden WHERE u.usu_iden='$idUsuario' AND i.inv_esta='0'";
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
        $fechaOriginal = $row->inv_fech;
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
            <p>'.$row->inv_desc.'</p><p>Cantidad: '.$row->inv_cant.'</p><p></p></div>
            <div class="pv-form">
            <div class="pv-price">Precio: <span>'.$row->inv_prec.' Bs.S</span></div>

            <div class="container-fluid">
            <div class="row">
            <div class="col-3 col-md-3">

            <button type="button" class="btn btn-success" onclick="editarArticulo(\''.$row->inv_iden.'\');">Editar articulo</button>

            </div>
            <div class="col-3 col-md-3">
            </div>
            <div class="col-3 col-md-3">

            <button type="button" class="btn btn-danger" onclick="eliminarArticulo(\''.$row->inv_iden.'\');">Eliminar articulo</button>


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

public function registrarArticulo($idUsuario,$nombre,$descripcion,$precio,$creado,$foto_articulo,$cantidad){
// Aqui registro al articulo en el sistema
    $sql = "INSERT INTO inventario (inv_iden, usu_iden, inv_nomb, inv_desc, inv_prec, inv_fech, inv_foto, inv_cant, inv_esta) VALUES (:inv_iden, :usu_iden, :inv_nomb, :inv_desc, :inv_prec, :inv_fech, :inv_foto, :inv_cant, :inv_esta)";

    $datos = array( 'inv_iden' => '', 'usu_iden'=>$idUsuario , 'inv_nomb' => $nombre,'inv_desc' => $descripcion,'inv_prec'=>$precio,'inv_fech'=>$creado,'inv_foto'=>$foto_articulo,'inv_cant'=>$cantidad,'inv_esta'=>'0');

    $consulta = $this->ejecutarConsulta($sql,$datos);
    if($consulta){
        $sessData['estado']['type'] = 'success';
        $sessData['estado']['msg'] = 'Se ha subido correctamente el articulo, tienes que esperar a que el administrador lo apruebe.';
    }else{
        $sessData['estado']['type'] = 'error';
        $sessData['estado']['msg'] = 'Ha ocurrido algún problema, por favor intente de nuevo.';
    }
    echo json_encode($sessData);	
}

public function listarSoloEstado0(){
    $requestData = $_POST;
    $columns = array( 
        0 =>'i.inv_nomb'
    );
    $datos='';

// inv_iden, usu_iden, inv_nomb, inv_desc, inv_prec, inv_fech, inv_foto, inv_cant, inv_esta
// getting total number records without any search
    $sql1 = "SELECT COUNT(i.inv_iden) as totalcero FROM inventario i INNER JOIN usuario u ON u.usu_iden = i.usu_iden WHERE i.inv_esta='0'";
    $query=$this->ejecutarConsultaSimpleFila($sql1,$datos);
// Revisar desde aqui
    if ($query) {
        $totalData = $query->totalcero;
    }
    $sql = "SELECT i.inv_iden,i.inv_nomb, i.inv_desc, i.inv_prec, i.inv_fech, i.inv_foto, i.inv_cant FROM inventario i INNER JOIN usuario u ON u.usu_iden = i.usu_iden WHERE i.inv_esta='0'";
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
        $fechaOriginal = $row->inv_fech;
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
            <p>'.$row->inv_desc.'</p><p>Cantidad: '.$row->inv_cant.'</p><p></p></div>
            <div class="pv-form">
            <div class="pv-price">Precio: <span>'.$row->inv_prec.' Bs.S</span></div>

            <div class="container-fluid">
            <div class="row">
            <div class="col-4 col-md-4">
            </div>
            <div class="col-4 col-md-4">
            <button type="button" class="btn btn-success" onclick="aprobarArticulo(\''.$row->inv_iden.'\');">Aprobar articulo</button>
            </div>
            <div class="col-4 col-md-4">

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

public function listarSoloEstado1(){
    $requestData = $_POST;
    $columns = array( 
        0 =>'i.inv_nomb'
    );
    $datos='';

// inv_iden, usu_iden, inv_nomb, inv_desc, inv_prec, inv_fech, inv_foto, inv_cant, inv_esta
// getting total number records without any search
    $sql1 = "SELECT COUNT(i.inv_iden) as totalcero FROM inventario i INNER JOIN usuario u ON u.usu_iden = i.usu_iden WHERE i.inv_esta='1'";
    $query=$this->ejecutarConsultaSimpleFila($sql1,$datos);
// Revisar desde aqui
    if ($query) {
        $totalData = $query->totalcero;
    }
    $sql = "SELECT i.inv_iden,i.inv_nomb, i.inv_desc, i.inv_prec, i.inv_fech, i.inv_foto, i.inv_cant FROM inventario i INNER JOIN usuario u ON u.usu_iden = i.usu_iden WHERE i.inv_esta='1'";
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
        $fechaOriginal = $row->inv_fech;
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
            <p>'.$row->inv_desc.'</p><p>Cantidad: '.$row->inv_cant.'</p><p></p></div>
            <div class="pv-form">
            <div class="pv-price">Precio: <span>'.$row->inv_prec.' Bs.S</span></div>

            <div class="container-fluid">
            <div class="row">
            <div class="col-4 col-md-4">
            </div>
            <div class="col-4 col-md-4">
            <button type="button" class="btn btn-danger" onclick="desaprobarArticulo(\''.$row->inv_iden.'\');">Desaprobar articulo</button>
            </div>
            <div class="col-4 col-md-4">

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

public function aprobar($idArticulo){
    $sessData=array();
    $datos='';
    $sql = "SELECT inv_esta FROM inventario WHERE inv_iden='$idArticulo'";
    $prevUser = $this->ejecutarConsultaSimpleFila($sql,$datos);
    if($prevUser){
        $sql2 = "UPDATE inventario SET inv_esta = '1' WHERE inv_iden='$idArticulo'";
        $update = $this->ejecutarConsulta($sql2,$datos);
        if($update){
            $sessData['estado']['type'] = 'success';
            $sessData['estado']['msg'] = 'Se aprobo correctamente el articulo';
        }else{
         $sessData['estado']['type'] = 'error';
         $sessData['estado']['msg'] = 'Ha ocurrido algún problema, por favor intente de nuevo más tarde.';
     }
 }else{
    $sessData['estado']['type'] = 'error';
    $sessData['estado']['msg'] = 'No se ha encontrado el articulo';
}
echo json_encode($sessData);
}


public function desaprobar($idArticulo){
    $sessData=array();
    $datos='';
    $sql = "SELECT inv_esta FROM inventario WHERE inv_iden='$idArticulo'";
    $prevUser = $this->ejecutarConsultaSimpleFila($sql,$datos);
    if($prevUser){
        $sql2 = "UPDATE inventario SET inv_esta = '0' WHERE inv_iden='$idArticulo'";
        $update = $this->ejecutarConsulta($sql2,$datos);
        if($update){
            $sessData['estado']['type'] = 'success';
            $sessData['estado']['msg'] = 'Se desaprobo correctamente el articulo';
        }else{
         $sessData['estado']['type'] = 'error';
         $sessData['estado']['msg'] = 'Ha ocurrido algún problema, por favor intente de nuevo más tarde.';
     }
 }else{
    $sessData['estado']['type'] = 'error';
    $sessData['estado']['msg'] = 'No se ha encontrado el articulo';
}
echo json_encode($sessData);
}


public function tiendaUsuario(){
    $datos='';
    $requestData = $_POST;
    $columns = array( 
        0 =>'i.inv_nomb'
    );

    $sql1 = "SELECT COUNT(i.inv_iden) as totalcero FROM inventario i INNER JOIN usuario u ON u.usu_iden = i.usu_iden WHERE i.inv_esta='1'";

    $query=$this->ejecutarConsultaSimpleFila($sql1,$datos);
    if ($query) {
        $totalData = $query->totalcero;
    }

    $sql2 = "SELECT i.inv_iden,i.inv_nomb, i.inv_desc, i.inv_prec, i.inv_fech, i.inv_foto, i.inv_cant FROM inventario i INNER JOIN usuario u ON u.usu_iden = i.usu_iden WHERE i.inv_esta='1'";

if( isset($requestData['search']) && $requestData['search'] !== "" ){   //name
    $sql2.=" AND i.inv_nomb LIKE '%".addslashes($requestData['search']['value'])."%' ";
}
$query=$this->ejecutarConsultaCantidadRow($sql2,$datos);
$totalFiltered = $query;

$sql2.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   ";  // adding length


$query=$this->ejecutarConsultaTodasFilas($sql2,$datos);
$data=array();

if ($query) {
    foreach ($query as $row) {
        $fechaOriginal = $row->inv_fech;
        $fechaFormateada = date("d-m-Y", strtotime($fechaOriginal));
        $foto = empty($row->inv_foto)?'indice.png':$row->inv_foto;
        $data[]=array(  "0"=>'
            <div class="box bg-white product-view m-b-2"><div class="box-block"><div class="row">
            <div class="col-md-5 col-sm-4">
            <div class="pv-images m-b-1 m-sm-b-0"><div class="m-b-1">
            <img class="img-fluid" src="SubidArchivos/archivos/articulosUsuario/'.$foto.'" alt="">
            </div></div>
            </div>

            <div class="col-md-6"> <div class="pv-content"><div class="pv-title">'.$row->inv_nomb.' 
            <a class="text-danger" href="#"><i class="fa fa-clock-o"></i> '.$fechaFormateada.'</a>
            </div>
            <p>'.$row->inv_desc.'</p><p>Cantidad: '.$row->inv_cant.'</p><p></p></div>
            <div class="pv-form">

            <div class="container-fluid">
            <div class="row">
            <div class="col-sm-4 col-lg-4">
            <div class="pv-price">Precio: <span>'.$row->inv_prec.' Bs.S </span>

            </div>
    
            </div>
            <div class="col-sm-4 col-lg-4">
            <button type="button" class="btn btn-success" onclick="comprarArticulo(\''.$row->inv_iden.'\');" data-toggle="modal" data-target="#modalCompra">Comprar este articulo</button>
            </div>
            <div class="col-sm-4 col-lg-4">
            
            </div>
            </div>
            </div>

            </div></div></div></div></div>
            '
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
echo json_encode($json_data);
}

public function tiendaUsuario2(){
    $datos='';
    $requestData = $_POST;
    $columns = array( 
        0 =>'i.inv_nomb'
    );

    $sql1 = "SELECT COUNT(i.inv_iden) as totalcero FROM inventario i INNER JOIN usuario u ON u.usu_iden = i.usu_iden WHERE i.inv_esta='1'";

    $query=$this->ejecutarConsultaSimpleFila($sql1,$datos);
    if ($query) {
        $totalData = $query->totalcero;
    }

    $sql2 = "SELECT i.inv_iden,i.inv_nomb, i.inv_desc, i.inv_prec, i.inv_fech, i.inv_foto, i.inv_cant FROM inventario i INNER JOIN usuario u ON u.usu_iden = i.usu_iden WHERE i.inv_esta='1'";

if( isset($requestData['search']) && $requestData['search'] !== "" ){   //name
    $sql2.=" AND i.inv_nomb LIKE '%".addslashes($requestData['search']['value'])."%' ";
}
$query=$this->ejecutarConsultaCantidadRow($sql2,$datos);
$totalFiltered = $query;

$sql2.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   ";  // adding length


$query=$this->ejecutarConsultaTodasFilas($sql2,$datos);
$data=array();

if ($query) {
    foreach ($query as $row) {
        $fechaOriginal = $row->inv_fech;
        $fechaFormateada = date("d-m-Y", strtotime($fechaOriginal));
        $foto = empty($row->inv_foto)?'indice.png':$row->inv_foto;
        $data[]=array(  "0"=>'
            <div class="box bg-white product-view m-b-2"><div class="box-block"><div class="row">
            <div class="col-md-5 col-sm-4">
            <div class="pv-images m-b-1 m-sm-b-0"><div class="m-b-1">
            <img class="img-fluid" src="SubidArchivos/archivos/articulosUsuario/'.$foto.'" alt="">
            </div></div>
            </div>

            <div class="col-md-6"> <div class="pv-content"><div class="pv-title">'.$row->inv_nomb.' 
            <a class="text-danger" href="#"><i class="fa fa-clock-o"></i> '.$fechaFormateada.'</a>
            </div>
            <p>'.$row->inv_desc.'</p><p>Cantidad: '.$row->inv_cant.'</p><p></p></div>
            <div class="pv-form">

            <div class="container-fluid">
            <div class="row">
            <div class="col-sm-4 col-lg-4">
            <div class="pv-price">Precio: <span>'.$row->inv_prec.' Bs.S </span>

            </div>

            </div>
            <div class="col-sm-4 col-lg-4">
            <button type="button" class="btn btn-success" data-dismiss="modal" data-toggle="modal" data-target="#entrarTienda">Comprar el articulo</button>
            </div>
            <div class="col-sm-4 col-lg-4">
            
            </div>
            </div>
            </div>

            </div></div></div></div></div>
            '
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
echo json_encode($json_data);
}

public function mostrarArticuloModal($idArticulo){
    $datos='';
    $sql1 = "SELECT i.inv_iden, i.inv_nomb, i.inv_desc, i.inv_prec, i.inv_foto, i.inv_cant, i.inv_esta  FROM inventario i INNER JOIN usuario u ON u.usu_iden = i.usu_iden WHERE i.inv_iden='$idArticulo'";
    $query=$this->ejecutarConsultaSimpleFila($sql1,$datos);
// Revisar desde aqui
    if ($query) {
        $foto = empty($query->inv_foto)?'indice.png':$query->inv_foto;      
        $sessData['estado']['msg'] = '<div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel"><p id="parrafo"><div class="pv-title">'.$query->inv_nomb.'</div></p></h4>
        </div>
        <div class="modal-body">
        <div class="row">
        <div class="col-12">
        <div class="box-block"><div class="row">
        <div class="col-md-4 col-sm-5">
        <div class="pv-images m-b-1 m-sm-b-0"><div class="m-b-1">
        <img class="img-fluid" src="SubidArchivos/archivos/articulosUsuario/'.$foto.'" alt="">
        </div></div>
        </div>

        <div class="col-md-8 col-sm-7"> <div class="pv-content">
        <p>'.$query->inv_desc.'</p><p></p></div>
        <div class="pv-form">

        <div class="container-fluid">
        <div class="row">
        <div class="col-md-3">
        <h6><div class="pv-price">Precio: <span>'.$query->inv_prec.' Bs.S</span></div></h6>
        </div>
        <div class="col-md-3">
        <h6>Cantidad maxima permitida:</h6>
        <h6><div class="pv-price"><span>'.$query->inv_cant.' </span></div></h6>
        </div>
        <div class="col-md-6">
        <h6>Cantidad de la compra</h6>
        <input class="form-control demoCantidad" type="number" value="1" name="cantidad" min="1" max="'.$query->inv_cant.'">
        </div>
        </div></div>

        </div></div></div></div>
        </div>
        </div>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" id="cerrarModal">Cerrar</button>
        <button type="button" class="btn btn-success" onclick="finalizarCompra(\''.$query->inv_iden.'\');">Finalizar compra del articulo</button>

        </div>
        ';
    }else{
        $sessData['estado']['msg'] = 'Ha ocurrido algún problema, por favor intente de nuevo más tarde.';
    }
    echo json_encode($sessData);
}

public function verArticulosRecientes(){
    $datos='';
    $sql1 = "SELECT i.inv_iden, i.inv_nomb, i.inv_foto, i.inv_esta FROM inventario i INNER JOIN usuario u ON u.usu_iden = i.usu_iden WHERE i.inv_esta='1' ORDER BY i.inv_iden DESC LIMIT 3";
    $query=$this->ejecutarConsultaTodasFilas($sql1,$datos);
// Revisar desde aqui
    if ($query) {
        foreach ($query as $row) {
            $foto = empty($row->inv_foto)?'indice.png':$row->inv_foto;      
            echo '
            <div class="col-md-4">
            <div class="b-item">
            <div class="bi-image img-cover" style="background-image: url(\'SubidArchivos/archivos/articulosUsuario/'.$foto.'\');">
            <button type="button" class="btn btn-danger btn-rounded label-right" onclick="verArticulo(\''.$row->inv_iden.'\');" data-toggle="modal" data-target="#modalVerArticulo">Leer más... <span class="btn-label"><i class="ti-angle-right"></i></span></button>
            </div>
            <div class="bi-title">'.$row->inv_nomb.'</div>
            </div>
            </div>
            ';
        }
    }else{
        echo 'No se ha encontrado ningún producto reciente.';
    }
// echo json_encode($sessData);    
}

public function verArticuloModal($idArticulo){
    $datos='';
    $sql1 = "SELECT i.inv_iden, i.inv_nomb, i.inv_desc, i.inv_prec, i.inv_foto, i.inv_cant, i.inv_esta  FROM inventario i INNER JOIN usuario u ON u.usu_iden = i.usu_iden WHERE i.inv_iden='$idArticulo'";
    $query=$this->ejecutarConsultaSimpleFila($sql1,$datos);
// Revisar desde aqui
    if ($query) {
        $foto = empty($query->inv_foto)?'indice.png':$query->inv_foto;      
        $sessData['estado']['msg'] = '<div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel"><p id="parrafo"><div class="pv-title">'.$query->inv_nomb.'</div></p></h4>
        </div>
        <div class="modal-body">
        <div class="row">
        <div class="col-12">
        <div class="box-block"><div class="row">
        <div class="col-md-4 col-sm-5">
        <div class="pv-images m-b-1 m-sm-b-0"><div class="m-b-1">
        <img class="img-fluid" src="SubidArchivos/archivos/articulosUsuario/'.$foto.'" alt="">
        </div></div>
        </div>

        <div class="col-md-8 col-sm-7"> <div class="pv-content">
        <p>'.$query->inv_desc.'</p><p></p></div>
        <div class="pv-form">

        <div class="container-fluid">
        <div class="row">
        <div class="col-md-3">
        <h6><div class="pv-price">Precio: <span>'.$query->inv_prec.' Bs.S</span></div></h6>
        </div>
        <div class="col-md-8">
        <h6>Cantidad en existencia:</h6>
        <h6><div class="pv-price"><span>'.$query->inv_cant.' </span></div></h6>
        </div>
        </div></div>

        </div></div></div></div>
        </div>
        </div>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" id="cerrarModal">Cerrar</button>
        <button type="button" class="btn btn-success" data-dismiss="modal" data-toggle="modal" data-target="#entrarTienda">Comprar el articulo</button>

        </div>
        ';
    }else{
        $sessData['estado']['msg'] = 'Ha ocurrido algún problema, por favor intente de nuevo más tarde.';
    }
    echo json_encode($sessData);
}

public function verEstadisticas(){
    $datos='';
    $sql1 = "SELECT COUNT(i.inv_iden) as totalArticulo FROM inventario i WHERE i.inv_esta = '1'";
    $query=$this->ejecutarConsultaSimpleFila($sql1,$datos);

    $sql3 = "SELECT COUNT(i.inv_iden) as totalArticulocero FROM inventario i WHERE i.inv_esta = '0'";
    $query3=$this->ejecutarConsultaSimpleFila($sql3,$datos);

    $sql2 = "SELECT COUNT(u.usu_iden) as totalUsuario FROM usuario u";
    $query2=$this->ejecutarConsultaSimpleFila($sql2,$datos);
// Revisar desde aqui
    if ($query && $query2 && $query3) {
        $totalArticulo = $query->totalArticulo; 
        $totalUsuario = $query2->totalUsuario;    
        $totalArticulo0 = $query3->totalArticulocero;
        $sessData['estado']['totalArticulo'] = $totalArticulo;
        $sessData['estado']['totalUsuario'] = $totalUsuario;
        $sessData['estado']['totalArticulo0'] = $totalArticulo0;
    }else{
        $sessData['estado']['msg'] = 'Ha ocurrido algún problema, por favor intente de nuevo más tarde.';
    }
    echo json_encode($sessData);     
}

public function eliminarArticulo($idArticulo){
    $sql = "DELETE FROM inventario WHERE inv_iden = '$idArticulo'";
    $consulta = $this->ejecutarConsulta($sql,$datos);
    if($consulta){
        $sessData['estado']['type'] = 'success';
        $sessData['estado']['msg'] = 'Se ha eliminado el articulo correctamente.';
    }else{
        $sessData['estado']['type'] = 'error';
        $sessData['estado']['msg'] = 'Ha ocurrido algún problema, por favor intente de nuevo.';
    }
    echo json_encode($sessData);
}

}

?>