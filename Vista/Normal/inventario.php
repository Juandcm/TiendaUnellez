<div class="row">
  <div class="col-sm-4 col-md-4 col-lg-4"></div>
  <div class="col-sm-4 col-md-4 col-lg-4">
<button type="button" class="btn btn-warning btn-lg label-right b-a-0 waves-effect waves-light" data-toggle="modal" data-target="#subirArticulo">
  <span class="btn-label"><i class="fa fa-cloud-upload"></i></span>
  Subir articulo al sistema
</button>
  </div>
  <div class="col-sm-4 col-md-4 col-lg-4"></div>
</div>

<!-- Centro de la Página web -->

<div class="box-header with-border">
  <h1 class="box-title">Todos los articulos subidos al sistema por usted!</h1>
  <div class="box-tools pull-right"></div>
</div>


<div id="demo">
  <div id="tabs" class="d-none blur">
    <ul>
      <li><a href="#tabs-1">Articulos aprobados</a></li>
      <li><a href="#tabs-2">Articulos no Aprobados</a></li>
    </ul>

<div id="tabs-1">
            <div class="panel-body table-responsive">
              <table cellpadding="0" cellspacing="0" border="0" id="listarEstado1" class="display table table-striped table-bordered table-condensed table-hover" style="width: 99%;">
                <thead class="cabecera">
                  <th>Información</th>
          </thead>
                <tbody class="cuerpo">
                </tbody>
              </table>
            </div></div>

<div id="tabs-2">
            <div class="panel-body table-responsive">
              <table cellpadding="0" cellspacing="0" border="0" id="listarEstado0" class="display table table-striped table-bordered table-condensed table-hover" style="width: 99%;">
                <thead class="cabecera">
                  <th>Información</th>
          </thead>
                <tbody class="cuerpo">
                </tbody>
              </table>
            </div>


</div>
</div>
</div>
<!-- Fin del centro -->

<?php 

include 'Vista/General/modalSubirArticulo.php';
?>