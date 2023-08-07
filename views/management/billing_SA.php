<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <div class="alert alert-success">
                <h3>Facturación</h3>
            </div>
            
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content-header">
      <div class="container-fluid">
        <form method="POST" action="<?=base_url."administracion/facturacion_SA"?>" class="row">
          <div class="col-12 col-md-5">
            <div class="form-group">
              <label for="start_date" class="col-form-label">Fecha inicial:</label>
              <input type="date" name="start_date" id="start_date" value="<?=isset($_POST['start_date']) ? $_POST['start_date'] : date('Y-m-d')?>" class="form-control">
            </div>
          </div>
          <div class="col-12 col-md-5">
            <div class="form-group">
              <label for="end_date" class="col-form-label">Fecha final:</label>
              <input type="date" name="end_date" id="end_date" value="<?=isset($_POST['end_date']) ? $_POST['end_date'] : date('Y-m-d')?>" class="form-control">
            </div>
          </div>
          <div class="col-12 col-md-2" style="padding-right: 14px;">
              <button type="submit" name="search" id="search" class="btn btn-app btn-block btn-info" style="background-color: #17a2b8; color: #fff;"><i class="fas fa-search"></i>Buscar</button>
          </div>
        </form>
        <hr>
        <div class="row">
          <div class="col-lg-3 col-12">
              <div class="small-box bg-warning">
                  <div class="inner">
                      <h5><?=count($servicios)?></h5>
                      
                      <p style="font-size: 0.8rem">Operaciones</p>
                      <p style="font-size: 0.8rem">Ingresadas</p>
                  </div>
                  <div class="icon">
                      <i class="ion ion-clipboard"></i>
                  </div>
              </div>
          </div>
          <div class="col-lg-3 col-12">
              <div class="small-box bg-info">
                  <div class="inner">
                      <h5>??</h5>
                      <p style="font-size: 0.8rem">En proceso de OC</p>
                      <h5>$</h5>
                  </div>
                  <div class="icon">
                      <i class="ion ion-android-sync"></i>
                  </div>
              </div>
          </div>
          <div class="col-lg-3 col-12">
              <div class="small-box bg-success">
                  <div class="inner">
                      <h4></h4>
                      <p style="font-size: 0.8rem">Facturadas</p>
                      <h5>$??</h5>
                  </div>
                  <div class="icon">
                      <i class="ion ion-cash"></i>
                  </div>
              </div>
          </div>
        </div>
      </div>  
    </section>
    <br>
    <!-- Main content -->
    <section class="content">
        <div class="card car-success">
            <div class="card-header">
              <h3 class="card-title">Listado de servicios</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <form method="POST">
                <input type="submit" name="submit" class="btn btn-success btn-block btn-lg" value="Guardar">
                <table id="tb_servicios" class="table table-bordered table-striped" style="font-size: 0.6rem;">
                  <thead>
                      <tr>
                        <th class="align-middle">Solicitud</th>
                        <th class="align-middle">Cliente</th>
                        <th class="align-middle text-center">Facturable a</th>
                        <th class="align-middle">Candidato</th>
                        <th class="align-middle">Servicio solicitado</th>
                        <th class="align-middle text-center">Fase</th>
                        <th class="align-middle text-center">Estado</th>
                        <th class="align-middle">Ejecutivo</th>
                        <th class="align-middle">% avance ESE</th>
                        <th>Folio</th>
                      </tr>
                  </thead>
                  <tbody>
                  <?php foreach($servicios as $servicio): ?>
                      <tr>
                          <td><?=Utils::getShortDate($servicio['Solicitud']);?></td>
                          <td><b><?=$servicio['Cliente']?></b></td>
                          <td><?=$servicio['Razon']?></td>
                          <td><?=$servicio['Nombre']?></td>
                          <td><?=$servicio['Servicio_Solicitado']?></td>
                          <td><?=$servicio['Servicio']?></td>
                          <td class="align-middle text-center"><?=$servicio['Estado']?></td>
                          <td class="text-center"><?=$servicio['Ejecutivo']?></td>
                          <td><?=$servicio['Progreso']?></td>
                          <td><input type="text" name="folio[]" value="<?=$servicio['Factura']?>" class="form-control" style="min-width: 100px;"></td>
                      </tr>
                  <?php endforeach; ?>
                      
                  </tbody>
                  <tfoot>
                      <tr>
                        <th class="align-middle">Solicitud</th>
                        <th class="align-middle">Cliente</th>
                        <th class="align-middle text-center">Facturable a</th>
                        <th class="align-middle">Candidato</th>
                        <th class="align-middle">Servicio solicitado</th>
                        <th class="align-middle text-center">Fase</th>
                        <th class="align-middle text-center">Estado</th>
                        <th class="align-middle">Ejecutivo</th>
                        <th class="align-middle">% avance ESE</th>
                        <th>Folio</th>
                      </tr>
                  </tfoot>
                </table>
              </form>
                
            </div>
            <!-- /.card-body -->
        </div>
    </section>
</div>
<script>
  $(document).ready(function(){
    let table = document.querySelector('#tb_servicios');
    utils.dtTable(table);
  });
</script>