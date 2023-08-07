<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-left mb-2">
            <li class="breadcrumb-item"><a href="<?= base_url ?>">Inicio</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url ?><?= $_GET['controller'] == 'ejecutivos' ? 'ejecutivos/de_reclutamiento' : ($_GET['controller'] == 'ejecutivos_SA' ? 'ejecutivos_SA/de_cuenta' : '') ?>"><?= $_GET['controller'] == 'ejecutivos' ? 'Ejecutivos de reclutamiento' : ($_GET['controller'] == 'ejecutivos_SA' ? 'Ejecutivos de cuenta' : '') ?></a></li>
            <li class="breadcrumb-item active">Clientes de <?= ' <b>' . $ejecutivo->first_name . ' ' . $ejecutivo->last_name . '</b>' ?></li>
          </ol>
        </div>
        <div class="col-sm-12">
          <div class="alert alert-success">
            <h3 id="nombre_ejecutivo">Clientes asignados a <?= $ejecutivo->first_name . ' ' . $ejecutivo->last_name ?></h3>
          </div>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <br>
  <!-- Main content -->
  <section class="content">
    <div class="card car-success">
      <div class="card-header">
        <h3 class="card-title">Listado de clientes</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <div class="row">
          <div class="col-md-8">
            <div class="form-group">
              <label for="customer" class="col-form-label">Empresa</label>
              <select name="customer" id="customer" class="form-control select2" required>
                <option disabled selected value="">Selecciona empresa</option>

                <?php if ($_GET['controller'] == 'ejecutivos') : ?>
                  <?php foreach ($unassigned_customers as $customer) : ?>
                    <option value="<?= Encryption::encode($customer['id']) ?>"><?= $customer['customer'] ?></option>
                  <?php endforeach ?>
                <?php endif ?>

                <?php if ($_GET['controller'] == 'ejecutivos_SA') : ?>
                  <?php foreach ($unassigned_customers as $customer) : ?>
                    <option value="<?= Encryption::encode($customer['Cliente']) ?>"><?= $customer['Nombre_Cliente'] . ' - ' . $customer['Centro_Costos'] ?></option>
                  <?php endforeach ?>
                <?php endif ?>

              </select>
              <input type="hidden" id="recruiter" value="<?= Encryption::encode($ejecutivo->id) ?>">
            </div>
          </div>
          <div class="col-md-4 align-middle text-center">
            <div class="form-group">
              <button type="submit" class="btn btn-success" id="btn_assign_customer">Asignar cliente</button>
            </div>
          </div>
        </div>





        <table id="tb_customers" class="table table-striped">
          <?php if ($_GET['controller'] == 'ejecutivos') : ?>
            <thead>
              <tr>
                <th>Cliente</th>
                <th>Alias</th>
                <th>Centro de costo</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($recruiter_customers as $customer) : ?>
                <tr>
                  <td><?= $customer['customer'] ?></td>
                  <td><?= $customer['alias'] ?></td>
                  <td><?= $customer['cost_center'] ?></td>
                  <td class="text-center py-0 align-middle">
                    <div class="btn-group btn-group-sm">
                      <a href="<?= base_url ?>ejecutivos/delete_recruiter_customer&id_recruiter=<?= $_GET['id'] ?>&id_customer=<?= $customer['id'] ?>" class="btn btn-danger"><i class="fas fa-times"></i>
                      </a>
                    </div>

                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
            <tfoot>
              <tr>
                <th>Cliente</th>
                <th>Alias</th>
                <th>Centro de costo</th>
                <th></th>
              </tr>
            </tfoot>
          <?php endif ?>



            <?php if ($_GET['controller'] == 'ejecutivos_SA') : ?>
            <thead>
              <tr>
                <th>Cliente</th>
                <th>Centro de costo</th>
                <th></th>
                <th>Ene</th>
                <th>Feb</th>
                <th>Mar</th>
                <th>Abr</th>
                <th>May</th>
                <th>Jun</th>
                <th>Jul</th>
                <th>Ago</th>
                <th>Sep</th>
                <th>Oct</th>
                <th>Nov</th>
                <th>Dic</th>
              </tr>
            </thead>
            <tbody id="tbody_customers">
              <?php foreach ($recruiter_customers as $customer) : ?>
                <tr>
                  <td><?= $customer['Nombre_Cliente'] ?></td>
                  <td><?= $customer['Centro_Costos'] ?></td>
                  <td class="text-center py-0 align-middle">
                    <div class="btn-group btn-group-sm">
                      <button value="<?= Encryption::encode($customer['ID'])  ?>" class="btn btn-danger text-bold">X</button>
                    </div>
                  </td>
                  <?php $Estudios = Utils::estudiosPorCliente(2023, $customer['Cliente']); ?>
                  <td><?= isset($Estudios->No_FIN_Ene) ? $Estudios->No_FIN_Ene : '0' ?></td>
                  <td><?= isset($Estudios->No_FIN_Feb) ? $Estudios->No_FIN_Feb : '0' ?></td>
                  <td><?= isset($Estudios->No_FIN_Mar) ? $Estudios->No_FIN_Mar : '0' ?></td>
                  <td><?= isset($Estudios->No_FIN_Abr) ? $Estudios->No_FIN_Abr : '0' ?></td>
                  <td><?= isset($Estudios->No_FIN_May) ? $Estudios->No_FIN_May : '0' ?></td>
                  <td><?= isset($Estudios->No_FIN_Jun) ? $Estudios->No_FIN_Jun : '0' ?></td>
                  <td><?= isset($Estudios->No_FIN_Jul) ? $Estudios->No_FIN_Jul : '0' ?></td>
                  <td><?= isset($Estudios->No_FIN_Ago) ? $Estudios->No_FIN_Ago : '0' ?></td>
                  <td><?= isset($Estudios->No_FIN_Sep) ? $Estudios->No_FIN_Sep : '0' ?></td>
                  <td><?= isset($Estudios->No_FIN_Oct) ? $Estudios->No_FIN_Oct : '0' ?></td>
                  <td><?= isset($Estudios->No_FIN_Nov) ? $Estudios->No_FIN_Nov : '0' ?></td>
                  <td><?= isset($Estudios->No_FIN_Dic) ? $Estudios->No_FIN_Dic : '0' ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
            <tfoot>
              <tr>
                <th>Cliente</th>
                <th>Centro de costo</th>
                <th></th>
                <th>Ene</th>
                <th>Feb</th>
                <th>Mar</th>
                <th>Abr</th>
                <th>May</th>
                <th>Jun</th>
                <th>Jul</th>
                <th>Ago</th>
                <th>Sep</th>
                <th>Oct</th>
                <th>Nov</th>
                <th>Dic</th>
              </tr>
            </tfoot>
          <?php endif ?>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
  </section>
</div>

<?php if ($_GET['controller'] == 'ejecutivos') : ?>
  <script type="text/javascript" src="<?= base_url ?>app/recruitercustomers.js?v=<?= rand() ?>"></script>
  <script>
    $(document).ready(function() {
      let table = document.querySelector('#tb_customers');
      utils.dtTable(table);

      document.querySelector("#btn_assign_customer").onclick = function(e) {
        let rc = new RecruiterCustomer();
        rc.save();
        e.preventDefault();
      };
    });
  </script>
<?php endif ?>

<?php if ($_GET['controller'] == 'ejecutivos_SA') : ?>
  <script type="text/javascript" src="<?= base_url ?>app/Ejecutivo_plaza.js?v=<?= rand() ?>"></script>

  <script>
    $(document).ready(function() {
      let table = document.querySelector('#tb_customers');
      utils.dtTable(table);

      document.querySelector("#btn_assign_customer").onclick = function(e) {
        let ep = new Ejecutivo_plaza();
        ep.save();
        e.preventDefault();
      };


      document.querySelector('#tbody_customers').addEventListener('click', function(e) {

        if (e.target.classList.contains('btn-danger') || e.target.offsetParent.classList.contains('btn-info')) {
          let nombre_ejecutivo = document.querySelector('#nombre_ejecutivo').textContent
          let ep = new Ejecutivo_plaza();

          Swal.fire({
            title: '¿Quieres eliminar esta cliente al ejecutivo?',
            text: "El ejecutivo actual es " + nombre_ejecutivo,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Eliminar'
          }).then((result) => {
            if (result.value == true) {
              let ep = new Ejecutivo_plaza();
              ep.delete(e.target.value);
              e.preventDefault();
            }
          })


        }
      })

    });
  </script>
<?php endif ?>