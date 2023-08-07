<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <div class="alert alert-success">
                <h4>
                  <?php if ((isset($_GET['id']) || Utils::isCandidate()) && !empty($candidato)): ?>
                    <?= $candidato->first_name.' '.$candidato->surname.' '.$candidato->last_name ?>
                  <?php else: ?>
                      Nuevo candidato
                  <?php endif ?>
                </h4>
            </div>         
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <!-- form start -->
            <form id="candidate-form" name="candidate-form" method="POST">
              <!-- general form elements -->
              <div class="card card-orange">
                <div class="card-header">
                  <h4 class="card-title">Datos personales</h4>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="first_name" class="col-form-label">Nombre(s)</label>
                            <input type="text" name="first_name" id="first_name" class="form-control" required value="<?=isset($candidato) && is_object($candidato) ? $candidato->first_name : ''; ?>">
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label for="surname" class="col-form-label">Apellido Paterno</label>
                            <input type="text" name="surname" id="surname" class="form-control" required value="<?=isset($candidato) && is_object($candidato) ? $candidato->surname : ''; ?>">
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label for="last_name" class="col-form-label">Apellido Materno</label>
                            <input type="text" name="last_name" id="last_name" class="form-control" required value="<?=isset($candidato) && is_object($candidato) ? $candidato->last_name : ''; ?>">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="date_birth" class="col-form-label">Fecha de nacimiento</label>
                            <input type="date" name="date_birth" id="date_birth" class="form-control" value="<?=isset($candidato) && is_object($candidato) ? $candidato->date_birth : ''; ?>">
                          </div>
                        </div>
                        <?php if (!Utils::isCandidate()): ?>
                        <div class="col-md-2">
                          <div class="form-group">
                            <label for="age" class="col-form-label">Edad</label>
                            <input type="number" name="age" id="age" class="form-control" value="<?=isset($candidato) && is_object($candidato) ? $candidato->age : ''; ?>" min="16" max="99">
                          </div>
                        </div>
                        <?php endif ?>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label for="gender" class="col-form-label">Sexo</label>
                            <?php $genders = Utils::showGenders(); ?>
                            <select name="id_gender" id="id_gender" class="form-control" required>
                              <option disabled selected></option>
                              <?php foreach ($genders as $gender): ?>
                                <option value="<?=$gender['id']?>" <?=isset($candidato) && is_object($candidato) && $gender['id'] == $candidato->id_gender ? 'selected' : ''; ?>><?=$gender['gender']?></option>
                              <?php endforeach ?>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label for="id_civil_status" class="col-form-label">Estado civil</label>
                            <?php $civil_status = Utils::showCivilStatus(); ?>
                            <select name="id_civil_status" id="id_civil_status" class="form-control">
                              <option value>Selecciona el estado civil</option>
                              <?php foreach ($civil_status as $status): ?>
                                <option value="<?=$status['id']?>" <?=isset($candidato) && is_object($candidato) && $status['id'] == $candidato->id_civil_status ? 'selected' : ''; ?>><?=$status['status']?></option>
                              <?php endforeach ?>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6 mx-auto">                          
                          <div class="form-group">
                            <label for="avatar" class="col-form-label">Elija una foto del candidato</label>
                            <input type="file" name="avatar" id="avatar" class="form-control" accept="image/x-png,image/gif,image/jpeg">
                          </div>
                          <div id="editor"><img src="<?=isset($route) ? $route : ''?>"></div>
                        </div>
                        <div class="col-md-6 text-center">
                          <canvas id="preview"></canvas>
                        </div>
                      </div>
                    </div>
                  </div>
                    
                </div>
              </div>
              <div class="card card-info">
                <div class="card-header">
                  <h4 class="card-title">Perfil Profesional</h4>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="id_level" class="col-form-label">Grado de estudios</label>
                        <?php $education_levels = Utils::showEducationLevels(); ?>
                        <select name="id_level" id="id_level" class="form-control" required>
                          <option value="" hidden selected>Selecciona el último grado de estudios</option>
                          <?php foreach ($education_levels as $level): ?>
                            <option value="<?=$level['id']?>" <?=isset($candidato) && is_object($candidato) && $level['id'] == $candidato->id_education_level ? 'selected' : ''; ?>><?=$level['level']?></option>
                          <?php endforeach ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="job_title" class="col-form-label">Experiencia en</label>
                        <input type="text" name="job_title" id="job_title" class="form-control" required value="<?=isset($candidato) && is_object($candidato) ? $candidato->job_title : ''; ?>">
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="description" class="col-form-label">Reseña breve</label>
                        <textarea name="description" id="description" rows="10" class="form-control"><?=isset($candidato) && is_object($candidato) ? $candidato->description : ''; ?></textarea>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="id_area" class="col-form-label">Área de interés</label>
                        <?php $areas = Utils::showAreas();?>
                        <select name="id_area" id="id_area" class="form-control" required>
                            <option value="" hidden selected>Selecciona un área</option>
                            <?php foreach ($areas as $area) : ?>
                                <option value="<?= $area['id'] ?>" <?=isset($candidato) && is_object($candidato) && $area['id'] == $candidato->id_area ? 'selected' : ''; ?>><?= $area['area'] ?></option>
                            <?php endforeach; ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="id_subarea" class="col-form-label">Subarea</label>
                        <select name="id_subarea" id="id_subarea" class="form-control" required>
                        <?php if (isset($candidato) && is_object($candidato) && !empty($candidato->id_area)): ?>
                          <?= $subareas = Utils::showSubareasByArea($candidato->id_area);?>
                          <?php foreach ($subareas as $subarea): ?>
                            <option value="<?= $subarea['id'] ?>" <?=isset($candidato) && is_object($candidato) && $subarea['id'] == $candidato->id_subarea ? 'selected' : ''; ?>><?= $subarea['subarea'] ?></option>
                          <?php endforeach ?>
                        <?php else: ?>
                          <option disabled selected="selected"></option>
                        <?php endif ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="resume" class="col-form-label">¿Adjuntar currículum personal?</label>
                        <input type="file" id="resume" name="resume" class="form-control" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel, application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/vnd.ms-powerpoint, application/vnd.openxmlformats-officedocument.presentationml.presentation, application/pdf">
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
              </div>
              <div class="card card-maroon">
                <div class="card-header">
                  <h4 class="card-title">Datos de Contacto</h4>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="telephone" class="col-form-label">Teléfono</label>
                        <input type="text" name="telephone" id="telephone" maxlength="13" class="form-control" required value="<?=isset($candidato) && is_object($candidato) ? $candidato->telephone : ''; ?>" data-inputmask='"mask": "999 999 9999"' data-mask>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="cellphone" class="col-form-label">Celular:</label>
                        <input type="text" name="cellphone" id="cellphone" maxlength="13" class="form-control" required value="<?=isset($candidato) && is_object($candidato) ? $candidato->cellphone : ''; ?>" data-inputmask='"mask": "999 999  9999"' data-mask>
                      </div>
                    </div>
                    <?php if (Utils::isCandidate()): ?>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="email" class="col-form-label">Correo electrónico</label>
                          <input type="email" name="email" id="email" readonly value="<?=$_SESSION['identity']->email?>" class="form-control" required>
                        </div>
                      </div>
                    <?php else: ?>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="email" class="col-form-label">Correo electrónico</label>
                          <input type="email" name="email" id="email" class="form-control" required value="<?=isset($candidato) && is_object($candidato) ? $candidato->email : ''; ?>">
                        </div>
                      </div>
                    <?php endif ?>
                      
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="id_state" class="col-form-label">Estado</label>
                        <?php $states = Utils::showStates();?>
                        <select name="id_state" id="id_state" class="form-control"  style="width: 100%;" required>
                            <option disabled selected="selected"></option>
                            <?php foreach ($states as $state) : ?>
                                <option value="<?= $state['id'] ?>" <?=isset($candidato) && is_object($candidato) && $state['id'] == $candidato->id_state ? 'selected' : ''; ?>><?= $state['state'] ?></option>
                            <?php endforeach; ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="id_city" class="col-form-label">Ciudad</label>
                        <select name="id_city" id="id_city" class="form-control select2bs4" style="width: 100%;" required>
                          <?php if (isset($candidato) && is_object($candidato) && !empty($candidato->id_state)): ?>
                            <?= $cities = Utils::showCitiesByState($candidato->id_state);?>
                            <?php foreach ($cities as $city): ?>
                              <option value="<?= $city['id'] ?>" <?=isset($candidato) && is_object($candidato) && $city['id'] == $candidato->id_city ? 'selected' : ''; ?>><?= $city['city'] ?></option>
                            <?php endforeach ?>
                          <?php else: ?>
                            <option disabled selected="selected"></option>
                          <?php endif ?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="linkedinn">LinkedIn</label>
                        <input type="text" name="linkedinn" id="linkedinn" class="form-control" value="<?=isset($candidato) && is_object($candidato) ? $candidato->linkedinn : ''; ?>">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="facebook">Facebook</label>
                        <input type="text" name="facebook" id="facebook" class="form-control" value="<?=isset($candidato) && is_object($candidato) ? $candidato->facebook : ''; ?>">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="instagram">Instagram</label>
                        <input type="text" name="instagram" id="instagram" class="form-control" value="<?=isset($candidato) && is_object($candidato) ? $candidato->instagram : ''; ?>">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer">
                <?php if (Utils::isCandidate()): ?>
                  <a href="<?=base_url?>candidato/ver" class="btn btn-secondary btn-lg float-left">Regresar</a>
                <?php else: ?>
                  <a href="javascript: history.back()" class="btn btn-lg btn-secondary float-left">Regresar</a>
                <?php endif ?>
                <button class="btn btn-lg btn-orange float-right" id="candidate_submit"><?=($_GET['action'] == 'crear' ? 'Crear' : 'Guardar')?></button>
              </div>
            </form>
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
</div>
<script src="<?=base_url?>app/candidate.js?v=<?=rand()?>"></script>
<script type="text/javascript" src="<?=base_url?>app/cutimage.js?v=<?=rand()?>"></script>
<script>
  document.querySelector('#id_area').onchange = function() {
    let subarea = new Subarea();
    subarea.id_area = document.querySelector("#id_area").value;
    subarea.selector = document.querySelector("#id_subarea");
    subarea.getSubareasByArea();
  };
  document.querySelector('#id_state').onchange = function() {
    let cities = new City();
    cities.id_state = document.querySelector('#id_state').value;
    cities.selector = document.querySelector('#id_city');
    cities.getCitiesByState();
  }
  
  /*document.addEventListener("DOMContentLoaded", function(event) {
    document.querySelector("#candidate-form").onsubmit = function(e) {
      e.preventDefault();
      document.querySelector("#candidate-form #candidate_submit").disabled = true;
      let candidate = new Candidate();
      if (document.querySelector("#id").value != '') {
        candidate.update();
      }else{
        candidate.create();
      }
    };
    
  });*/

  $(function () {
    $.validator.setDefaults({
      submitHandler: function () {
        document.querySelector("#candidate-form #candidate_submit").disabled = true;
        let candidate = new Candidate();
        if (document.querySelector("#id").value != '') {
          candidate.update();
        }else{
          candidate.create();
        }
      }
    });
    $('#candidate-form').validate({
      rules: {
        first_name: {
          required: true,
          minlength: 3,
        },
        surname: {
          required: true,
          minlength: 3
        },
        last_name: {
          required: true,
          minlength: 1
        },
        id_gender: {
          required: true
        },
        id_civil_status: {
          required: true
        },
        id_level: {
          required: true
        },
        job_title: {
          required: true,
          minlength: 5
        },
        id_area: {
          required: true
        },
        id_subarea: {
          required: true
        }
      },
      messages: {
        first_name: {
          required: "Ingrese su nombre, por favor",
          minlength: "Tu nombre debe tener al menos 3 caracteres"
        },
        surname: {
          required: "Ingrese su apellido paterno, por favor",
          minlength: "Tu apellido paterno debe tener al menos 3 caracteres"
        },
        last_name: {
          required: "Ingrese su apellido materno, por favor",
          minlength: "Tu apellido materno debe tener al menos 1 caracter"
        },
        id_gender: {
          required: "Seleccione su sexo"
        },
        id_civil_status: {
          required: "Seleccione su estado civil"
        },
        id_level: {
          required: "Seleccione su último grado de estudios"
        },
        job_title: {
          required: "Ingrese el puesto en el que tiene experiencia, por favor",
          minlength: "El nombre del puesto debe tener al menos 5 caracteres"
        },
        id_area: {
          required: "Seleccione su área de interés"
        },
        id_subarea: {
          required: "Seleccione su subárea de interés"
        },
        telephone: {
          required: "Su número de teléfono es requerido"
        },
        cellphone: {
          required: "Su número de celular es requerido"
        },
        email:{
          required: "Su dirección de correo electrónico es requerido",
          email: "Formato incorrecto de correo inválido. Verifíquelo por favor."
        },
        id_state: {
          required: "Es necesario que indique su estado de residencia"
        },
        id_city: {
          required: "Es necesario que indique el municipio, localidad o ciudad de residencia"
        }
      },
      errorElement: 'span',
      errorPlacement: function (error, element) {
        error.addClass('invalid-feedback');
        element.closest('.form-group').append(error);
      },
      highlight: function (element, errorClass, validClass) {
        $(element).addClass('is-invalid');
      },
      unhighlight: function (element, errorClass, validClass) {
        $(element).removeClass('is-invalid');
      }
    });
  });


  window.onload = function(){
    if (document.querySelector("#id_state").value != '' && document.querySelector("#id_city").value == '') {
      let cities = new City();
      cities.id_state = document.querySelector('#id_state').value;
      cities.selector = document.querySelector('#id_city');
      cities.getCitiesByState();
    }
  }
</script>
