<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <div class="alert <?= $_SESSION['identity']->username == 'salmaperez' ? 'alert-maroon' : 'alert-success' ?>">
            <h3>Plantilla de Capacitaciones</h3>
          </div>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <br>
 
  <!-- Main content -->
  <section class="content">
    <div class="card bg-transparent">
      <div class="card-header">
        <h3 class="card-title">Listado de capacitaciones</h3>
      </div>

      <div class="card-body">
        <div class="row">
          <div class="col-sm-2 ml-auto">
            <div class="btn-group mr-3 text-center">
              <button class="btn btn-orange" id="btn-nuevo-capacitacion">Crear capacitacion </button>
            </div>
          </div>
        </div>
        <table id="tb_employees" class="table table-responsive table-striped table-sm" style="display: none;">
          <thead>
            <tr>
              <th class="align-middle text-center">Nombre de la capacitacion</th>
              <th class="align-middle text-center">Área temarica</th>
              <th class="align-middle text-center">Descripcion</th>
              <th class="align-middle text-center">Horas</th>
              <th class="align-middle text-center">Empresa contratante</th>
              <th class="align-middle text-center">Fecha de inicio</th>
              <th class="align-middle text-center">Fecha final</th>
              <th class="align-middle text-center">Fecha de modificacion</th>
              <th class="align-middle text-center">Accion</th>
            </tr>
          </thead>

          <tbody id="tboodyTraining">
            <?php foreach ($trainings as $tra) : ?>
              <tr>
                <td class=" align-middle text-center"><?= $tra['title']  ?></td>
                <td class=" align-middle text-center"><?= Utils::showAreasTematicas($tra['clave_area_tematica']) ?></td>
                <td class=" align-middle text-center"><?= $tra['description']  ?></td>
                <td class=" align-middle text-center"><?= $tra['hours'] . ' hrs' ?></td>
                <td class=" align-middle text-center"><?= $tra['nombre_cliente']  ?></td>
                <td class=" align-middle text-center"><?= Utils::getDate($tra['start_date'])  ?></td>
                <td class=" align-middle text-center"><?= Utils::getDate($tra['end_date'])  ?></td>
                <td class=" align-middle text-center"><?= Utils::getFullDate($tra['modified_at'])  ?></td>
                <td class=" align-middle text-center">
                  <a href="<?= base_url ?>capacitaciones/ver&id=<?= Encryption::encode($tra['id']) ?>" target="_blank" class="btn btn-success">
                    <i class="fas fa-eye"></i>
                  </a>
                  <button class="btn btn-info" value="<?= Encryption::encode($tra['id'])  ?>"><i class="fas fa-edit"></i></button>
                  <button class="btn btn-danger text-bold" value="<?= Encryption::encode($tra['id'])  ?>">X</button>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>

        </table>

      </div>
      <!-- /.card-body -->
    </div>
  </section>
</div>

<script type="text/javascript" src="<?= base_url ?>app/RH/training.js?v=<?= rand() ?>"></script>

<script>
  document.addEventListener('DOMContentLoaded', e => {
    let table = document.querySelector('#tb_employees');
    table.style.display = "table";
    utils.dtTable(table, true);

    var training = new Training();

    document.querySelector('#btn-nuevo-capacitacion').addEventListener('click', e => {
      e.preventDefault();
      document.querySelector("#modal_create_training form").reset()
      $("#modal_create_training #select_integrantes").val([]).change();

      document.querySelector('#modal_create_training [name="flag"]').value = 1


      $('#modal_create_training').modal({
        backdrop: 'static',
        keyboard: false
      });
    });

    document.querySelector('#modal_create_training form').addEventListener('submit', e => {
      e.preventDefault();
      training.save();
    });

    document.querySelector('#tboodyTraining').addEventListener('click', function(e) {
      if (e.target.classList.contains('btn-info') || e.target.offsetParent.classList.contains('btn-info')) {
        if (e.target.offsetParent.classList.contains('btn-info')) {
          training.getTraining(e.target.offsetParent.value)
        } else {
          training.getTraining(e.target.value)
        }

        document.querySelectorAll('#modal_create_training input')[6].value = 2
        $('#modal_create_training').modal({
          backdrop: 'static',
          keyboard: false
        });
      }

      if (e.target.classList.contains('btn-danger') || e.target.offsetParent.classList.contains('btn-denger')) {
        Swal.fire({
          title: '¿Quieres eliminar esta capacitacion?',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#d33',
          cancelButtonColor: '#6c757d',
          cancelButtonText: 'Cancelar',
          confirmButtonText: 'Eliminar'
        }).then((result) => {
          if (result.value == true) {
            training.deleteTraing(e.target.value)

          }
        })
      }
    })

  })
</script>