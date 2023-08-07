<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <div class="alert <?=$_SESSION['identity']->username == 'salmaperez' ? 'alert-maroon' : 'alert-success'?>">
                <h3>Estudios SocioEconómicos</h3>
            </div> 
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <br>
    <?php if ((Utils::isValid($_SESSION['identity']) && Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager()) && $_GET['action'] == 'index'): ?>
      <section class="content-header">
      <div class="container-fluid">
        <form method="POST" action="<?= base_url . "ServicioApoyo/index" ?>" class="row">
          <div class="col-12 col-md-3">
            <div class="form-group">
              <label for="start_date" class="col-form-label">Fecha inicial:</label>
              <input type="date" name="start_date" id="start_date" value="<?= isset($_POST['start_date']) ? $_POST['start_date'] : date('Y-m-d', strtotime('-30 days')) ?>" class="form-control">
            </div>
          </div>
          <div class="col-12 col-md-3">
            <div class="form-group">
              <label for="end_date" class="col-form-label">Fecha final:</label>
              <input type="date" name="end_date" id="end_date" value="<?= isset($_POST['end_date']) ? $_POST['end_date'] : date('Y-m-d') ?>" class="form-control">
            </div>
          </div>
          <div class="col-12 col-md-4">
          <div class="form-group">
            <label for="end_date" class="col-form-label">Empresa:</label>
            <select name="Empresa" class="form-control select2">
              <option value="0">-- Sin empresa --</option>
              <?php $Empresas = Utils::showEmpresas(); ?>
              <?php foreach ($Empresas as $empresa) : ?>
                <option value="<?= $empresa['Empresa']  ?>" <?= isset($_POST['Empresa']) && $_POST['Empresa'] == $empresa['Empresa'] ? 'selected' : '' ?>><?= $empresa['Nombre_Empresa']  ?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>
        
          <div class="col-12 col-md-2" style="padding-right: 14px;">
            <button type="submit" name="search" id="search" class="btn btn-app btn-block btn-info" style="background-color: #17a2b8; color: #fff;"><i class="fas fa-search"></i>Buscar</button>
          </div>
        </form>
      </div>
    </section>
    <?php endif ?>
    <?php if (Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isManager() || Utils::isAccount()||$_SESSION['identity']->username == 'usuarioingenia' ): ?>
      <section class="content-header">
        <div class="row">
          <div class="col-sm-2 ml-auto">
            <a class="btn btn-orange float-right" <?=$_SESSION['identity']->username == 'salmaperez' ? "style='background: #cd5c5c !important'" : ''?> href="<?=base_url?>ServicioApoyo/crear">Nuevo candidato</a>
            <a class="btn btn-primary float-right" href="<?=base_url?>ServicioApoyo/carga_masiva">Cargar candidatos</a>
          </div>
        </div>
      </section>
    <?php endif ?>
      
    <!-- Main content -->
    <section class="content">
        <div class="card bg-transparent">
            <div class="card-header">
              <h3 class="card-title">Listado de servicios</h3>
            </div>
            <div class="card-body">
              <table id="tb_servicios" class="table table-responsive table-striped table-sm" style="display: none;">
                <thead>
                    <tr>
                      <th></th>
                      <th class="filterhead"></th>
                      <th></th>
                      <th class="filterhead"></th>
                      <th class="filterhead"></th>
                      <th class="filterhead"></th>
                      <th></th>
                      <th class="filterhead"></th>
                      <th ></th>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th class="filterhead"></th>
                      <th></th>
                    </tr>
                    <tr>
                      <th class="align-middle">Solicitud</th>
                      <th class="align-middle">Cliente</th>
                      <th class="align-middle">Candidato</th>
                      <th class="align-middle text-center">Servicio solicitado</th>
                      <th class="align-middle">Fase</th>
                      <th class="align-middle text-center">Ejecutivo de Cuenta</th>
                      <th class="align-middle text-center">Agenda</th>
                      <th class="align-middle text-center">Ejecutivo de Logística</th>
                      <th class="align-middle text-center" >Progreso</th>
                      <th class="align-middle text-center">Entrega</th>
                      <th class="align-middle">Tiempo IL</th>
                      <th class="align-middle">Tiempo ESE</th>
                      <th class="align-middle">Tiempo</th>
                      <th class="align-middle text-center">Estado</th>
                      <th>Acciones</th>
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
                        elseif ($estudio['Servicio_Solicitado'] == 'ESE + VISITA')
                          $Color_Servicio_Solicitado = 'bg-purple';
                        else
                          $Color_Servicio_Solicitado = '';

                        if ($estudio['Fase'] == 'ESE' || $estudio['Fase'] == 'RAL + INV.LAB + ESE')
                          $Color_Fase = 'bg-navy';
                        elseif ($estudio['Fase'] == 'INV. LABORAL' || $estudio['Fase'] == 'RAL + INV.LAB')
                          $Color_Fase = 'bg-danger';
                        elseif ($estudio['Fase'] == 'RAL')
                          $Color_Fase = 'bg-warning';
                        elseif ($estudio['Fase'] == 'RAL + INV.LAB + ESE + VISITA')
                          $Color_Fase = 'bg-purple';
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
						elseif ($estudio['Estatus'] == 'Finalizado' && ($estudio['Factura'] != null || $estudio['Factura'] != ''))
                 		 $Color_Estatus = 'bg-indigo';
                        elseif($estudio['Estatus'] == 'Finalizado')
                          $Color_Estatus = 'bg-primary';
                        elseif($estudio['Estatus'] == 'Facturado')
                          $Color_Estatus = 'table-info';
                        elseif($estudio['Estatus'] == 'Cancelado')
                          $Color_Estatus = 'bg-danger';
                        elseif($estudio['Estatus'] == 'Validación de Licencia en Proceso')
                          $Color_Estatus = 'bg-black';
                        elseif($estudio['Estatus'] == 'Visita Presencial en Proceso')
                          $Color_Estatus = 'bg-purple';
                        elseif($estudio['Estatus'] == 'Pausado')
                          $Color_Estatus = 'bg-orange';
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

                        if (intval($estudio['Tiempo_IL']) < 2 && intval($estudio['Tiempo_IL']) > -1) 
                          $Color_Tiempo_IL = 'bg-success';
                        elseif (intval($estudio['Tiempo_IL']) > 2)
                          $Color_Tiempo_IL = 'bg-danger';
                        elseif (intval($estudio['Tiempo_IL']) == -1)
                          $Color_Tiempo_IL = '';
                        else
                          $Color_Tiempo_IL = 'bg-orange';

                        if (intval($estudio['Tiempo_ESE']) < 2 && intval($estudio['Tiempo_ESE']) > -1)
                          $Color_Tiempo_ESE = 'bg-success';
                        elseif (intval($estudio['Tiempo_ESE']) > 2)
                          $Color_Tiempo_ESE = 'bg-danger';
                        elseif (intval($estudio['Tiempo_ESE']) == -1)
                          $Color_Tiempo_ESE = '';
                        else
                          $Color_Tiempo_ESE = 'bg-orange';

                        $progress = intval($estudio['Progreso']);
                        $Progreso = '';
                        if ($progress > 0)
                          if ($progress < 60)
                            $Progreso = "<span class='badge bg-danger'>{$progress}</span>";
                          elseif ($progress < 80)
                            $Progreso = "<span class='badge bg-warning'>{$progress}</span>";
                          elseif ($progress >= 80)
                            $Progreso = "<span class='badge bg-success'>{$progress}</span>";
                        else
                          $Progreso = '';
                        ?>
                        <td id="solicitud<?=$estudio['Folio']?>"><?=Utils::getFullDate($estudio['Solicitud'])?></td>
                        <td class="<?=$Color_Solicitud_De?>"><?=$estudio['Cliente']?></td>
                        <td class="text-center align-middle text-bold <?=$Color_Repetido?>"><?=$estudio['Nombre_Candidato']?></td>
                        <td class="text-center align-middle <?=$Color_Servicio_Solicitado?>"><?=$estudio['Servicio_Solicitado']?></td>
                        <td class="text-center align-middle <?=$Color_Fase?>"><?=$estudio['Fase']?></td>
                        
                        <td id="ejecutivo<?=$estudio['Folio']?>" class="text-center align-middle"><?=$estudio['Ejecutivo']?></td>
                        <td id="aplicacion<?=$estudio['Folio']?>" class="text-center align-middle"><?=!is_null($estudio['Aplicacion']) && !empty($estudio['Aplicacion']) ? Utils::getFullDate($estudio['Aplicacion']) : ''?></td>
                        <td id="logistica<?=$estudio['Folio']?>" class="text-center align-middle"><?=$estudio['HO']?></td>
                        <td class="text-center align-middle"><?=$Progreso?></td>
                        <td id="entregado<?=$estudio['Folio']?>" class="text-center align-middle"><?=!is_null($estudio['Fecha_Entregado']) && !empty($estudio['Fecha_Entregado']) ? Utils::getFullDate($estudio['Fecha_Entregado']) : ''?></td>
                        <td class="text-center align-middle <?=$Color_Tiempo_IL?>"><?=substr($estudio['Tiempo_IL'], 0, 1) == '.' ? '0'.$estudio['Tiempo_IL'] : $estudio['Tiempo_IL'] ?></td>
                        <td class="text-center align-middle <?=$Color_Tiempo_ESE?>"><?=substr($estudio['Tiempo_ESE'], 0, 1) == '.' ? '0'.$estudio['Tiempo_ESE'] : $estudio['Tiempo_ESE'] ?></td>
                        <td id="tiempo<?=$estudio['Folio']?>" class="text-center align-middle <?=$Color_Dias?>"><?=substr($estudio['Tiempo'], 0, 1) == '.' ? '0'.$estudio['Tiempo'] : $estudio['Tiempo'] ?></td>
                <td class="text-center align-middle <?= $Color_Estatus ?>"><?= $estudio['Estatus'] == 'Finalizado' && ($estudio['Factura'] != null || $estudio['Factura'] != '') ? $estudio['Estatus'] . ' ya foliado' : $estudio['Estatus']; ?></td>
                        <td class="text-right py-0 align-middle">
                            <div class="btn-group btn-group-sm">
                                <a href="<?=base_url?>ServicioApoyo/ver&candidato=<?=Encryption::encode($estudio['Folio'])?>" target="_blank" class="btn btn-success btn-sm">
                                    <i class="fas fa-eye"></i> Ver
                                </a>
                                <a href="<?=base_url?>ServicioApoyo/seguimiento&candidato=<?=Encryption::encode($estudio['Folio'])?>" target="_blank" class="btn btn-orange btn-sm">
                                    <i class="fas fa-history"></i> Seguimiento
                                </a>
                                <?php if ((Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor()) && ($estudio['Servicio_Solicitado'] == 'ESE' || $estudio['Servicio_Solicitado'] == 'ESE + VISITA')): ?>
                                  <button type="button" id="<?=$estudio['Folio']?>" class="btn btn-danger btn-sm btn-schedule">
                                  <i class="far fa-calendar-alt"></i> Agendar
                                </button>
                                <?php endif ?>
                              <?php if ((Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor()) && $estudio['Factura'] == '' && $estudio['Estado'] != 252): ?>
                                <button type="button" id="<?=$estudio['Folio']?>" class="btn btn-secondary btn-sm btn-config">
                                  <i class="fas fa-cog"></i> Configurar
                                </button>
                              <?php endif ?>
                              <?php if ($estudio['Enlace_Drive']): ?>
                                <a href="<?=$estudio['Enlace_Drive']?>" target="_blank" class="btn btn-sm btn-warning">
                                  <i class="fas fa-video mr-1"></i> Videollamada
                                </a>
                              <?php endif ?>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
                    
                </tbody>
                <tfoot>
                    <tr>
                      <th class="align-middle">Solicitud</th>
                      <th class="align-middle">Cliente</th>
                      <th class="align-middle">Candidato</th>
                      <th class="align-middle text-center">Servicio solicitado</th>
                      <th class="align-middle">Fase</th>
                      <th class="align-middle text-center">Ejecutivo de Cuenta</th>
                      <th class="align-middle text-center">Agenda</th>
                      <th class="align-middle text-center">Ejecutivo de Logística</th>
                      <th class="align-middle text-center" >Progreso</th>
                      <th class="align-middle text-center">Entrega</th>
                      <th class="align-middle">Tiempo IL</th>
                      <th class="align-middle">Tiempo ESE</th>
                      <th class="align-middle">Tiempo</th>
                      <th class="align-middle text-center">Estado</th>
                      <th>Acciones</th>
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
<script type="text/javascript" src="<?=base_url?>app/contenido_estudio.js?v=<?=rand()?>"></script>
<script src="<?=base_url?>app/servicioapoyo.js?v=<?=rand()?>"></script>
<script type="text/javascript">
  window.onload = function(){
    $("#tb_servicios").on('click','.btn-config', function () { 
         $('#modal_config').modal({backdrop: 'static', keyboard: false}); 
        let estudio = new ServicioApoyo();
        estudio.getEstudio($(this).attr('id'));  
    });

    $("#tb_servicios").on('click','.btn-schedule', function () { 
         $('#modal_schedule').modal({backdrop: 'static', keyboard: false}); 
        let estudio = new ServicioApoyo();
        estudio.getAgenda($(this).attr('id'));  
    });

    document.querySelector("#update-form").onsubmit = function(e){
      e.preventDefault();
      let estudio = new ServicioApoyo();
      estudio.update_config();
    };
    document.querySelector("#update-schedule-form").onsubmit = function(e){
      e.preventDefault();
      let estudio = new ServicioApoyo();
      estudio.update_schedule();
    };
  };
</script>