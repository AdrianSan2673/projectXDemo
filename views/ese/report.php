<div class="content-wrapper" <?=$_SESSION['identity']->username == 'salmaperez' ? 'style="background: #ffcdd4"' : ''?>>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <div class="alert  <?=$_SESSION['identity']->username == 'salmaperez' ? 'alert-maroon' : 'alert-success'?>">
                <h3>Reporte de operaciones</h3>
            </div> 
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <br>
    <section class="content-header">
      <div class="container-fluid">
        <form method="POST" action="<?=base_url."reporte/operaciones_SA"?>" class="row">
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
              <button type="submit" name="search" id="search" class="btn btn-app btn-block btn-info" style="background-color: #17a2b8; color: #fff;"><i class="fas fa-search"></i>Buscar y exportar</button>
          </div>
        </form>
      </div>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="card bg-transparent">
            <div class="card-body">
              <table id="tb_servicios" class="table table-responsive table-striped table-sm" style="display: none;">
                <thead>
                    <tr>
                      <th class="filterhead"></th>
                      <th></th>
                      <th class="filterhead"></th>
                      <th class="filterhead"></th>
                      <th></th>
                      <th class="filterhead"></th>
                      <th class="filterhead"></th>
                      <th class="filterhead"></th>
                      <th></th>
                      <th class="filterhead"></th>
                      <th></th>
                      <th></th>
                      <th class="filterhead"></th>
                      <th class="filterhead"></th>
                      <th class="filterhead"></th>
                      <th class="filterhead"></th>
                    </tr>
                    <tr>
                      <th class="align-middle">CC RHI</th>
                      <th class="align-middle">Solicitud</th>
                      <th class="align-middle">Empresa</th>
                      <th class="align-middle">Cliente</th>
                      <th class="align-middle">Candidato</th>
                      <th class="align-middle text-center">Servicio solicitado</th>
                      <th class="align-middle">Fase</th>
                      <th class="align-middle text-center">Ejecutivo de Cuenta</th>
                      <th class="align-middle text-center">Agenda</th>
                      <th class="align-middle text-center">Ejecutivo de Logística</th>
                      <th class="align-middle text-center">Entrega</th>
                      <th class="align-middle">Tiempo</th>
                      <th class="align-middle text-center">Estado</th>
                      <th class="align-middle text-center">Factura</th>
                      <th class="align-middle text-center">Razón social</th>
                      <th class="align-middle text-center">Solicita</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($estudios as $estudio): ?>
                    <tr>
                      <?php 
                         if ($estudio['Solicitud_De'] > 0)
                          $Color_Solicitud_De = 'table-warning';
                        else
                          $Color_Solicitud_De = '';

                        if ($estudio['Servicio_Solicitado'] == 'ESE') 
                          $Color_Servicio_Solicitado = 'bg-navy';
                        elseif ($estudio['Servicio_Solicitado'] == 'INV. LABORAL') 
                          $Color_Servicio_Solicitado = 'bg-danger';
                        elseif ($estudio['Servicio_Solicitado'] == 'RAL')
                          $Color_Servicio_Solicitado = 'bg-warning';
                        else
                          $Color_Servicio_Solicitado = '';

                        if ($estudio['Fase'] == 'ESE' || $estudio['Fase'] == 'RAL + INV.LAB + ESE')
                          $Color_Fase = 'bg-navy';
                        elseif ($estudio['Fase'] == 'INV. LABORAL' || $estudio['Fase'] == 'RAL + INV.LAB')
                          $Color_Fase = 'bg-danger';
                        elseif ($estudio['Fase'] == 'RAL')
                          $Color_Fase = 'bg-warning';
                        else
                          $Color_Fase = '';

                        if ($estudio['Repetidos'] > 1)
                          $Color_Repetido = 'bg-danger';
                        else
                          $Color_Repetido = '';
                  
                        if ($estudio['Estatus'] == 'Ral en Proceso')
                          $Color_Estatus = 'bg-warning';
                        elseif ($estudio['Estatus'] == 'Investigación en Proceso')
                          $Color_Estatus = 'bg-secondary';
                        elseif ($estudio['Estatus'] == 'Visita en Proceso')
                          $Color_Estatus = 'bg-navy';
                        elseif($estudio['Estatus'] == 'Finalizado')
                          $Color_Estatus = 'bg-primary';
                        elseif($estudio['Estatus'] == 'Facturado')
                          $Color_Estatus = 'table-info';
                        elseif($estudio['Estatus'] == 'Cancelado')
                          $Color_Estatus = 'bg-danger';
                        else
                          $Color_Estatus = '';

                        if ($estudio['Dias'] < 2 && $estudio['Dias'] > -1)
                          $Color_Dias = 'bg-success';
                        elseif ($estudio['Dias'] > 2)
                          $Color_Dias = 'bg-danger';
                        elseif ($estudio['Dias'] == -1)
                          $Color_Dias = '';
                        else
                          $Color_Dias = 'bg-orange';

                        ?>
                        <td><?=$estudio['Centro_C']?></td>
                        <td id="solicitud<?=$estudio['Folio']?>"><?=date_format(date_create($estudio['Solicitud']), 'Y-m-d')?></td>
                        <td><?=$estudio['Empresa']?></td>
                        <td class="<?=$Color_Solicitud_De?>"><?=$estudio['Cliente']?></td>
                        <td class="text-center align-middle text-bold <?=$Color_Repetido?>"><?=$estudio['Nombre_Candidato']?></td>
                        <td class="text-center align-middle <?=$Color_Servicio_Solicitado?>"><?=$estudio['Servicio_Solicitado']?></td>
                        <td class="text-center align-middle <?=$Color_Fase?>"><?=$estudio['Fase']?></td>
                        
                        <td id="ejecutivo<?=$estudio['Folio']?>" class="text-center align-middle"><?=$estudio['Ejecutivo']?></td>
                        <td id="aplicacion<?=$estudio['Folio']?>" class="text-center align-middle"><?=!is_null($estudio['Aplicacion']) && !empty($estudio['Aplicacion']) ? date_format(date_create($estudio['Aplicacion']), 'Y-m-d') : ''?></td>
                        <td id="logistica<?=$estudio['Folio']?>" class="text-center align-middle"><?=$estudio['HO']?></td>
                        <td id="entregado<?=$estudio['Folio']?>" class="text-center align-middle"><?=!is_null($estudio['Fecha_Entregado']) && !empty($estudio['Fecha_Entregado']) ? date_format(date_create($estudio['Fecha_Entregado']), 'Y-m-d') : ''?></td>
                        <td id="tiempo<?=$estudio['Folio']?>" class="text-center align-middle <?=$Color_Dias?>"><?=$estudio['Tiempo']?></td>
                        <td class="text-center align-middle <?=$Color_Estatus?>"><?=$estudio['Estatus']?></td>
                        <td class="text-center align-middle"><?=$estudio['Factura']?></td>
                        <td class="text-center align-middle"><?=$estudio['Razon']?></td>
                        <td class="text-center align-middle"><?=$estudio['Solicita']?></td>
                    </tr>
                <?php endforeach; ?>
                    
                </tbody>
                <tfoot>
                    <tr>
                      <th class="align-middle">CC RHI</th>
                      <th class="align-middle">Solicitud</th>
                      <th class="align-middle">Empresa</th>
                      <th class="align-middle">Cliente</th>
                      <th class="align-middle">Candidato</th>
                      <th class="align-middle text-center">Servicio solicitado</th>
                      <th class="align-middle">Fase</th>
                      <th class="align-middle text-center">Ejecutivo de Cuenta</th>
                      <th class="align-middle text-center">Agenda</th>
                      <th class="align-middle text-center">Ejecutivo de Logística</th>
                      <th class="align-middle text-center">Entrega</th>
                      <th class="align-middle">Tiempo</th>
                      <th class="align-middle text-center">Estado</th>
                      <th class="align-middle text-center">Factura</th>
                      <th class="align-middle text-center">Razón social</th>
                      <th class="align-middle text-center">Solicita</th>
                    </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
        </div>
    </section>
</div>
<script>
  document.addEventListener('DOMContentLoaded', e => {
    let table = document.querySelector('#tb_servicios');
    table.style.display = "table";
    utils.dtTable(table, true);
  })
  window.onload = function(){
    
  }
</script>
