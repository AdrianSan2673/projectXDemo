<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-left mb-2">
            <li class="breadcrumb-item"><a href="<?= base_url ?>">Inicio</a></li>
            <li class="breadcrumb-item active"><?= $lbl_executives ?></li>
          </ol>
        </div>
        <div class="col-sm-12">
          <div class="alert alert-success">
            <h3><?= $lbl_executives ?></h3>
          </div>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <br>
  <!-- Main content -->
  <section class="content">
    <div class="card car-success">
      <!-- /.card-header -->
      <div class="card-body">
        <table id="tb_executes" class="table table-striped">
          <thead>
            <tr>
              <th class="text-center">Foto</th>
              <th>Usuario</th>
              <th>Nombre</th>
              <th>Correo electrónico</th>
              <?php if ($_GET['action'] == 'de_reclutamiento') : ?>
                <th class="text-center py-0 align-middle">Asignar clientes</th>
              <?php endif ?>
              <?php if ($_GET['action'] == 'de_busqueda') : ?>
                <th class="text-center py-0 align-middle">Asignar reclutadores</th>
              <?php endif ?>
              <?php if ($_GET['action'] == 'de_cuenta') : ?>
                <th class="text-center py-0 align-middle">Asignar clientes</th>
              <?php endif ?>
              <?php if ($_GET['action'] == 'de_logistica') : ?>
                <th class="text-center py-0 align-middle">Asignar ejecutivos</th>
              <?php endif ?>

              <th></th>
            </tr>
          </thead>
          <tbody id="tbody_executives">
            <?php foreach ($executives as $exec) : ?>

              <tr>
                <td class="image text-center"><img class="img-circle img-fluid img-responsive elevation-2" src="<?= $exec['avatar'] ?>" style="width:60px; height:auto;"></td>
                <td><?= $exec['username'] ?></td>
                <td><?= $exec['first_name'] . ' ' . $exec['last_name'] ?></td>
                <td><?= $exec['email'] ?></td>
                <td class="text-center py-0 align-middle">
                  <div class="btn-group btn-group-sm">

                    <?php if ($_GET['action'] == 'de_reclutamiento') : ?>
                      <a href="<?= base_url ?>ejecutivos/asignar_clientes&id=<?= $exec['id'] ?>" class="btn btn-info">
                        <i class="far fa-handshake"></i>
                      </a>
                    <?php endif ?>

                    <?php if ($_GET['action'] == 'de_busqueda') : ?>
                      <a href="<?= base_url ?>ejecutivos/asignar_reclutadores&id=<?= $exec['id'] ?>" class="btn btn-info">
                      
                        <i class="nav-icon fas fa-user-tie"></i>
                      </a>
                    <?php endif ?>

                    <?php if ($_GET['action'] == 'de_cuenta') : ?>
                      <a href="<?= base_url ?>ejecutivos_SA/asignar_clientes&user=<?= Encryption::encode($exec['id']) ?>" class="btn btn-info">
                        <i class="far fa-handshake"></i>
                      </a>
                    <?php endif ?>

                    <?php if ($_GET['action'] == 'de_logistica') : ?>
                      <a href="<?= base_url ?>ejecutivos_SA/asignar_clientes&user=<?= Encryption::encode($exec['id']) ?>" class="btn btn-info">

<!--                       <a href="<?= base_url ?>ejecutivos_SA/asignar_ejecutivos&user=<?= Encryption::encode($exec['id']) ?>" class="btn btn-info">
 -->                        <i class="nav-icon fas fa-user-tie"></i>
                      </a>
                    <?php endif ?>

                    <button class=" btn btn-danger" value="<?= Encryption::encode($exec['id']) ?>">Desactivar</button>
                  </div>

                </td>
              </tr>


            <?php endforeach; ?>

          </tbody>
          <tfoot>
            <tr>
              <th>Foto</th>
              <th>Usuario</th>
              <th>Nombre</th>
              <th>Correo electrónico</th>
              <?php if ($_GET['action'] == 'de_reclutamiento') : ?>
                <th class="text-center py-0 align-middle">Asignar clientes</th>
              <?php endif ?>
              <?php if ($_GET['action'] == 'de_busqueda') : ?>
                <th class="text-center py-0 align-middle">Asignar reclutadores</th>
              <?php endif ?>
              <?php if ($_GET['action'] == 'de_cuenta') : ?>
                <th class="text-center py-0 align-middle">Asignar clientes</th>
              <?php endif ?>
              <?php if ($_GET['action'] == 'de_logistica') : ?>
                <th class="text-center py-0 align-middle">Asignar ejecutivos</th>
              <?php endif ?>
            </tr>
          </tfoot>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
  </section>
</div>

<script type="text/javascript" src="<?= base_url ?>app/Ejecutivo_plaza.js?v=<?= rand() ?>"></script>

<script>
  document.addEventListener('DOMContentLoaded', e => {
    /* let table = document.querySelector('#tb_executes');
    table.style.display = "table";
    utils.dtTable(table, true);
 */




    document.querySelector('#tbody_executives').addEventListener('click', function(e) {
      if (e.target.classList.contains('btn-danger') ) {
       // let nombre_ejecutivo = document.querySelector('#nombre_ejecutivo').textContent

        Swal.fire({
          title: '¿Quieres eliminar esta ejecutivo?',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#d33',
          cancelButtonColor: '#6c757d',
          cancelButtonText: 'Cancelar',
          confirmButtonText: 'Eliminar'
        }).then((result) => {
          if (result.value == true) {
            let ep = new Ejecutivo_plaza();
            ep.desactivar_ejecutivoSA(e.target.value);
            e.preventDefault();
          }
        })


      }
    })

  })
</script>