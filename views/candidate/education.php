<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <div class="alert alert-success">
                <h4>
                  <?php if (isset($_GET['id']) && !empty($educacion)): ?>
                    <?= $educacion->first_name.' '.$educacion->surname.' '.$educacion->last_name ?>
                  <?php else: ?>
                      Nueva educacion
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
            <form id="education-form" name="education-form" method="POST">
              <input type="hidden" id="id" value="<?=isset($educacion) && is_object($educacion) ? Encryption::encode($educacion->id) : ''?>">
              <input type="hidden" id="id_candidate" value="<?=isset($educacion) && is_object($educacion) ? Encryption::encode($educacion->id_candidate) : $_GET['id']?>">
              <div class="card card-info">
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
                          <?php foreach ($education_levels as $level): ?>
                            <option value="<?=$level['id']?>" <?=isset($educacion) && is_object($educacion) && $level['id'] == $educacion->id_level ? 'selected' : ''; ?>><?=$level['level']?></option>
                          <?php endforeach ?>
                        </select>
                      </div>
                      
                    </div>
                    <div class="col-md-6">
                      <label for="institution">Institución</label>
                      <input type="text" name="institution" id="institution" class="form-control" required value="<?=isset($educacion) && is_object($educacion) ? $educacion->institution : ''; ?>">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="title" class="col-form-label">Área de estudio</label>
                        <input type="text" name="title" id="title" class="form-control" required value="<?=isset($educacion) && is_object($educacion) ? $educacion->title : ''; ?>">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="age" class="col-form-label">Periodo</label>
                        <div class="row">
                          <div class="col-md-4">
                            <input type="date" name="start_date" id="start_date" class="form-control" required value="<?=isset($educacion) && is_object($educacion) ? $educacion->start_date : ''; ?>">
                          </div>
                          <div class="col-md-4">
                            <input type="date" name="end_date" id="end_date" class="form-control" required value="<?=isset($educacion) && is_object($educacion) ? $educacion->end_date : ''; ?>">
                          </div>
                          <div class="col-md-4 text-center">
                            <input type="checkbox" name="still_studies" id="still_studies" class="form-check-input">
                            <label for="still_studies" class="form-check-label" <?=isset($educacion) && is_object($educacion) && $educacion->still_studies == 1 ? 'checked' : ''; ?>>¿Aún estudia?</label>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <?php if (Utils::isCandidate()): ?>
                    <a href="<?=base_url?>candidato/ver" class="btn btn-secondary float-left">Regresar</a>
                  <?php else: ?>
                    <a href="<?=base_url?>candidato/ver&id=<?=$_GET['id']?>" class="btn btn-secondary float-left">Regresar</a>
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
<script src="<?=base_url?>app/education.js?v=<?=rand()?>"></script>
<script>
  document.querySelector("#still_studies").onclick = function(){
    if (this.checked) {
      document.querySelector("#end_date").style.display = 'none';
    }else{
      document.querySelector("#end_date").style.display = 'block';
    }
  }

  document.addEventListener("DOMContentLoaded", function(event) {
    if (document.querySelector("#still_studies").checked) {
      document.querySelector("#end_date").style.display = 'none';
    }else{
      document.querySelector("#end_date").style.display = 'block';
    }

    document.querySelector("#education-form").onsubmit = function(e) {
      e.preventDefault();
      document.querySelector("#education-form #candidate_submit").disabled = true;
      let education = new Education();
      if (document.querySelector("#id").value != '') {
        education.update();
      }else{
        education.create();
      }
    };
  });
</script>
  

