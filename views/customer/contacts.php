<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left mb-2">
              <li class="breadcrumb-item"><a href="<?=base_url?>">Inicio</a></li>
              <li class="breadcrumb-item"><a href="<?=base_url?>cliente/index">Clientes</a></li>
              <li class="breadcrumb-item active">Contactos</li>
            </ol>
          </div>
          <div class="col-sm-12">
            <div class="alert alert-success">
                <h3>Contactos</h3>
            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <br>
    <!-- Main content -->
    <section class="content">
        <div class="card">
            <div class="card-header">
              <h3 class="card-title">Listado de contactos</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="tb_users" class="table table-striped">
                <thead>
                    <tr>
                      <th class="text-center">Foto</th>
                      <th>Nombre</th>
                      <th>Puesto</th>
                      <th>Cliente</th>
                      <th>Correo electrónico</th>
                      <th>Teléfono</th>
                      <th>Extensión</th>
                      <th>Celular</th>
                      <th>Usuario</th>
                      <th>Contraseña</th>
                      <th></th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($users as $user): ?>
                    <tr>
                        <td class="image"><img class="img-circle img-fluid img-responsive elevation-2" src="<?=$user['avatar']?>" style="width:60px; height:auto;"></td>
                        <td><?=$user['first_name'].' '.$user['last_name']?></td>
                        <td><?=$user['position']?></td>
                        <td><?=$user['customer']?></td>
                        <td><?=$user['email']?></td>
                        <td><?=$user['telephone']?></td>
                        <td><?=$user['extension']?></td>
                        <td><?=$user['cellphone']?></td>
                        <td><?=$user['username']?></td>
                        <td><?=$user['password'] ? Utils::decrypt($user['password']) : ''?></td>
                        <?php if (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior()): ?>
                            <td class="text-center py-0 align-middle">
                                <a href="<?=base_url?>clientecontacto/editar&id=<?=Encryption::encode($user['id'])?>" class="btn btn-info">
                                  <i class="fas fa-pencil-alt"></i> Editar
                                </a>
                              </div>
                            </td>
                        <?php endif ?>
                    </tr>
                <?php endforeach; ?>
                    
                </tbody>
                <tfoot>
                    <tr>
                      <th class="text-center">Foto</th>
                      <th>Nombre</th>
                      <th>Puesto</th>
                      <th>Cliente</th>
                      <th>Correo electrónico</th>
                      <th>Teléfono</th>
                      <th>Extensión</th>
                      <th>Celular</th>
                      <th>Usuario</th>
                      <th>Contraseña</th>
                      <th></th>
                    </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
        </div>
    </section>       
</div>
<script>
  $(document).ready(function(){
    let table = document.querySelector('#tb_users');
    utils.dtTable(table);
  });
</script>