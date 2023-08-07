<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <div class="alert alert-success">
                <h4>
                  <?php if (isset($_GET['id']) && !empty($idioma)): ?>
                    <?= $idioma->first_name.' '.$idioma->surname.' '.$idioma->last_name ?>
                  <?php else: ?>
                      Nuevo idioma
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
            <form id="language-form" name="language-form" method="POST">
              <input type="hidden" id="id" value="<?=isset($idioma) && is_object($idioma) ? Encryption::encode($idioma->id) : ''?>">
              <input type="hidden" id="id_candidate" value="<?=isset($idioma) && is_object($idioma) ? Encryption::encode($idioma->id_candidate) : $_GET['id']?>">
              <div class="card card-navy div_languages">
                <div class="card-header">
                  <h4 class="card-title">Idiomas</h4>
                </div>
                <div class="card-body div_language">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="language" class="col-form-label">Idioma:</label>
                        <?php $languages = Utils::showLanguages(); ?>
                        <select name="language" id="language" class="form-control select2" required>
                          <option disabled selected>Selecciona un idioma</option>
                          <?php foreach ($languages as $language): ?>
                            <option value="<?=$language['id']?>" <?=isset($idioma) && is_object($idioma) && $language['id'] == $idioma->id_language ? 'selected' : ''; ?>><?=$language['language']?></option>
                          <?php endforeach ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="level" class="col-form-label">Nivel:</label>
                        <?php $language_levels = Utils::showLanguageLevels(); ?>
                        <select name="level" id="level" class="form-control select2" required>
                          <option disabled selected="">Selecciona el nivel</option>
                          <?php foreach ($language_levels as $level): ?>
                            <option value="<?=$level['id']?>" <?=isset($idioma) && is_object($idioma) && $level['id'] == $idioma->level ? 'selected' : ''; ?>><?=$level['language_level']?></option>
                          <?php endforeach ?>
                        </select>
                      </div>
                    </div>
                  </div>
                  
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="institution" class="col-form-label">Institución</label>
                        <input type="text" name="institution" id="institution" class="form-control" required value="<?=isset($idioma) && is_object($idioma) ? $idioma->institution : ''; ?>" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="start_date" class="col-form-label">Periodo</label>
                        <div class="row">
                          <div class="col-md-6">
                            <input type="date" name="start_date" id="start_date" class="form-control" required value="<?=isset($idioma) && is_object($idioma) ? $idioma->start_date : ''; ?>">
                          </div>
                          <div class="col-md-6">
                            <input type="date" name="end_date" id="end_date" class="form-control" required value="<?=isset($idioma) && is_object($idioma) ? $idioma->end_date : ''; ?>">
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
                    <a href="<?=base_url?>candidato/ver&id=<?=isset($idioma) && is_object($idioma) ? Encryption::encode($idioma->id_candidate) : $_GET['id']?>" class="btn btn-secondary float-left">Regresar</a>
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
<script src="<?=base_url?>app/language.js?v=<?=rand()?>"></script>
<script>
  document.addEventListener("DOMContentLoaded", function(event) {
    document.querySelector("#language-form").onsubmit = function(e) {
      e.preventDefault();
      document.querySelector("#language-form #candidate_submit").disabled = true;
      let language = new Language();
      if (document.querySelector("#id").value != '') {
        language.update();
      }else{
        language.create();
      }
    };
  });
</script>
  

