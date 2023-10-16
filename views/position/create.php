<div class="content-wrapper">
  <div class="container">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left mb-2">
              <li class="breadcrumb-item"><a href="<?= base_url ?>">Inicio</a></li>
              <li class="breadcrumb-item"><a href="<?= base_url ?>puesto/index">Puestos</a></li>
              <li class="breadcrumb-item active">Nuevo puesto</li>
            </ol>
          </div>
          <div class="col-sm-12">
            <div class="alert alert-success">
              <h4>Crear puesto</h4>
            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <form role="form" id="position-form">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title"> Descripción del Puesto</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <div class="card-body">
                  <div class="form-row">
                    <div class="form-group col-6">
                      <label for="title" class="col-form-label">Título del Puesto*</label>
                      <input type="text" name="title" maxlength="40" class="form-control" value="<?= isset($position) && is_object($position) ? $position->title : ''; ?>" required>
                    </div>
                    <div class="form-group col-5">
                      <label for="id_department" class="col-form-label">Departamento*</label>
                      <!--  <input type="text" name="id_department" id="id_department" class="form-control" value="<?= isset($position) && is_object($position) ? $position->id_department : '1'; ?>"> -->
                      <select name="id_department" id="id_department" class="form-control" required>
                        <option disabled selected value="">Selecciona departamento</option>
                        <?php foreach ($deparment as $dep) : ?>
                          <option value=" <?= Encryption::encode($dep['id']) ?>">
                            <?= $dep['department']  ?></option>
                        <?php endforeach; ?>
                      </select>

                    </div>
                    <div class=" col-1 mt-4">
                      <button class="btn btn-orange" id="btn-nuevo-deparamento">Agregar+</button>
                    </div>
                  </div>

                  <div class="form-row">
                    <div class="form-group col">
                      <label class="col-form-label" for="">Tipo de puesto</label>
                      <select name="type_position" class="form-control" required>
                        <option disabled selected value="">Selecciona tipo de puesto</option>
                        <option value="<?= Encryption::encode(1)  ?>">Gerencia</option>
                        <option value="<?= Encryption::encode(2)  ?>">Subgerencia</option>
                        <option value="<?= Encryption::encode(3)  ?>">Administrativo</option>
                        <option value="<?= Encryption::encode(4)  ?>">Supervisorios /
                          Coordinacion</option>
                        <option value="<?= Encryption::encode(5)  ?>">Operativo</option>
                      </select>
                    </div>

                    <div class="form-group col">
                      <label class="col-form-label" for="id_boss_position">Puesto al que
                        reporta</label>
                      <select name="id_boss_position" id="id_boss_position" class="form-control">
                        <option selected value="">Selecciona el puesto</option>
                        <?php foreach ($position as $post) : ?>
                          <option value=" <?= Encryption::encode($post['id']) ?>">
                            <?= $post['title']  ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>

                    <div class="form-group col">
                      <label class="col-form-label" for="">Puesto(s) que supervisa</label>
                      <select name="supervising[]" id="supervising" multiple="multiple" class="form-control select2bs4">
                        <?php foreach ($position as $post) : ?>
                          <option value=" <?= Encryption::encode($post['id']) ?>">
                            <?= $post['title']  ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>

                  </div>

                  <div class="form-row">

                    <div class="form-group col-6">
                      <label class="col-form-label" for="">Catálogo de ocupación*</label>
                      <?php $catalogo = Utils::getCatalogoOcupaciones(); ?>
                      <select name="clave_ocupacion" class="form-control select2" required>
                        <option disabled selected value="">Selecciona la ocupacion</option>
                        <?php foreach ($catalogo as $cat) : ?>
                          <option value=" <?= Encryption::encode($cat['clave']) ?>">
                            <?= $cat['descripcion']  ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                    <!-- ===[gabo 6 junio puestos]=== -->
                    <div class="form-group col-6">
                      <div class="form-group">
                        <label for="id_Cliente" class="col-form-label">Sucursal*</label>
                        <?php $contactos = Utils::getEmpresaByContacto(); ?>
                        <!-- //===[gabo 6 junio puestos]=== -->
                        <select name="id_cliente_position" id="id_cliente_position" class="form-control" required>
                          <!-- //===[gabo 6 junio puestos fin]=== -->
                          <option disabled selected value="">Selecciona comercio</option>
                          <?php foreach ($contactos as $contacto) : ?>
                            <option value="<?= $contacto['Cliente'] ?>">
                              <?= $contacto['Nombre_Cliente'] ?></option>
                          <?php endforeach ?>
                        </select>
                      </div>
                    </div>
                    <!-- ===[gabo 6 junio puestos fin]=== -->
                  </div>
                </div>
                <!-- /.card-body    -->
              </div>

              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Objetivo del Puesto</h3>
                </div>
                <div class="card-body">
                  <div class="form-group">
                    <label class="col-form-label" for="objective">Objetivo*</label>
                    <textarea class="form-control" name="objective" maxlength="4000" rows="5" required></textarea>
                  </div>
                </div>
              </div>

              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Autoridad</h3>
                </div>
                <div class="card-body">
                  <div class="form-group">
                    <label class="col-form-label" for="authority">Autoridad*</label>
                    <textarea class="form-control" name="authority" maxlength="4000" rows="5" required></textarea>
                  </div>
                </div>
              </div>


              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Perfil</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <div class="card-body">
                  <div class="form-row">
                    <div class="form-group col">
                      <label for="scholarship" class="col-form-label">Escolaridad*</label>
                      <input type="text" name="scholarship" class="form-control" maxlength="400" value="" require>
                    </div>
                    <div class="form-group col">
                      <label for="experience" class="col-form-label">Experiencia*</label>
                      <textarea class="form-control" name="experience" maxlength="4000" required></textarea>
                    </div>
                  </div>

                  <div class="form-row">
                    <div class="form-group col">
                      <label class="col-form-label" for="additional_studies">Estudios
                        adicionales</label>
                      <input type="text" name="additional_studies" class="form-control" maxlength="400" value="">
                    </div>
                    <div class="form-group col">
                      <label class="col-form-label" for="experience_years">Años de
                        eperiencia</label>
                      <input type="text" name="experience_years" class="form-control" value="">
                    </div>
                  </div>

                  <div class="form-row">
                    <div class="form-group col-6">
                      <label class="col-form-label" for="language">Idiomas</label>
                      <input type="text" name="language" class="form-control" maxlength="40" value="">
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
              </div>



              <div class="card-footer">
                <div class="form-group">
                  <a class="btn btn-info float-left" href="javascript: history.back()">Regresar</a>
                  <input type="submit" class="btn btn-success float-right" id="registrar_puesto" value="Registrar puesto">
                </div>
              </div>

            </form>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
  </div>

</div>

<script src="<?= base_url ?>app/RH/position.js?v=<?= rand() ?>"></script>
<script>
  document.querySelector('#position-form').addEventListener('submit', e => {
    e.preventDefault();
    let position = new Position();
    position.save_position();
  });

  document.querySelector('#btn-nuevo-deparamento').addEventListener('click', e => {
    e.preventDefault();
    $('#modal_department').modal({
      backdrop: 'static',
      keyboard: false
    });
  });

  document.querySelector('#modal_department form').addEventListener('submit', e => {
    e.preventDefault();
    let position = new Position();
    position.save_deparment();
  });
</script>