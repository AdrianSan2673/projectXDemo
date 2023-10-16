<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <div class="alert alert-success">
            <h3>Evaluaciones</h3>
          </div>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <section class="content-header">
    <div class="row">
      <div class="col-sm-2 ml-auto">
        <button class="btn btn-orange float-right" id="btn_send_evaluation">Enviar evaluacion</button>
      </div>
    </div>
  </section>

  <section class="content">
    <div class="card bg-transparent">
      <div class="card-header">
        <h3 class="card-title">Listado </h3>
      </div>

      <div class="card-body" id="all_evaluation">

        <table id="tb_employees" class="table table-responsive table-striped table-sm" style="display: none;">
          <thead>
            <tr>
              <th class="text-center">Nombre de evalaucion</th>
              <th class="text-center">Fecha de Creación</th>
              <th class="text-center">Nombre del jefe</th>
              <th class="text-center">Puesto</th>
              <th class="text-center">Fecha de inicio</th>
              <th class="text-center">Fecha de final</th>
              <th class="text-center"></th>
            </tr>
          </thead>

          <tbody id="body_table_sendEvaluation">
            <?php foreach ($groups as $group) :  ?>
              <tr>
                <td class="text-center align-middle"><?= $group['name'] ?></td>
                <td class="text-center align-middle"><?= Utils::getDate($group['created_at']) ?></td>
                <td class="text-center align-middle"><?= $group['fullNameBoss'] ?></td>
                <td class="text-center align-middle"><?= $group['title'] ?></td>
                <td class="text-center align-middle"><?= Utils::getDate($group['start_date']) ?></td>
                <td class="text-center align-middle"><?= Utils::getDate($group['end_date']) ?></td>
                <td class="text-center align-middle">

                  <a href="<?= base_url ?>evaluacionempleado/index2&id_group=<?= Encryption::encode($group['id_group']) ?>" class="btn btn-success">
                    <i class="fas fa-eye"></i> Ver
                  </a>
                  <btn class="btn btn-danger" onclick="delete_group('<?= Encryption::encode($group['id_group']) ?>')">
                    <i class="fas fa-trash"></i> Borrar
                  </btn>

                </td>
              </tr>
            <?php endforeach;
            ?>
          </tbody>
        </table>

      </div>
      <!-- /.card-body -->
    </div>
  </section>
</div>

<script src="<?= base_url ?>app/RH/evaluations.js?v=<?= rand() ?>"></script>
<script src="<?= base_url ?>app/RH/Evaluationempoyee.js?v=<?= rand() ?>"></script>

<script type="text/javascript">
  function delete_group(id_group) {

    Swal.fire({
      title: '¿Desea eliminar este grupo?',
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
        evaluation.delete_group(id_group);

      }
    })
  }

  document.addEventListener('DOMContentLoaded', e => {
    let table = document.querySelector('#tb_employees');
    table.style.display = "table";
    utils.dtTable(table, true);


    document.querySelector('#modal_send_evalaution').addEventListener('submit', e => {
      e.preventDefault();
      let evaluationempoyee = new Evaluationempoyee();
      evaluationempoyee.save2();
    });



    document.querySelector('#btn_send_evaluation').addEventListener('click', () => {
      $('#modal_send_evalaution').modal({
        backdrop: 'static',
        keyboard: false
      });
    })

  })
</script>