<!--   ===[gabo 25 abril ver candidato]=== -->
<div class="modal fade" id="modal_aptitude_candidato">
    <div class="modal-dialog modal-lg" style="max-width:  900px!important;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="title_modal_aptitude">Nueva experiencia</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- form start -->
            <form id="save-aptitude-form" name="save-aptitude-form" method="POST">
                <div class="modal-body">
                    <div class="card-body">
                        <div class="row"> 
                            <div class="col-md-12">
                            <input type="hidden" value="" name="id_candidate_aptitude" id="id_candidate_aptitude">
                            <input type="hidden" value="" name="id_aptitude" id="id_aptitude">
                                    <div class="card card-navy">
                                        <div class="card-header">
                                            <h4 class="card-title">Aptitudes</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-10">
                                                    <div class="form-group">
                                                        <label for="aptitude" class="col-form-label">Aptitud:</label>
                                                        <input type="text" name="aptitude" id="aptitude" value="" class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="level" class="col-form-label">Nivel</label>
                                                        <select name="level_aptitude" id="level_aptitude" class="form-control" required>
                                                            <option disabled selected=""></option>
                                                            <?php foreach (range(1, 10) as $i) : ?>
                                                                <option value="<?= $i ?>"> <?=  $i ?> </option>
                                                            <?php endforeach ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button class="btn btn-orange float-right" id="aptitude_candidate_submit">Enviar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="<?=base_url?>app/aptitude.js?v=<?=rand()?>"></script>
<script>
  document.addEventListener("DOMContentLoaded", function(event) {
    document.querySelector("#save-aptitude-form").onsubmit = function(e) {
      e.preventDefault();
      document.querySelector("#save-aptitude-form #aptitude_candidate_submit").disabled = true;
      let aptitude = new Aptitude();
      if (document.querySelector("#id_aptitude").value != '') {
        aptitude.update_modal();
      }else{
        aptitude.create_modal();
      }
    };
  });
</script>
  