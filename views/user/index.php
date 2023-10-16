<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <div class="alert alert-success">
            <h3>Usuarios</h3>
          </div>

        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <section class="content-header">
    <div class="row">
      <div class="col-sm-2 ml-auto">
        <button class="btn btn-orange float-right" data-toggle="modal" data-target="#modal-create-user">Crear usuario</button>
      </div>
    </div>
  </section>
  <br>
  <!-- Main content -->
  <section class="content">
    <div class="card car-success">
      <div class="card-header">
        <h3 class="card-title">Listado de usuarios</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table id="tb_users" class="table table-striped">
          <thead>
            <tr>
              <th class="text-center">Foto</th>
              <th>Usuario</th>
              <th>Nombre</th>
              <th>Contraseña</th>
              <th>Correo electrónico</th>
              <th>Última sesión</th>
              <th>Tipo</th>
              <th class="text-right py-0 align-middle">Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($users as $user) : ?>
              <tr>
                <td class="image"><img class="img-circle img-fluid img-responsive elevation-2" src="<?= $user['avatar'] ?>" style="width:60px; height:auto;"></td>
                <td><?= $user['username'] ?></td>
                <td><?= $user['first_name'] . ' ' . $user['last_name'] ?></td>
                <td><?= Utils::decrypt($user['password']) ?></td>
                <td><?= $user['email'] ?></td>
                <td><?= $last_session = $user['last_session'] != NULL ? Utils::getFullDate($user['last_session']) : '' ?></td>
                <td><?= $user['user_type'] ?></td>
                <td class="text-right py-0 align-middle">
                  <div class="btn-group btn-group-sm">
                    <button class="btn btn-info" value="<?= Encryption::encode($user['id']) ?>"><i class="fas fa-pencil-alt"></i></button>
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>

          </tbody>
          <tfoot>
            <tr>
             <th class="text-center">Foto</th>
              <th>Usuario</th>
              <th>Nombre</th>
              <th>Contraseña</th>
              <th>Correo electrónico</th>
              <th>Última sesión</th>
              <th>Tipo</th>
              <th class="text-right py-0 align-middle">Acciones</th>
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
    let table = document.querySelector('#tb_users');
    utils.dtTable(table);

    var user = new User();

    document.querySelector('#tb_users').addEventListener('click', e => {
      e.preventDefault();
      if (e.target.classList.contains('btn-info') || e.target.offsetParent.classList.contains('btn-info')) {
        if (e.target.offsetParent.classList.contains('btn-info')) {
          user.getUser(e.target.offsetParent.value)
        } else {
          user.getUser(e.target.value)
        }

        $('#modal-update-user').modal({
          backdrop: 'static',
          keyboard: false
        });
      }
    });


    document.querySelector('#modal-update-user form').addEventListener('submit', e => {
      e.preventDefault();
      user.updateUser()
    });






  });
</script>