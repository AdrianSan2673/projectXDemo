<!--   ===[gabo 19 abril ver candidato]=== -->
<div class="modal fade" id="modal_educacion_candidato">
  <div class="modal-dialog modal-lg" style="max-width:  900px!important;">
    <div class="modal-content">

      <div class="modal-header">
        <h4 class="modal-title" id="title_modal_education"></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="save-education-form" action="post">
        <input type="hidden" value="" name="id_candidate_education" id="id_candidate_education">
        <input type="hidden" value="" name="accion_education" id="accion_education">
        <div class="modal-body">
        <div class="card card-maroon">
            <div class="card-header">
             <h4 class="card-title">Educación</h4>
            </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="education_level">Último grado de estudios</label>
                  <?php $education_levels = Utils::showEducationLevels(); ?>
                  <select name="education_level" id="education_level" class="form-control select2" required>
                    <option disabled selected="selected"></option>
                    <?php foreach ($education_levels as $level) : ?>
                      <option value="<?= $level['id'] ?>"><?= $level['level'] ?></option>
                    <?php endforeach ?>
                  </select>
                </div>

              </div>
              <div class="col-md-6">
                <label for="institution">Institución</label>
                <input type="text" name="institution" id="institution" class="form-control" required value="">
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="title" class="col-form-label">Área de estudio</label>
                  <input type="text" name="title" id="title" class="form-control" required value="">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="age" class="col-form-label">Periodo</label>
                  <div class="row">
                    <div class="col-md-4">
                      <input type="date" name="start_date_education" id="start_date_education" class="form-control" required value="">
                    </div>
                    <div class="col-md-4">
                      <input type="date" name="end_date_education" id="end_date_education" class="form-control" required value="">
                    </div>
                    <div class="col-md-4 text-center">
                      <input type="checkbox" name="still_studies" id="still_studies" class="form-check-input">
                      <label for="still_studies" class="form-check-label">¿Aún estudia?</label>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer   justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <button class="btn btn-orange float-right" id="candidate_education_submit">Enviar</button>
        </div>
      </form>
    </div>
    </div>
  </div>
</div>


<script src="<?= base_url ?>app/education.js?v=<?= rand() ?>"></script>
<script>
  document.querySelector("#still_studies").onclick = function() {
    if (this.checked) {
      $('#end_date_education').removeAttr('required');
      document.querySelector("#end_date_education").style.display = 'none';
    } else {
      $('#end_date_education').prop('required', true);
      document.querySelector("#end_date_education").style.display = 'block';
    }
  }

  document.addEventListener("DOMContentLoaded", function(event) {
    if (document.querySelector("#still_studies").checked) {
      document.querySelector("#end_date_education").style.display = 'none';
    } else {
      document.querySelector("#end_date_education").style.display = 'block';
    }

    document.querySelector("#save-education-form").onsubmit = function(e) {
      e.preventDefault();
      document.querySelector("#save-education-form #candidate_education_submit").disabled = true;
      let education = new Education();
      if (document.querySelector("#accion_education").value == "update") {
        education.update_modal();
      } else {
         education.create();
      }
    };
  });
</script>