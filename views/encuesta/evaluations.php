<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <div class="alert alert-success">
            <h3>Encuesta de Satisfacción de nuestros clientes</h3>
          </div>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="card car-success">
      <div class="card-header">
        <h3 class="card-title">Evaluaciones</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table id="tb_customers" class="table table-striped">
          <thead>
            <tr>
              <th class="align-middle text-center">Cliente</th>
              <th class="align-middle text-center">Evaluador</th>
              <th class="align-middle text-center">Fecha</th>
              <th class="align-middle text-center">Mes</th>
			  <th class="align-middle text-center">¿Qué tan agradable es tu experiencia con nosotros?</th>
              <th class="align-middle text-center">Promedio</th>
              <th class="align-middle text-center">Comentarios</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($evaluations as $evaluation) : ?>
              <tr>
                <td><?= $evaluation['ID_Cliente_Reclu'] == 0 ? $evaluation['Nombre_Cliente'] : $evaluation['customer'] ?></td>
                <td><?= $evaluation['first_name'] . ' ' . $evaluation['last_name'] ?></td>
                <td class="text-center"><?= Utils::getFullDate($evaluation['Fecha']) ?></td>
                <td class="text-center"><?= date("n", strtotime($evaluation['Fecha'])) ?></td>
                <td class="text-center"><?=$evaluation['Experiencia']?></td>
                <td class="text-center"><?= $evaluation['Promedio'] ?></td>
                <td><?= $evaluation['Comentarios'] ?></td>
              </tr>
            <?php endforeach; ?>

          </tbody>
          <tfoot>
           <tr>
              <th class="align-middle text-center">Cliente</th>
              <th class="align-middle text-center">Evaluador</th>
              <th class="align-middle text-center">Fecha</th>
              <th class="align-middle text-center">Mes</th>
			  <th class="align-middle text-center">¿Qué tan agradable es tu experiencia con nosotros?</th>
              <th class="align-middle text-center">Promedio</th>
              <th class="align-middle text-center">Comentarios</th>
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