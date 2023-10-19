<!--   ===[gabo 19 abril ver candidato]=== -->
<div class="modal fade" id="modal_experiencia_candidato">
  <div class="modal-dialog modal-lg" style="max-width:  900px!important;">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="title_modal">Nueva experiencia</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="save-experience-form" action="post">
     

        <div class="modal-body">
          <div class="card-body">

            <div class="row">
              <div class="col-md-12">
                <!-- form start -->
                <input type="hidden" id="id_experience" name="id_experience" value="">
                <input type="hidden" id="id_candidate" name="id_candidate" value="">
                <div class="card card-success div_experiences">
                  <div class="card-header">
                    <h4 class="card-title">Experiencia</h4>
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="position" class="col-form-label">Puesto</label>
                          <input type="text" name="position" id="position" class="form-control" value="" required>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="enterprise" class="col-form-label">Empresa</label>
                          <input type="text" name="enterprise" id="enterprise" class="form-control" value="" required>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="id_area" class="col-form-label">Área del puesto</label>
                          <?php $areas = Utils::showAreas(); ?>
                          <select name="id_area" id="id_area" class="form-control select2" required>
                            <option disabled selected="selected"></option>
                            <?php foreach ($areas as $area) : ?>
                              <option value="<?= $area['id'] ?>" ><?= $area['area'] ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="id_subarea" class="col-form-label">Subarea</label>
                          <select name="id_subarea" id="id_subarea" class="form-control select2" required>
                            <option disabled selected="selected"></option>

                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="id_state" class="col-form-label">Estado</label>
                          <?php $states = Utils::showStates(); ?>
                          <select name="id_state" id="id_state" class="form-control select2" required>
                            <option disabled selected="selected"></option>
                            <?php foreach ($states as $state) : ?>
                              <option value="<?= $state['id'] ?>" ><?= $state['state'] ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="id_city" class="col-form-label">Ciudad</label>
                          <select name="id_city" id="id_city" class="form-control select2" required>
                              <option disabled selected="selected"></option>
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
                              <input type="date" name="start_date" id="start_date" class="form-control" value="" required>
                            </div>
                            <div class="col-md-4">
                              <input type="date" name="end_date" id="end_date" class="form-control" value="">
                            </div>
                            <div class="col-md-4 text-center">
                              <input type="checkbox" name="still_works" id="still_works" class="form-check-input">
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
                          <input type="text" name="review" id="review" class="form-control" value="" required>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="activity1" class="col-form-label">Logro o actividad 1</label>
                          <input type="text" name="activity1" id="activity1" class="form-control" value="" required>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="activity2" class="col-form-label">Logro o actividad 2</label>
                          <input type="text" name="activity2" id="activity2" class="form-control" value="" required>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="activity3" class="col-form-label">Logro o actividad 3</label>
                          <input type="text" name="activity3" id="activity3" value="" class="form-control">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="activity4" class="col-form-label">Logro o actividad 4</label>
                          <input type="text" name="activity4" id="activity4" value="" class="form-control">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>

        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <?php if (Utils::isAdmin() || Utils::isSenior() || Utils::isRecruitmentManager()|| Utils::isCandidate()||Utils::isSenior()) : ?>
            <button class="btn btn-orange float-right" id="candidate_submit">Guardar</button>
          <?php endif; ?>
        </div>
      </form>

    </div>
  </div>
</div>

<script src="<?= base_url ?>app/experience.js?v=<?= rand() ?>"></script>
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

  document.querySelector("#still_works").onclick = function() {
    
    if (this.checked) {
      document.querySelector("#end_date").style.display = 'none';
    } else {
      document.querySelector("#end_date").style.display = 'block';
    }
  }

  document.addEventListener("DOMContentLoaded", function(event) {
    if (document.querySelector("#still_works").checked) {
      document.querySelector("#end_date").style.display = 'none';
    } else {
      document.querySelector("#end_date").style.display = 'block';
    }

    document.querySelector("#save-experience-form").onsubmit = function(e) {
      e.preventDefault();
      document.querySelector("#save-experience-form #candidate_submit").disabled = true;
      let experience = new Experience();
      if (document.querySelector("#id_experience").value != '') {
        experience.update_modal();
      } else {
        experience.create_modal();
      }

    };
  });
</script>