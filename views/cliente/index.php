<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <div class="alert alert-success">
            <h3>Nuestros clientes de SA</h3>
          </div>

        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <?php if (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSAManager()) : ?>
    <section class="content-header">
      <div class="row">
        <div class="col-md-4">
          <div class="info-box mb-3 bg-navy">
            <span class="info-box-icon"><i class="fas fa-briefcase"></i></span>

            <div class="info-box-content">
              <span class="info-box-text"></span>
              <span class="info-box-number"></span>
            </div>
            <!-- /.info-box-content -->
          </div>
        </div>
      </div>
      <?php if (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior() || Utils::isSAManager()) : ?>
        <div class="row">
          <div class="col-sm-2 ml-auto">
            <a class="btn btn-orange float-right" href="<?= base_url ?>cliente_SA/crear">Crear cliente</a>
          </div>
        </div>
        <div class="row mt-5">
          <div class="col-sm-2 mr-auto">
            <a class="btn btn-primary float-right" href="<?= base_url ?>clientecontacto_SA/index"><i class="far fa-id-card"></i> Contactos</a>
          </div>
          <div class="col-sm-2 mx-auto">
            <a class="btn btn-warning float-right" href="#"><i class="fas fa-star"></i>Evaluaciones</a>
          </div>
          <div class="col-sm-2 ml-auto">
            <a class="btn btn-danger float-right" href="<?= base_url ?>cliente_SA/detallado"><i class="fas fa-chart-bar mr-1"></i>Detallado</a>
          </div>
        </div>
      <?php endif ?>
    </section>
    <br>
  <?php endif ?>
  <!-- Main content -->
  <section class="content">
    <div class="card car-success">
      <div class="card-header">
        <h3 class="card-title">Listado de clientes</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table id="tb_customers" class="table table-striped">
          <thead>
            <tr>
              <?= (Utils::isAdmin()) ? '<th></th>' : ''; ?>
              <?= (Utils::isAdmin()) ? '<th class="filterhead"></th>' : ''; ?>
              <th></th>
              <th></th>
              <th></th>
              <?php if (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior() || Utils::isJunior() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor()) : ?>
                <th class="filterhead"></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
              <?php endif ?>
              <th></th>
            </tr>
            <tr>
              <?= (Utils::isAdmin()) ? ' <th class="text-center">Id Cliente</th>' : ''; ?>
              <?= (Utils::isAdmin()) ? ' <th class="text-center">Id Empresa</th>' : ''; ?>
              <th class="align-middle">Fecha Ingreso</th>
              <th class="align-middle">Empresa</th>
              <th class="align-middle">Cliente</th>
              <?php if (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior() || Utils::isJunior() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor()) : ?>
                <th class="text-center align-middle">Centro de costo</th>
                <th class="text-center align-middle">Servicios del mes</th>
                <th class="text-right align-middle">Facturación del mes</th>
                <th class="text-center align-middle">Promedio mensual en ingreso de unidades</th>
                <th class="text-right align-middle">Promedio mensual facturación</th>
                <th class="text-right align-middle">Monto acumulado del año facturación</th>
                <th class="text-center align-middle">Fecha última evaluación</th>
                <th class="text-center align-middle">Calificación del servicio</th>
              <?php endif ?>
              <th class="text-center">Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($clientes as $cliente) : ?>
              <tr>
                <?= (Utils::isAdmin()) ? '<td class="text-left align-middle">' . $cliente['Cliente'] . '</td>' : ''; ?>
                <?= (Utils::isAdmin()) ? '<td class="text-left align-middle">' . $cliente['ID_Empresa'] . '</td>' : ''; ?>
                <td><?= Utils::getShortDate($cliente['Fecha_Registro']) ?></td>
                <td class="text-left align-middle"><?= $cliente['Empresa'] ?></td>
                <td class="text-left align-middle"><?= $cliente['Nombre_Cliente'] ?></td>
                <?php if (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior() || Utils::isJunior() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor()) : ?>
                  <td class="text-center align-middle"><?= $cliente['Centro_Costos'] ?></td>
                  <td class="text-center align-middle"><?= $cliente['Servicios'] ?></td>
                  <td class="text-right align-middle"><?= '$ ' . number_format($cliente['Facturacion_Mes'], 2) ?></td>
                  <td class="text-center align-middle"><?= $cliente['Prom_Mensual'] ?></td>
                  <td class="text-right align-middle"><?= '$ ' . number_format($cliente['Prom_Fact'], 2) ?></td>
                  <td class="text-right align-middle"><?= '$ ' . number_format($cliente['Anual_Fact']) ?></td>
                  <td class="text-center align-middle"><?= $cliente['Fecha_Ultima_Evaluacion'] ? Utils::getShortDate($cliente['Fecha_Ultima_Evaluacion']) : '' ?></td>
                  <td class="text-center align-middle"><?= $cliente['Calificacion'] ? number_format($cliente['Calificacion'], 2) : 'Sin evaluar' ?></td>
                <?php endif ?>
                <td class="text-center py-0 align-middle">
                  <div class="btn-group btn-group-sm">
                    <a href="<?= base_url ?>cliente_SA/ver&id=<?= Encryption::encode($cliente['Cliente']) ?>" class="btn btn-success">
                      <i class="fas fa-eye"></i> Ver
                    </a>
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>

          </tbody>
          <tfoot>
            <tr>
              <?= (Utils::isAdmin()) ? ' <th class="text-center">Id Cliente</th>' : ''; ?>
              <?= (Utils::isAdmin()) ? ' <th class="text-center">Id Empresa</th>' : ''; ?>
              <th>Fecha Ingreso</th>
              <th>Empresa</th>
              <th>Cliente</th>
              <?php if (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior() || Utils::isJunior() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor()) : ?>
                <th class="text-center align-middle">Centro de costo</th>
                <th>Servicios del mes</th>
                <th class="text-center align-middle">Facturación del mes</th>
                <th class="text-center align-middle">Promedio mensual en ingreso de unidades</th>
                <th>Promedio mensual facturación</th>
                <th>Monto acumulado del año facturación</th>
                <th class="text-center align-middle">Fecha última evaluación</th>
                <th class="text-center align-middle">Calificación del servicio</th>
              <?php endif ?>
              <th class="text-center">Acciones</th>
            </tr>
          </tfoot>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
  </section>
</div>
<script>
  $(document).ready(function() {
    let table = document.querySelector('#tb_customers');
    utils.dtTable(table);
  });
</script>