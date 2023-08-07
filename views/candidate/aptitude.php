<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <div class="alert alert-success">
                <h4>
                  <?php if (isset($_GET['id']) && !empty($aptitud)): ?>
                    <?= $aptitud->first_name.' '.$aptitud->surname.' '.$aptitud->last_name ?>
                  <?php else: ?>
                      Nueva aptitud
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
            <form id="aptitude-form" name="aptitude-form" method="POST">
              <input type="hidden" id="id" value="<?=isset($aptitud) && is_object($aptitud) ? Encryption::encode($aptitud->id) : ''?>">
              <input type="hidden" id="id_candidate" value="<?=isset($aptitud) && is_object($aptitud) ? Encryption::encode($aptitud->id_candidate) : $_GET['id']?>">
              <div class="card card-teal div_aptitudes">
                <div class="card-header">
                  <h4 class="card-title">Aptitudes</h4>
                </div>
                <div class="card-body div_aptitude">
                  <div class="row">
                    <div class="col-md-10">
                      <div class="form-group">
                        <label for="aptitude" class="col-form-label">Aptitud:</label>
                        <input type="text" name="aptitude" id="aptitude" value="<?=isset($aptitud) && is_object($aptitud) ? $aptitud->aptitude : ''?>" class="form-control" required>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label for="level" class="col-form-label">Nivel</label>
                        <select name="level" id="level" class="form-control" required>
                          <option disabled selected=""></option>
                          <?php foreach (range(1, 10) as $i): ?>
                            <option value="<?=$i?>" <?=isset($aptitud) && is_object($aptitud) && $aptitud->level == $i ? 'selected' : ''; ?>><?=$i?></option>
                          <?php endforeach ?>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <?php if (Utils::isCandidate()): ?>
                    <a href="<?=base_url?>candidato/ver" class="btn btn-secondary float-left">Regresar</a>
                  <?php else: ?>
                    <a href="<?=base_url?>candidato/ver&id=<?=isset($aptitud) && is_object($aptitud) ? Encryption::encode($aptitud->id_candidate) : $_GET['id']?>" class="btn btn-secondary float-left">Regresar</a>
                  <?php endif ?>
                  <button class="btn btn-orange float-right btn-lg" id="candidate_submit">Enviar</button>
                </div>
              </div>
              
            </form>
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
</div>
<script src="<?=base_url?>app/aptitude.js?v=<?=rand()?>"></script>
<script>
  document.addEventListener("DOMContentLoaded", function(event) {
    document.querySelector("#aptitude-form").onsubmit = function(e) {
      e.preventDefault();
      document.querySelector("#aptitude-form #candidate_submit").disabled = true;
      let aptitude = new Aptitude();
      if (document.querySelector("#id").value != '') {
        aptitude.update();
      }else{
        aptitude.create();
      }
    };
  });
</script>
  

