<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <div class="alert alert-success">
            <h3>Clientes con recursos humanos</h3>
          </div>

        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

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
              <?= (Utils::isAdmin()) ? ' <th class="text-center">Id Cliente</th>' : ''; ?>
              <?= (Utils::isAdmin()) ? ' <th class="text-center">Id Empresa</th>' : ''; ?>
              <th class="align-middle">Fecha Ingreso</th>
              <th class="align-middle">Empresa</th>
              <th class="align-middle">Cliente</th>
              <?php if (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior() || Utils::isJunior() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor()) : ?>
                <th class="text-center align-middle">Centro de costo</th>
                <th class="text-center align-middle">Servicios del mes</th>
                <th class="text-right align-middle">Paquete</th>
                <th class="text-right align-middle">Activo</th>
                <th class="text-right align-middle">Fecha de cancelacion</th>

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
                <td class="text-left align-middle "><?= $cliente['Nombre_Cliente'] ?></td>
                <?php if (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior() || Utils::isJunior() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor()) : ?>
                  <td class="text-center align-middle"><?= $cliente['Centro_Costos'] ?></td>
                  <td class="text-center align-middle"><?= $cliente['Servicios'] ?></td>
                  <td class="text-center align-middle"><?= $cliente['Paquete'] == '' ? 'Sin paquete' : $cliente['Paquete']  ?></td>
                  <td class="text-center align-middle"><?= $cliente['Modulo_RH'] == 0 ? '<small class="badge badge-danger"><i class="fas fa-times-circle"></i>Desactivado</small>' : '<small class="badge badge-success"><i class="fas fa-check-circle"></i>Activo</small>' ?></td>
                  <td class="text-center align-middle"><?= $cliente['Fecha_cancelacion'] == '' ? 'Sin cancelacion' : Utils::getDate($cliente['Fecha_cancelacion']) ?></td>
                <?php endif ?>

                <td class="text-center py-0 align-middle">
                  <div class="btn-group btn-group-sm">
                    <a href="<?= base_url ?>cliente_SA/ver&id=<?= Encryption::encode($cliente['Cliente']) ?>" class="btn btn-success mr-1">
                      <i class="fas fa-eye"></i> Ver
                    </a>
                    <button class="btn btn-orange mr-1" value="<?= Encryption::encode($cliente['Cliente']) ?>">
                      <i class="fas fa-users-cog"></i>
                    </button>

                    <button class="btn btn-secondary " value="<?= Encryption::encode($cliente['Cliente']) ?>">
                      <i class="fas fa-user-alt-slash"></i>
                    </button>
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>

          </tbody>
          <tfoot>
            <tr>
              <?= (Utils::isAdmin()) ? ' <th class="text-center">Id Cliente</th>' : ''; ?>
              <?= (Utils::isAdmin()) ? ' <th class="text-center">Id Empresa</th>' : ''; ?>
              <th class="align-middle">Fecha Ingreso</th>
              <th class="align-middle">Empresa</th>
              <th class="align-middle">Cliente</th>
              <?php if (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior() || Utils::isJunior() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor()) : ?>
                <th class="text-center align-middle">Centro de costo</th>
                <th class="text-center align-middle">Servicios del mes</th>
                <th class="text-right align-middle">Paquete</th>
                <th class="text-right align-middle">Fecha de cancelacion</th>
                <th class="text-right align-middle">Activo</th>
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
<script type="text/javascript" src="<?= base_url ?>app/RH/ModuleRH.js?v=<?= rand() ?>"></script>
<script type="text/javascript" src="<?= base_url ?>app/RH/customerrh.js?v=<?= rand() ?>"></script>
<script src="<?=base_url?>app/utils.js?v=<?=rand()?>"></script>
<script src="<?=base_url?>plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>

<script>
  $(document).ready(function() {

    let table = document.querySelector('#tb_customers');
    utils.dtTable(table);

    document.querySelector('#tb_customers').addEventListener('click', e => {
      e.preventDefault();

      if (e.target.classList.contains('btn-orange') || e.target.parentElement.classList.contains('btn-orange')) {

        document.querySelector("#modal_RH form").reset()
        document.querySelector('#modal_RH #cancelation').hidden = true
        document.querySelector('#modal_RH #package').hidden = false
        document.querySelector('#modal_RH select').required = true
        document.querySelector('#modal_RH [name="cancellation_date"]').required = false

        const customerRH = new CustomerRh();
        if (e.target.parentElement.classList.contains('btn-orange')) {
          customerRH.getOne(e.target.parentElement.value);
        } else {
          customerRH.getOne(e.target.value);
        }
        console.log(e.target);
        $('#modal_RH').modal({
          backdrop: 'static',
          keyboard: false
        });
      }

      if (e.target.classList.contains('btn-secondary') || e.target.parentElement.classList.contains('btn-secondary')) {
        document.querySelector("#modal_RH form").reset()
        document.querySelector('#modal_RH #cancelation').hidden = false
        document.querySelector('#modal_RH #package').hidden = true
        document.querySelector('#modal_RH select').required = false
        document.querySelector('#modal_RH [name="cancellation_date"]').required = true

        const customerRH = new CustomerRh();
        if (e.target.parentElement.classList.contains('btn-secondary')) {
          customerRH.getOne(e.target.parentElement.value);
        } else {
          customerRH.getOne(e.target.value);
        }
        console.log(e.target);
        $('#modal_RH').modal({
          backdrop: 'static',
          keyboard: false
        });
      }

    });




    document.querySelector('#modal_RH form').addEventListener('submit', e => {
      e.preventDefault();
      let modulo = new ModuleRH();
      modulo.save();
    });

  });
</script>