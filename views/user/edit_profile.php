<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <div class="alert alert-success">
                <h3>Perfil</h3>
            </div>         
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-4">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                  src="<?=$_SESSION['avatar']?>"
                       alt="User profile picture">
                </div>
                <h3 class="profile-username text-center"><?=$_SESSION['identity']->first_name.' '. $_SESSION['identity']->last_name?></h3>

                <p class="text-muted text-center"><?=$_SESSION['identity']->user_type?></p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <strong><i class="fas fa-user"></i> Usuario</strong>
                    <p class="text-muted"><?=$_SESSION['identity']->username?></p>
                  </li>
                  <li class="list-group-item">
                    <strong><i class="fas fa-envelope"></i> Correo electrónico</strong>
                    <p class="text-muted"><?=$_SESSION['identity']->email?></p>
                  </li>
                  <li class="list-group-item">
                    <b>Miembro desde </b>
                    <p class="text-muted"><?=Utils::getFullDate($_SESSION['identity']->created_at)?></p>
                  </li>
                </ul>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-8">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#profile" data-toggle="tab">Mi perfil</a></li>
                  <li class="nav-item"><a class="nav-link" href="#account" data-toggle="tab">Cuenta</a></li>
                  <li class="nav-item"><a class="nav-link" href="#photo" data-toggle="tab">Fotografía</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="profile">
                    <div class="row">
                      <form action="./update" method="post" class="col-md-12">
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <label for="" class="col-form-label">Nombre(s)</label>
                              <input type="text" name="first_name" id="first_name" class="form-control" value="<?=$first_name?>">
                            </div>
                          </div>
                        </div>
                        <?php if (!Utils::isCandidate()): ?>
                          <div class="row">
                            <div class="col-md-12">
                              <div class="form-group">
                                <label for="last_name" class="col-form-label">Apellidos</label>
                                <input type="text" name="last_name" id="last_name" class="form-control" value="<?=$last_name?>">
                              </div>
                            </div>
                          </div>
                        <?php else: ?>
                          <div class="row">
                            <div class="col-md-12">
                              <div class="form-group">
                                <label for="surname" class="col-form-label">Apellido paterno</label>
                                <input type="text" name="surname" id="surname" class="form-control" value="<?=$surname?>">
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-12">
                              <div class="form-group">
                                <label for="last_name" class="col-form-label">Apellido materno</label>
                                <input type="text" name="last_name" id="last_name" class="form-control" value="<?=$last_name?>">
                              </div>
                            </div>
                          </div>
                        <?php endif ?>
                        
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <input type="submit" value="Editar" class="btn btn-orange">
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="account">
                    <div class="row">
                      <h6>Cambiar contraseña</h6><br>
                      <form action="" id="form-password" class="col-md-12">
                        <div class="form-group">
                          <label for="password" class="col-form-label">Contraseña actual</label>
                          <input type="password" name="password" id="password" class="form-control" placeholder="Escribe tu contraseña actual">
                        </div>
                        <div class="form-group">
                          <label for="new_password" class="col-form-label">Contraseña nueva</label>
                          <input type="password" name="new_password" id="new_password" class="form-control" placeholder="Escribe tu nueva contraseña">
                        </div>
                        <div class="form-group">
                          <label for="confirm_new_password" class="col-form-label">Confirmar nueva contraseña</label>
                          <input type="password" name="confirm_new_password" id="confirm_new_password" class="form-control" placeholder="Escribe de nuevo tu nueva contraseña">
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <input type="button" value="Cambiar contraseña" id="submit_password" class="btn btn-orange">
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="photo">
                    <div class="row">
                      <form method="post" id="form_image" enctype="multipart/form-data">
                        <div class="col-md-8 mx-auto">
                          <!--  -->
                          <div id="editor"><img src="<?=$_SESSION['avatar_route']?>"></div>
                        </div>
                        <div class="form-group">
                          <label for="avatar" class="col-form-label">Elija una foto de perfil</label>
                          
                          <input type="file" name="avatar" id="avatar" class="form-control" accept="image/x-png,image/gif,image/jpeg">
                        </div>
                        <div class="col-md-8">
                          <canvas id="preview"></canvas>
                        </div>
                        <div class="form-group">
                          <input type="button" id="submit" value="Cambiar foto" class="btn btn-orange">
                        </div>
                      </form>
                    </div>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <script type="text/javascript" src="<?=base_url?>app/cutimage.js?v=<?=rand()?>"></script>
  <script>
    document.addEventListener("DOMContentLoaded", function(event) {
      //utils.previewImage(document.querySelector('#avatar'));
      var submit = document.querySelector('#submit');
      submit.disabled = true;

      submit.addEventListener('click', function(){
        let image = new Image();
        image.upload_image64();
      });

      document.querySelector("#avatar").addEventListener('change', function(){
        submit.disabled = false;
      });

      document.querySelector("#submit_password").addEventListener('click', function(e){
        e.preventDefault();
        let account = new Account();
        account.change_password();
      });
    });
  </script>