<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <div class="alert alert-success">
                <h4>
                  <?php if (isset($_GET['id']) && !empty($experiencia)): ?>
                    <?= $experiencia->first_name.' '.$experiencia->surname.' '.$experiencia->last_name ?>
                  <?php else: ?>
                      Nueva experiencia
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
            <form id="experience-form" name="experience-form" method="POST">
              <input type="hidden" id="id" value="<?=isset($experiencia) && is_object($experiencia) ? Encryption::encode($experiencia->id) : ''?>">
              <input type="hidden" id="id_candidate" value="<?=isset($experiencia) && is_object($experiencia) ? Encryption::encode($experiencia->id_candidate) : Encryption::encode($id)?>">
              <div class="card card-success div_experiences">
                <div class="card-header">
                  <h4 class="card-title">Experiencia</h4>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="position" class="col-form-label">Puesto</label>
                        <input type="text" name="position" id="position" class="form-control" value="<?=isset($experiencia) && is_object($experiencia) ? $experiencia->position : ''?>" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="enterprise" class="col-form-label">Empresa</label>
                        <input type="text" name="enterprise" id="enterprise" class="form-control" value="<?=isset($experiencia) && is_object($experiencia) ? $experiencia->enterprise : ''?>" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="id_area" class="col-form-label">Área del puesto</label>
                        <?php $areas = Utils::showAreas();?>
                        <select name="id_area" id="id_area" class="form-control select2" required>
                            <option disabled selected="selected"></option>
                            <?php foreach ($areas as $area) : ?>
                                <option value="<?= $area['id'] ?>" <?=isset($experiencia) && is_object($experiencia) && $area['id'] == $experiencia->id_area ? 'selected' : ''; ?>><?= $area['area'] ?></option>
                            <?php endforeach; ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="id_subarea" class="col-form-label">Subarea</label>
                        <select name="id_subarea" id="id_subarea" class="form-control select2" required>
                        <?php if (isset($experiencia) && is_object($experiencia) && !empty($experiencia->id_area)): ?>
                          <?= $subareas = Utils::showSubareasByArea($experiencia->id_area);?>
                          <?php foreach ($subareas as $subarea): ?>
                            <option value="<?= $subarea['id'] ?>" <?=isset($experiencia) && is_object($experiencia) && $subarea['id'] == $experiencia->id_subarea ? 'selected' : ''; ?>><?= $subarea['subarea'] ?></option>
                          <?php endforeach ?>
                        <?php else: ?>
                          <option disabled selected="selected"></option>
                        <?php endif ?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="id_state" class="col-form-label">Estado</label>
                        <?php $states = Utils::showStates();?>
                        <select name="id_state" id="id_state" class="form-control select2" required>
                            <option disabled selected="selected"></option>
                            <?php foreach ($states as $state) : ?>
                                <option value="<?= $state['id'] ?>" <?=isset($experiencia) && is_object($experiencia) && $state['id'] == $experiencia->id_state ? 'selected' : ''; ?>><?= $state['state'] ?></option>
                            <?php endforeach; ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="id_city" class="col-form-label">Ciudad</label>
                        <select name="id_city" id="id_city" class="form-control select2" required>
                        <?php if (isset($experiencia) && is_object($experiencia) && !empty($experiencia->id_state)): ?>
                          <?= $cities = Utils::showCitiesByState($experiencia->id_state);?>
                          <?php foreach ($cities as $city): ?>
                            <option value="<?= $city['id'] ?>" <?=isset($experiencia) && is_object($experiencia) && $city['id'] == $experiencia->id_city ? 'selected' : ''; ?>><?= $city['city'] ?></option>
                          <?php endforeach ?>
                        <?php else: ?>
                          <option disabled selected="selected"></option>
                        <?php endif ?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="start_date" class="col-form-label">Periodo</label>
                        <div class="row">
                          <div class="col-md-4">
                            <input type="date" name="start_date" id="start_date" class="form-control" value="<?=isset($experiencia) && is_object($experiencia) ? $experiencia->start_date : ''?>" required>
                          </div>
                          <div class="col-md-4">
                            <input type="date" name="end_date" id="end_date" class="form-control" value="<?=isset($experiencia) && is_object($experiencia) ? $experiencia->end_date : ''?>">
                          </div>
                          <div class="col-md-4 text-center">
                            <input type="checkbox" name="still_works" id="still_works" <?=isset($experiencia) && is_object($experiencia) && $experiencia->still_works == 1 ? 'checked' : ''; ?> class="form-check-input">
                            <label for="still_works" class="form-check-label">¿Aún trabaja?</label>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="review" class="col-form-label">Breve reseña del puesto</label>
                        <input type="text" name="review" id="review" class="form-control" value="<?=isset($experiencia) && is_object($experiencia) ? $experiencia->review : ''?>" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="activity1" class="col-form-label">Logro o actividad 1</label>
                        <input type="text" name="activity1" id="activity1" class="form-control" value="<?=isset($experiencia) && is_object($experiencia) ? $experiencia->activity1 : ''?>" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="activity2" class="col-form-label">Logro o actividad 2</label>
                        <input type="text" name="activity2" id="activity2" class="form-control" value="<?=isset($experiencia) && is_object($experiencia) ? $experiencia->activity2 : ''?>" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="activity3" class="col-form-label">Logro o actividad 3</label>
                        <input type="text" name="activity3" id="activity3" value="<?=isset($experiencia) && is_object($experiencia) ? $experiencia->activity3 : ''?>" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="activity4" class="col-form-label">Logro o actividad 4</label>
                        <input type="text" name="activity4" id="activity4" value="<?=isset($experiencia) && is_object($experiencia) ? $experiencia->activity4 : ''?>" class="form-control">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <?php if (Utils::isCandidate()): ?>
                    <a href="<?=base_url?>candidato/ver" class="btn btn-secondary float-left">Regresar</a>
                  <?php else: ?>
                    <a href="<?=base_url?>candidato/ver&id=<?=isset($experiencia) && is_object($experiencia) ? Encryption::encode($experiencia->id_candidate) : $_GET['id']?>" class="btn btn-secondary float-left">Regresar</a>
                  <?php endif ?>
                  <button class="btn btn-orange float-right" id="candidate_submit">Enviar</button>
                </div>  
              </div>
              
            </form>
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
</div>
<script src="<?=base_url?>app/experience.js?v=<?=rand()?>"></script>
<script>
  document.querySelector('#id_state').onchange = function() {
    let cities = new City();
    cities.id_state = document.querySelector('#id_state').value;
    cities.selector = document.querySelector('#id_city');
    cities.getCitiesByState();
  }

  document.querySelector('#id_area').onchange = function() {
    let subarea = new Subarea();
    subarea.id_area = document.querySelector("#id_area").value;
    subarea.selector = document.querySelector("#id_subarea");
    subarea.getSubareasByArea();
  };

  document.querySelector("#still_works").onclick = function(){
    if (this.checked) {
      document.querySelector("#end_date").style.display = 'none';
    }else{
      document.querySelector("#end_date").style.display = 'block';
    }
  }

  document.addEventListener("DOMContentLoaded", function(event) {
    if (document.querySelector("#still_works").checked) {
      document.querySelector("#end_date").style.display = 'none';
    }else{
      document.querySelector("#end_date").style.display = 'block';
    }

    document.querySelector("#experience-form").onsubmit = function(e) {
      e.preventDefault();
      document.querySelector("#experience-form #candidate_submit").disabled = true;
      let experience = new Experience();
      if (document.querySelector("#id").value != '') {
        experience.update();
      }else{
        experience.create();
      }
      
    };
  });
</script>
  

