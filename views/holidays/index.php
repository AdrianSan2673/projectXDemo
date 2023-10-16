<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <div class="alert <?= $_SESSION['identity']->username == 'salmaperez' ? 'alert-maroon' : 'alert-success' ?>">
            <h3>Control de Vacaciones</h3>
          </div>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <br>
  <section class="content-header">
    <div class="row">
      <div class="col-sm-2 ml-auto">
        <button class="btn btn-orange float-right" id="btn_new_holidays">Crear Solicitud</button>
      </div>
    </div>
  </section>
  <section class="content">
    <div class="card bg-transparent">
      <div class="card-header">
        <ul class="nav nav-pills">
            <li class="nav-item">
                <a class="nav-link active" href="#tab_1" data-toggle="tab">Control de Vacaciones</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#tab_2" data-toggle="tab">Vacaciones solicitadas</a>
            </li>
        </ul>
      </div>
      <div class="card-body">
        <div class="tab-content">
          <div class="tab-pane active" id="tab_1">
            <table id="tb_employees" class="table table-responsive table-striped table-sm" style="display: none;">
              <thead>
                <tr>
                  <th class="align-middle">Nombre</th>
                  <th class="align-middle text-center">Fecha de Ingreso</th>
                  <th class="align-middle text-center">Antigüedad (años)</th>
                  <th class="align-middle text-center">Días a disfrutar</th>
                  <th class="align-middle text-center">Días disponibles</th>
                  <th class="align-middle text-center">Fecha a vencer</th>
                </tr>
              </thead>

              <tbody>
                <?php foreach ($employees as $employee) : ?>
                  <tr>
                    <td class="align-middle text-bold"><?= $employee['first_name'] . ' ' . $employee['surname'] . ' ' . $employee['last_name'] ?></td>
                    <td class="text-center align-middle"><?= $employee['start_date'] ?></td>
                    <td class="text-center align-middle"><?= $employee['years']  ?></td>
                    <td class="text-center align-middle"><?= $employee['holidays_by_year']  ?></td>
                    <td class="text-center align-middle"><?= $employee['holidays_by_year'] - $employee['taken_holidays'] ?></td>
                    <td class="text-center align-middle"><?= ($employee['due_date']) ?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
              <tfoot>
                <tr>
                  <th class="align-middle">Nombre</th>
                  <th class="align-middle text-center">Fecha de Ingreso</th>
                  <th class="align-middle text-center">Antigüedad (años)</th>
                  <th class="align-middle text-center">Días a disfrutar</th>
                  <th class="align-middle text-center">Días disponibles</th>
                  <th class="align-middle text-center">Fecha a vencer</th>
                </tr>
              </tfoot>
            </table>
          </div>
          <div class="tab-pane" id="tab_2">
            <table id="tb_holidays" class="table table-responsive table-striped table-sm" style="display: none;">
              <thead>
                <tr>
                  <th class="align-middle">Nombre</th>
                  <th class="align-middle text-center">Del</th>
                  <th class="align-middle text-center">Al</th>
                  <th class="align-middle text-center">Días solicitados</th>
                  <th class="align-middle text-center">Días disponibles</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($holidays as $holiday): ?>
                  <tr>
                    <td class="align-middle text-bold"><?= $holiday['first_name'] . ' ' . $holiday['surname'] . ' ' . $holiday['last_name'] ?></td>
                    <td class="text-center align-middle"><?= $holiday['start_date'] ?></td>
                    <td class="text-center align-middle"><?= $holiday['end_date']  ?></td>
                    <td class="text-center align-middle"><?= $holiday['days']  ?></td>
                    <td class="text-center align-middle"><?= $holiday['holidays_by_year'] - $holiday['taken_holidays'] ?></td>
                  </tr>
                <?php endforeach ?>
              </tbody>
              <tfoot>
                <tr>
                  <th class="align-middle">Nombre</th>
                  <th class="align-middle text-center">Del</th>
                  <th class="align-middle text-center">Al</th>
                  <th class="align-middle text-center">Días solicitados</th>
                  <th class="align-middle text-center">Días disponibles</th>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
      </div>
      <!-- /.card-body -->
    </div>
  </section>
</div>
<script>
  document.addEventListener('DOMContentLoaded', e => {
    let table = document.querySelector('#tb_employees');
    table.style.display = "table";
    utils.dtTable(table, true);

    let table2 = document.querySelector('#tb_holidays');
    table2.style.display = 'table';
    utils.dtTable(table2, true);

    document.querySelector('#btn_new_holidays').addEventListener('click', e => {
      e.preventDefault();
      document.querySelector("#modal_create_holidays form").reset();
      $('#modal_create_holidays').modal({
        backdrop: 'static',
        keyboard: false
      });
    });

  })
</script>