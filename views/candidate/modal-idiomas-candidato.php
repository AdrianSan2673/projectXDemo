<!--   ===[gabo 19 abril ver candidato]=== -->
<div class="modal fade" id="modal_language_candidato">
    <div class="modal-dialog modal-lg" style="max-width:  900px!important;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="title_modal_language">Nueva experiencia</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- form start -->
            <form id="save-language-form" name="save-language-form"  action="post">
                <div class="modal-body">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                
                                    <input type="hidden" value="" name="id_candidate_language" id="id_candidate_language">
                                    <input type="hidden" value="" name="id_language" id="id_language">
                                    <div class="card card-info ">
                                        <div class="card-header">
                                            <h4 class="card-title">Idiomas</h4>
                                        </div>
                                        <div class="card-body ">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="language" class="col-form-label">Idioma:</label>
                                                        <?php $languages_modal = Utils::showLanguages(); ?>
                                                        <select name="language" id="language" class="form-control select2" required>
                                                            <option disabled selected>Selecciona un idioma</option>
                                                            <?php foreach ($languages_modal as $language) : ?>
                                                                <option value="<?= $language['id'] ?>"><?= $language['language'] ?></option>
                                                            <?php endforeach ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="level" class="col-form-label">Nivel:</label>
                                                        <?php $language_levels = Utils::showLanguageLevels(); ?>
                                                        <select name="level_language" id="level_language" class="form-control select2" required>
                                                            <option disabled selected="">Selecciona el nivel</option>
                                                            <?php foreach ($language_levels as $level) : ?>
                                                                <option value="<?= $level['id'] ?>"><?= $level['language_level'] ?></option>
                                                            <?php endforeach ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="institution" class="col-form-label">Institución</label>
                                                        <input type="text" name="institution_language" id="institution_language" class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="start_date" class="col-form-label">Periodo</label>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <input type="date" name="start_date_language" id="start_date_language" class="form-control" required value="">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <input type="date" name="end_date_language" id="end_date_language" class="form-control" required value="">
                                                            </div>
                                                        </div>
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
                    <button class="btn btn-orange float-right" id="language_candidate_submit">Enviar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="<?=base_url?>app/language.js?v=<?=rand()?>"></script>
<script>
  document.addEventListener("DOMContentLoaded", function(event) {
    document.querySelector("#save-language-form").onsubmit = function(e) {
      e.preventDefault();
      document.querySelector("#save-language-form #language_candidate_submit").disabled = true;
      let language = new Language();
      if (document.querySelector("#id_language").value != '') {
        language.update_modal();
      }else{
        language.save_modal();
      }
    };
  });
</script>
  