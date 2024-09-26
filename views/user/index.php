<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <div class="alert alert-navy">
            <h3>Usuarios</h3>
          </div>

        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <section class="content-header">
    <div class="row">
      <div class="col-sm-2 ml-auto">
        <button class="btn btn-orange float-right" data-toggle="modal" data-target="#modal-create-user">Crear
          usuario</button>
      </div>
    
    </div>
  </section>
  <br>
  <!-- Main content -->
  <section class="content">

    <div class="card">

      <div class="card-header">
        <ul class="nav nav-pills">
          <li class="nav-item">
            <a class="nav-link active" href="#tab_users_active" style="margin:0.2rem" data-toggle="tab">Usuarios Activos</a>
          </li>
          <!-- <li class="nav-item">
            <a class="nav-link" href="#tab_users_inactive" style="margin:0.2rem" data-toggle="tab">Usuarios
              Inactivos</a>
          </li> -->
        </ul>
      </div>

      <div class="card-body">
        <div class="tab-content">
          <div class="tab-pane active table-responsive" id="tab_users_active">
            <table id="tb_users" class="table table-striped">
              <thead>
                <tr>
                  <th class="text-center">Foto</th>
                  <th>Usuario</th>
                  <th>Nombre</th>
                  <th>Contraseña</th>
                  <th>Correo electrónico</th>
                  <th>Tipo</th>
                  <th class="text-right py-0 align-middle">Acciones</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($users as $user) : ?>
                  <tr>
                  <td class="image"><img class="img-circle img-fluid img-responsive elevation-2" src="<?= $user['avatar'] ?>" style="width:60px; height:auto;"></td>
                    <td><?= $user['usuario'] ?></td>
                    <td><?= $user['Nombres']. $user['Apellidos']?></td>
                    <td><?= $user['password'] ?></td>
                    <td><?= $user['Correo'] ?></td>
                    <td><?= $user['tipo_usuario'] ?></td>
    
                    <td style="display:flex;text-align:center">
                      <button class="btn btn-info" value="<?= Encryption::encode($user['id']) ?>"><i class="fas fa-pencil-alt"></i></button>
                      <button class="btn btn-danger" value="<?= Encryption::encode($user['id']) ?>"><i class="fas fa-trash-alt"></i></button>

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
                  <th>Tipo</th>
                  <th class="text-right py-0 align-middle">Acciones</th>
                </tr>
              </tfoot>
            </table>
          </div>

          <div class="tab-pane  table-responsive" id="tab_users_inactive">
            <table id="tb_users_inactive" class="table table-striped">
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
                <?php foreach ($users_inactive as $user) : ?>
                  <tr>
                    <td class="image"><img class="img-circle img-fluid img-responsive elevation-2" src="<?= $user['avatar'] ?>" style="width:60px; height:auto;"></td>
                    <td><?= $user['username'] ?></td>
                    <td><?= $user['first_name'] . ' ' . $user['last_name'] ?></td>
                    <td><?= $user['password'] ?></td>
                    <td><?= $user['email'] ?></td>
                    <td><?= $user['last_session'] ?>
                    </td>
                    <td><?= $user['user_type'] ?></td>
                    <td style="display:flex;text-align:center">

                      <button class="btn btn-success" value="<?= $user['id'] ?>"><i class="fas fa-check"></i></button>

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
        </div>
      </div>
      <!-- /.card-body -->
    </div>
  </section>
</div>


<script>
  $(document).ready(function() {
    let table = document.querySelector('#tb_users');
    utils.dtTable(table);
    let table2 = document.querySelector('#tb_users_inactive');
    utils.dtTable(table2);

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

      if (e.target.classList.contains('btn-danger') || e.target.offsetParent.classList.contains('btn-danger')) {

      

        if (e.target.offsetParent.classList.contains('btn-danger')) {
          var id = e.target.offsetParent.value
        } else {
          var id = e.target.value
        }
       

        Swal.fire({
          title: '¿Quieres desactivar esta usuario?',
          //text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#d33',
          cancelButtonColor: '#6c757d',
          cancelButtonText: 'Cancelar',
          confirmButtonText: 'Desactivar'
        }).then((result) => {
          if (result.value == true) {

            var user = new User();
            user.desactivar_usuario(id);
          }
        })
      }
    });

    document.querySelector('#tb_users_inactive').addEventListener('click', e => {
      e.preventDefault();
      if (e.target.classList.contains('btn-success') || e.target.offsetParent.classList.contains(
          'btn-success')) {
        var id = 0;
        if (e.target.offsetParent.classList.contains('btn-success')) {
          id = e.target.offsetParent.value
        } else {
          id = e.target.value
        }

        Swal.fire({
          title: '¿Estás seguro de activar a este usuario?',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Activar'
        }).then((result) => {
          if (result.value == true) {
            var user = new User();
            user.activar_usuario(id);
          }
        })



      }
    });

    document.querySelector('#modal-update-user form').addEventListener('submit', e => {
      e.preventDefault();
      user.updateUser()
    });
//manda a llamar al formulario 





  });
</script>