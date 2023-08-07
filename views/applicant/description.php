<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <div class="alert alert-success">
                <h3><?=$postulacion->first_name. ' '. $postulacion->surname.' '.$postulacion->last_name?> | Candidato para el puesto de <b><?=$postulacion->vacancy?></b></h3>
            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content-header">
      <div class="row">
          <div class="col-sm-2 mr-auto">
            <a class="btn btn-secondary btn-block float-left" href="javascript: history.back()">Regresar</a>
          </div>        
      </div>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="card card-success">
          <form id="description-form" action="<?=base_url?>postulaciones/description" method="post">
            <input type="hidden" name="id_candidate" value="<?=$postulacion->id_candidate?>">
            <input type="hidden" name="id_vacancy" value="<?=$postulacion->id_vacancy?>">
            <input type="hidden" name="id_status" value="<?=$postulacion->id_status?>">
            <div class="card-body">            
              <div class="form-group">
                <label for="about" class="col-form-label">Reseña</label>
                <textarea name="about" id="about" rows="6" class="form-control" required><?=isset($postulacion) && is_object($postulacion) ? $postulacion->about : ''; ?></textarea>
              </div>
              <div class="form-group">
                <label for="videocall_url" class="col-form-label">Enlace de videollamada</label>
                <input type="url" name="video_call_url" class="form-control" value="<?=isset($postulacion) && is_object($postulacion) ? $postulacion->video_call_url : ''; ?>">
              </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <input type="submit" value="Guardar" id="submit" class="btn btn-lg btn-orange float-right">
            </div>
          </form>  
        </div>
    </section>
</div>
<script src="<?=base_url?>app/vacancy.js?v=<?=rand()?>"></script>
<script type="text/javascript">
  document.querySelector('#description-form').addEventListener('submit', e =>{
    e.preventDefault();
    document.querySelector("#submit").disabled = true;
    let vacancy = new Vacancy();
    vacancy.description();
  });
</script>