<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <div class="alert alert-success">
            <h3>Evaluaciones de empleados</h3>
          </div>

        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="card car-success">
      <div class="card-header">
        <h3 class="card-title">Listado de evaluaciones</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table id="tb_evaluations" class="table table-striped">
          <thead>
            <tr>
              <th class="filterhead"></th>
              <th></th>
              <th class="filterhead"></th>
              <th></th>
              <th></th>
              <th></th>
              <th></th>
              <th></th>
            </tr>
            <tr>
              <th>Evaluación</th>
              <th>Empleado</th>
              <th class="align-middle text-center">Departamento</th>
              <th class="align-middle text-center">Puesto</th>
              <th>Jefe Inmediato</th>
              <th class="align-middle text-center">Período a evaluar</th>
              <th class="align-middle text-center">Estatus</th>
              <th class="align-middle text-center">Fecha de evaluación</th>
              <th class="align-middle text-center">Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($evaluations as $evaluation) : ?>
              <tr>
                <td class="align-middle"><?= $evaluation['name'] ?></td>
                <td class="align-middle"><?= $evaluation['first_name'] . ' ' . $evaluation['surname'] . ' ' . $evaluation['last_name'] ?></td>
                <td class="align-middle text-center"><?= $evaluation['department'] ?></td>
                <td class="align-middle text-center"><?= $evaluation['title'] ?></td>
                <td class="align-middle"><?= $evaluation['first_name_boss'] . ' ' . $evaluation['surname_boss'] . ' ' . $evaluation['last_name_boss'] ?></td>
                <td class="align-middle text-center"><?= $evaluation['start_date'] . ' - ' . $evaluation['end_date'] ?></td>
                <td class="align-middle text-center"><?= $evaluation['status'] == 1 ? 'Enviada' : ($evaluation['status'] == 2 ? 'Contestada' : ($evaluation['status'] == 3 ? 'Retroalimentada' : 'Firmada')) ?></td>
                <td class="align-middle text-center"><?= Utils::getFullDate($evaluation['date_of_realization'] )?></td>
                <td class="align-middle">
                  <div class="btn-group btn-group-sm">
                    <!-- ===[gabo 15 mayo evaluaciones]=== -->
                    <?php if (Utils::isCustomerSA()) :  ?>
                      <a href="<?= base_url ?>evaluacionempleado/ver&id=<?= Encryption::encode($evaluation['id']) ?>&id_boss=<?= Encryption::encode($evaluation['id_boss']) ?>" class="btn btn-primary">
                        <i class="far fa-check-circle"></i> Evaluar
                      </a>
                      <btn class="btn btn-danger" onclick="borrar_evaluacion('<?= Encryption::encode($evaluation['id']) ?>')">
                        <i class="fas fa-trash"></i> Borrar
                      </btn>
                    <?php endif  ?>
                    <!-- ===[gabo 15 mayo evaluaciones fin]=== -->
                  </div>
                </td>
              </tr>
            <?php endforeach ?>
          </tbody>
          <tfoot>
            <tr>
              <th>Evaluación</th>
              <th>Empleado</th>
              <th class="align-middle text-center">Departamento</th>
              <th class="align-middle text-center">Puesto</th>
              <th>Jefe Inmediato</th>
              <th class="align-middle text-center">Período a evaluar</th>
              <th class="align-middle text-center">Estatus</th>
              <th class="align-middle text-center">Fecha de evaluación</th>
              <th class="align-middle text-center">Acciones</th>
            </tr>
          </tfoot>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
  </section>
</div>
<script src="<?= base_url ?>app/RH/Evaluationempoyee.js?v=<?= rand() ?>"></script>

<script>
  // ===[gabo 16 de mayo evaluaciones fin]===
  function borrar_evaluacion(id_evaluation) {

    Swal.fire({
      title: '¿Desea eliminar esta evaluación?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si',
      cancelButtonText: 'No'
    }).then((result) => {
      console.log(result);
      if (result.value == true) {

        let evaluation = new Evaluationempoyee();
        evaluation.borrar_evaluation(id_evaluation);

      }
    })
  }

  // ===[gabo 16 de mayo evaluaciones fin]===
  $(document).ready(function() {

    let table = document.querySelector('#tb_evaluations');
    utils.dtTable(table);
  });
</script>