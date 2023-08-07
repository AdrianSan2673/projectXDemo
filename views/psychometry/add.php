<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <div class="alert alert-success">
              <h4>Agregar psicometría</h4>
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
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Nueva psicometría</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              
              <div class="card-body">
                <form role="form" id="psychometry-add-form">
                  <div class="form-group row">
                    <label for="id_psychometry_type" class="col-md-2">Tipo de psicometría:</label>
                    <?php $types = Utils::showPsychometryTypes(); ?>
                    <select name="id_psychometry_type" id="id_psychometry_type" class="form-control col-md-10" required>
                      <option value="" hidden selected>Seleccione el tipo de psicometría</option>
                      <?php foreach ($types as $type): ?>
                        <option value="<?=$type['id']?>" <?=isset($psycho) && is_object($psycho) && $type['id'] == $psycho->id_psychometry_type ? 'selected' : ''; ?>><?=$type['type']?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
                  <div class="form-group row">
                    <label for="id_candidate" class="col-md-2">Candidato:</label>
                    <?php $candidates = Utils::showCandidates(); ?>
                    <select name="id_candidate" id="id_candidate" class="form-control col-md-10 select2">
                      <?php if (isset($_GET['candidate'])): ?>
                        <option value="<?=$candidato->id?>"><?=$candidato->first_name.' '.$candidato->surname.' '.$candidato->last_name?></option>
                      <?php else: ?>
                        <?php foreach ($candidates as $candidate): ?>
                          <option value="<?=$candidate['id']?>" <?=isset($psycho) && is_object($psycho) && $candidate['id'] == $psycho->id_candidate ? 'selected' : ''; ?>><?=$candidate['first_name'].' '.$candidate['surname'].' '.$candidate['last_name']?></option>
                        <?php endforeach ?>
                      <?php endif ?>
                        
                    </select>
                  </div>
                  <div class="form-group row">
                    <label for="psycho_file" class="col-form-label col-md-2">¿Adjuntar psicometría?</label>
                    <input type="file" id="psycho_file" name="psycho_file" class="form-control col-md-10" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel, application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/vnd.ms-powerpoint, application/vnd.openxmlformats-officedocument.presentationml.presentation, application/pdf, image/gif, image/png, image/jpeg, image/jpg">
                  </div>
                  <div class="form-group">
                    <a class="btn btn-info float-left" href="javascript: history.back()">Regresar</a>
                    <button type="submit" class="btn btn-success float-right" id="submit">Agregar psicometría</button>
                  </div>
                </form> 
              </div>
              <!-- /.card-body -->
            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>  
</div>
<script src="<?=base_url?>app/psychometry.js?v=<?=rand()?>"></script>
<script type="text/javascript">
  document.querySelector("#psychometry-add-form").onsubmit = function(e){
    e.preventDefault();
    document.querySelector("#submit").disabled = true;
    let psychometry = new Psychometry();
    psychometry.add();
  };
</script>
