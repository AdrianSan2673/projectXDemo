<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12 ">
          <div class="alert <?= $_SESSION['identity']->username == 'salmaperez' ? 'alert-maroon' : 'alert-success' ?>">
            <h3>Plantilla de Puestos</h3>
          </div>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <br>
  <section class="content-header">
    <div class="row">
      <div class="col-sm-3 ml-auto">
        <div class="btn-group mr-3 text-center">
          <a href="<?= base_url ?>puesto/nuevo" class="btn btn-orange">Crear nuevo puesto</a>
        </div>
      </div>
    </div>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="card bg-transparent">
      <div class="card-header">
        <h3 class="card-title">Listado de puestos</h3>
      </div>
      <div class="card-body">
        <table id="tb_employees" class="table table-responsive table-striped table-sm" style="display: none;">
          <thead>
            <tr>
              <th class="align-middle">Puesto</th>
              <th class="align-middle">Departamento</th>
              <th class="align-middle">Empresa</th>
              <th class="align-middle">Creado</th>
              <th class="align-middle">Modiciado</th>
              <th class="align-middle">Accion</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($positions as $position) :  ?>
              <tr>
                <td class="text-center align-middle"><?= $position['title'] ?></td>
                <td class="text-center align-middle"><?= $position['department'] ?></td>
                <td class="text-center align-middle"><?= $position['Nombre_Empresa'] ?></td>
                <td class="text-center align-middle"><?= Utils::getDate($position['created_at']) ?></td>
                <td class="text-center align-middle"><?= Utils::getFullDate($position['modified_at']) ?></td>
                <td class="text-center align-middle">
                  <a href="<?= base_url ?>puesto/ver&id=<?= Encryption::encode($position['id']) ?>" class="btn btn-success">
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
<script>
  document.addEventListener('DOMContentLoaded', e => {
    let table = document.querySelector('#tb_employees');
    table.style.display = "table";
    utils.dtTable(table, true);



  })
</script>