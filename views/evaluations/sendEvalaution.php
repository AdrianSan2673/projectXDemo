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
              <th class="align-middle">Nombre de evalaucion</th>
              <th class="align-middle">Nombre del jefe</th>
              <th class="align-middle">Puesto</th>
              <th class="align-middle">Fecha de inicio</th>
              <th class="align-middle">Fecha de final</th>
              <th class="align-middle"></th>
            </tr>
          </thead>

          <tbody>
            <?php foreach ($evaluations_employees_index as $eva_employee) :  ?>
              <tr>
                <td class="text-center align-middle"><?= $eva_employee['name'] ?></td>
                <td class="text-center align-middle"><?= $eva_employee['fullNameBoss'] ?></td>
                <td class="text-center align-middle"><?= $eva_employee['title'] ?></td>
                <td class="text-center align-middle"><?= Utils::getDate($eva_employee['start_date']) ?></td>
                <td class="text-center align-middle"><?= Utils::getDate($eva_employee['end_date']) ?></td>
                <td class="text-center align-middle">
                  <a href="<?= base_url ?>evaluacionempleado/index&id=<?= Encryption::encode($eva_employee['id_boss']) ?>&start_date=<?= Encryption::encode($eva_employee['start_date'])?>&end_date=<?= Encryption::encode($eva_employee['end_date']) ?>" class="btn btn-success">
                    <i class="fas fa-eye"></i> Ver
                  </a>
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
  document.addEventListener('DOMContentLoaded', e => {
    let table = document.querySelector('#tb_employees');
    table.style.display = "table";
    utils.dtTable(table, true);

    /*   document.querySelector('#all_evaluation').addEventListener('click', ()=>{

          console.log(e.target);
      }) */

    document.querySelector('#modal_send_evalaution').addEventListener('submit', e => {
      e.preventDefault();
      let evaluationempoyee = new Evaluationempoyee();
      evaluationempoyee.save();
    });



    document.querySelector('#btn_send_evaluation').addEventListener('click', () => {
      $('#modal_send_evalaution').modal({
        backdrop: 'static',
        keyboard: false
      });
    })




  })
</script>