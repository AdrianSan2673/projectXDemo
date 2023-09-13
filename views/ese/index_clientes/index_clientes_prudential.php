<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <div class="alert  <?= $_SESSION['identity']->username == 'salmaperez1' ? 'alert-maroon' : 'alert-success' ?>">
            <h3>Estudios SocioEconómicos</h3>
          </div>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <br>
  <section class="content-header">
    <div class="row">
      <div class="col-sm-2 ml-auto">
        <a class="btn btn-primary float-right" href="<?= base_url ?>ServicioApoyo/carga_masiva">Cargar candidatos</a>
      </div>

      <div class="col-md-2 ml-auto">
        <a class="btn btn-orange float-right" href="<?= base_url ?>ServicioApoyo/crear">Nueva solicitud</a>
      </div>

    </div>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Listado de servicios</h3>
      </div>
      <div class="card-body">
        <table id="tb_servicios" class="table table-responsive table-striped table-sm" style="display: none;">
          <thead>
            <tr>
              <th></th>
              <th class="filterhead"></th>
              <th class="filterhead"></th>
              <th></th>
              <th></th>
              <th class="filterhead"></th>
              <th class="filterhead"></th>
              <th class="filterhead"></th>
              <th></th>
              <th></th>
              <th></th>
              <th></th>
              <th class="filterhead"></th>
              <th class="filterhead"></th>
            </tr>
            <tr>
              <th class="align-middle">Solicitud</th>
              <th class="align-middle">Nombre Comercial</th>
              <th class="align-middle text-center">Solicita</th>
              <th class="align-middle">Folio prudential</th>
              <th class="align-middle">Candidato</th>
              <th class="align-middle text-center">Servicio solicitado</th>
              <th class="align-middle">Fase</th>
              <th class="align-middle text-center">Ejecutivo de Cuenta</th>
              <th class="align-middle text-center">Agenda</th>
              <th class="align-middle text-center">Entrega</th>
              <th class="align-middle">Tiempo</th>
              <th class="align-middle text-center">Seguir</th>
              <th class="align-middle text-center">Estado</th>
              <th class="align-middle text-center">Viabilidad</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($estudios as $estudio) : ?>
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
                elseif ($estudio['Estatus'] == 'Finalizado')
                  $Color_Estatus = 'bg-primary';
                elseif ($estudio['Estatus'] == 'Facturado')
                  $Color_Estatus = 'table-info';
                elseif ($estudio['Estatus'] == 'Cancelado')
                  $Color_Estatus = 'bg-danger';
                elseif ($estudio['Estatus'] == 'Validación de Licencia en Proceso')
                  $Color_Estatus = 'bg-black';
                elseif ($estudio['Estatus'] == 'Visita Presencial en Proceso')
                  $Color_Estatus = 'bg-purple';
                elseif ($estudio['Estatus'] == 'Pausado')
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

                if ($estudio['Viable'] == '0' && ($estudio['Estado'] == 252 || $estudio['Estado'] == 254))
                  $Color_Viabilidad = 'table-success';
                elseif ($estudio['Viable'] == 1 && ($estudio['Estado'] == 252 || $estudio['Estado'] == 254))
                  $Color_Viabilidad = 'table-danger';
                elseif ($estudio['Viable'] == 2 && ($estudio['Estado'] == 252 || $estudio['Estado'] == 254))
                  $Color_Viabilidad = 'table-warning';
                elseif ($estudio['Viable'] == 5 && ($estudio['Estado'] == 252 || $estudio['Estado'] == 254))
                  $Color_Viabilidad = 'table-info';
                else
                  $Color_Viabilidad = '';
                ?>
                <td id="solicitud<?= $estudio['Folio'] ?>"><?= Utils::getFullDate($estudio['Solicitud']) ?></td>
                <td class="<?= $Color_Solicitud_De ?>"><?= $estudio['Cliente'] ?></td>
                <td class="text-center align-middle"><?= $estudio['Solicita'] ?></td>
                <td class="text-center align-middle"><?= $estudio['CC_Cliente'] ?></td>
                <td class="text-center align-middle text-bold <?= $Color_Repetido ?>"><?= $estudio['Nombre_Candidato'] ?></td>
                <td class="text-center align-middle <?= $Color_Servicio_Solicitado ?>"><?= $estudio['Servicio_Solicitado'] ?></td>
                <td class="text-center align-middle <?= $Color_Fase ?>"><?= $estudio['VLF'] . $estudio['Fase'] ?></td>
                <td id="ejecutivo<?= $estudio['Folio'] ?>" class="text-center align-middle"><?= $estudio['Ejecutivo'] ?></td>
                <td id="aplicacion<?= $estudio['Folio'] ?>" class="text-center align-middle"><?= !is_null($estudio['Aplicacion']) && !empty($estudio['Aplicacion']) ? Utils::getFullDate($estudio['Aplicacion']) : '' ?></td>
                <td id="entregado<?= $estudio['Folio'] ?>" class="text-center align-middle"><?= !is_null($estudio['Fecha_Entregado']) && !empty($estudio['Fecha_Entregado']) ? Utils::getFullDate($estudio['Fecha_Entregado']) : '' ?></td>
                <td id="tiempo<?= $estudio['Folio'] ?>" class="text-center align-middle <?= $Color_Dias ?>"><?= $estudio['Tiempo'] ?></td>
                <td class="text-center py-0 align-middle">
                  <div class="btn-group btn-group-sm">
                    <a href="<?= base_url ?>ServicioApoyo/seguimiento&candidato=<?= Encryption::encode($estudio['Folio']) ?>" target="_blank" class="btn btn-orange btn-sm">
                      <i class="fas fa-history"></i>
                    </a>
                  </div>
                </td>
                <td class="text-center align-middle <?= $Color_Estatus ?>"><?= $estudio['Estatus'] ?></td>
                <td class="text-center align-middle <?= $Color_Viabilidad ?>"><?= $estudio['Viable'] == '0' && ($estudio['Estado'] == 252 || $estudio['Estado'] == 254) ? 'Viable' : ($estudio['Viable'] == 1 && ($estudio['Estado'] == 252 || $estudio['Estado'] == 254) ? 'No viable' : ($estudio['Viable'] == 2 && ($estudio['Estado'] == 252 || $estudio['Estado'] == 254) ? 'Viable con Reservas' : ($estudio['Viable'] == 5 && ($estudio['Estado'] == 252 || $estudio['Estado'] == 254) ? 'Viable con observaciones' : '-'))) ?></td>
             
              </tr>
            <?php endforeach; ?>

          </tbody>
          <tfoot>
            <tr>
              <th class="align-middle">Solicitud</th>
              <th class="align-middle">Nombre Comercial</th>
              <th class="align-middle">Solicita</th>
              <th class="align-middle">Folio prudential</th>
              <th class="align-middle">Candidato</th>
              <th class="align-middle text-center">Servicio solicitado</th>
              <th class="align-middle">Fase</th>
              <th class="align-middle text-center">Ejecutivo de Cuenta</th>
              <th class="align-middle text-center">Agenda</th>
              <th class="align-middle text-center">Entrega</th>
              <th class="align-middle">Tiempo</th>
              <th class="align-middle text-center">Seguir</th>
              <th class="align-middle text-center">Estado</th>
              <th class="align-middle text-center">Viabilidad</th>
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
  window.onload = function() {

  }
</script>
<script type="text/javascript" src="<?= base_url ?>app/contenido_estudio.js?v=<?= rand() ?>"></script>
<script src="<?= base_url ?>app/servicioapoyo.js?v=<?= rand() ?>"></script>