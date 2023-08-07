<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <div class="alert alert-success">
                <h4>
                  <?php if (isset($_GET['id']) && !empty($formacion)): ?>
                    <?= $formacion->first_name.' '.$formacion->surname.' '.$formacion->last_name ?>
                  <?php else: ?>
                      Nueva formación
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
            <form id="preparation-form" name="preparation-form" method="POST">
              <input type="hidden" id="id" value="<?=isset($formacion) && is_object($formacion) ? Encryption::encode($formacion->id) : ''?>">
              <input type="hidden" id="id_candidate" value="<?=isset($formacion) && is_object($formacion) ? Encryption::encode($formacion->id_candidate) : $_GET['id']?>">
              <div class="card card-orange">
                <div class="card-header">
                  <h4 class="card-title">Formación adicional</h4>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="type" class="col-form-label">Tipo de formación</label>
                        <?php $education_levels = Utils::showEducationLevels(); ?>
                        <select name="level" id="level" class="form-control" required>
                          <option hidden selected value="" required></option>
                          <?php foreach ($education_levels as $level): ?>
                            <option value="<?=$level['id']?>" <?=isset($formacion) && is_object($formacion) && $level['id'] == $formacion->id_level ? 'selected' : ''; ?>><?=$level['level']?></option>
                          <?php endforeach ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="course" class="col-form-label">Nombre de la formación</label>
                        <input type="text" name="course" id="course" class="form-control" required value="<?=isset($formacion) && is_object($formacion) ? $formacion->course : ''; ?>">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <label for="institution" class="col-form-label">Institución</label>
                      <input type="text" name="institution" id="institution" class="form-control" required value="<?=isset($formacion) && is_object($formacion) ? $formacion->institution : ''; ?>">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-8">
                      <div class="form-group">
                        <label for="age" class="col-form-label">Periodo</label>
                        <div class="row">
                          <div class="col-md-6">
                            <input type="date" name="start_date" id="start_date" class="form-control" required value="<?=isset($formacion) && is_object($formacion) ? $formacion->start_date : ''; ?>">
                          </div>
                          <div class="col-md-6">
                            <input type="date" name="end_date" id="end_date" class="form-control" required value="<?=isset($formacion) && is_object($formacion) ? $formacion->end_date : ''; ?>">
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
                    <a href="<?=base_url?>candidato/ver&id=<?=isset($formacion) && is_object($formacion) ? Encryption::encode($formacion->id_candidate) : $_GET['id']?>" class="btn btn-secondary float-left">Regresar</a>
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
<script src="<?=base_url?>app/preparation.js?v=<?=rand()?>"></script>
<script>
  document.addEventListener("DOMContentLoaded", function(event) {
    document.querySelector("#preparation-form").onsubmit = function(e) {
      e.preventDefault();
      document.querySelector("#preparation-form #candidate_submit").disabled = true;
      let preparation = new Preparation();
      if (document.querySelector("#id").value != '') {
        preparation.update();
      }else{
        preparation.create();
      }
    };
  });
</script>
  

