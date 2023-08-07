<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <div class="alert alert-success">
                <h3>Prospectos</h3>
            </div>
            
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content-header">
      <div class="row">
          <div class="col-md-6">
              <div class="callout callout-success">
                  <h6>Total de prospectos ingresados en el mes</h6>
                  <b><?=Statistics::getTotalProspectosMesActual()?></b>
              </div>
          </div>
          <div class="col-md-6">
              <div class="callout callout-danger">
                  <h6>Total de prospectos ingresados en meses anteriores</h6>
                  <b><?=Statistics::getTotalProspectosMesesAnteriores()?></b>
              </div>
          </div>
      </div>
      <div class="row">
          <div class="col-md-6">
              <div class="callout callout-orange">
                  <h6>Total de altas de clientes de reclutamiento en el mes</h6>
                  <b><?=Statistics::getCustomerCountInCurrentMonth()?></b>
              </div>
          </div>
          <div class="col-md-6">
              <div class="callout callout-info">
                  <h6>Total de altas de clientes de reclutamiento en meses anteriores</h6>
                  <b><?=Statistics::getCustomerCountInPreviousMonths()?></b>
              </div>
          </div>
      </div>
      <div class="row">
        <div class="col-sm-2 ml-auto">
          <a class="btn btn-orange float-right" href="<?=base_url?>prospecto/crear">Crear prospecto</a>
        </div>
      </div>
    </section>
    <br>
    <!-- Main content -->
    <section class="content">
        <div class="card car-success">
            <div class="card-header">
              <h3 class="card-title">Listado de prospectos</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="tb_prospectos" class="table table-sm table-responsive table-striped" style="display: none;">
                <thead>
                    <tr>
                      <th></th>
                      <th></th>
                      <th class="filterhead"></th>
                      <th class="filterhead"></th>
                      <th class="filterhead"></th>
                      <th class="filterhead"></th>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th class="filterhead"></th>
                      <th></th>
                      <th></th>
                      <th></th>
                    </tr>
                    <tr>
                      <th>Fecha</th>
                      <th>Prospecto</th>
                      <th>Giro</th>
                      <th>CC</th>
                      <th>Ejecutivo</th>
                      <th>Tipo de cliente</th>
                      <th>Nombre del contacto</th>
                      <th>Puesto</th>
                      <th>Teléfono</th>
                      <th>Correo</th>
                      <th>Periodicidad de seguimiento</th>
                      <th>Fecha del último contacto</th>
                      <th>Siguiente contacto</th>
                      <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($prospectos as $prospecto): ?>
                    <tr>
                        <td><?=Utils::getShortDate($prospecto['Fecha'])?></td>
                        <td class="<?=$prospecto['Fecha_Prox_Seguimiento'] == date('Y-m-d') ? 'bg-danger' : ''?>"><b><?=$prospecto['Prospecto']?></b></td>
                        <td><?=$prospecto['Giro']?></td>
                        <td class="text-center"><?=$prospecto['Plaza']?></td>
                        <td><?=$prospecto['Ejecutivo']?></td>
                        <td><?=$prospecto['Tipo']?></td>
                        <td><?=$prospecto['Contacto_RH']?></td>
                        <td><?=$prospecto['Puesto']?></td>
                        <td><?=$prospecto['Telefono']?></td>
                        <td><?=$prospecto['Correo']?></td>
                        <td><?=$prospecto['Periodicidad']?></td>
                        <td><?=Utils::getShortDate($prospecto['Fecha_Envio_Propuesta'])?></td>
                        <td><?=Utils::getShortDate($prospecto['Fecha_Prox_Seguimiento'])?></td>
                        <td class="text-center py-0 align-middle">
                          <div class="btn-group btn-group-sm">
                              <a href="<?=base_url?>prospecto/editar&id=<?=$prospecto['ID']?>" class="btn btn-info">
                                <i class="fas fa-pencil-alt"></i> Editar
                              </a>
                              <a href="<?=base_url?>prospecto/trabajar&id=<?=$prospecto['ID']?>" class="btn btn-orange">
                                <i class="fas fa-hammer"></i> Trabajar
                              </a>
                          </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
                    
                </tbody>
                <tfoot>
                    <tr>
                      <th>Fecha</th>
                      <th>Prospecto</th>
                      <th>Giro</th>
                      <th>CC</th>
                      <th>Ejecutivo</th>
                      <th>Tipo de cliente</th>
                      <th>Nombre del contacto</th>
                      <th>Puesto</th>
                      <th>Teléfono</th>
                      <th>Correo</th>
                      <th>Periodicidad de seguimiento</th>
                      <th>Fecha del último contacto</th>
                      <th>Siguiente contacto</th>
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
  $(document).ready(function(){
    let table = document.querySelector('#tb_prospectos');
    table.style.display = "block";
    utils.dtTable(table, true);
  });
</script>