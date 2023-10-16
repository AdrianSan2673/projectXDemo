<!--   ===[gabo 19 abril ver candidato]=== -->
<div class="modal fade" id="modal_preparation_candidato">
    <div class="modal-dialog modal-lg" style="max-width:  900px!important;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="title_modal_preparation">Nueva experiencia</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div> 
             <!-- form start -->
            <form id="save-preparation-form" action="post">
                <div class="modal-body">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                    <input type="hidden" value="" name="id_candidate_preparation" id="id_candidate_preparation">
                                    <input type="hidden" value="" name="id_preparation" id="id_preparation">
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
                                                            <?php foreach ($education_levels as $level) : ?>
                                                                <option value="<?= $level['id'] ?>" ><?= $level['level'] ?></option>
                                                            <?php endforeach ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="course" class="col-form-label">Nombre de la formación</label>
                                                        <input type="text" name="course" id="course" class="form-control" required value="">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="institution" class="col-form-label">Institución</label>
                                                    <input type="text" name="institution_preparation" id="institution_preparation" class="form-control" required value="">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <label for="age" class="col-form-label">Periodo</label>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <input type="date" name="start_date_preparation" id="start_date_preparation" class="form-control" required value="">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <input type="date" name="end_date_preparation" id="end_date_preparation" class="form-control" required value="">
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
                    <button class="btn btn-orange float-right" id="preparation_candidate_submit">Enviar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="<?= base_url ?>app/preparation.js?v=<?= rand() ?>"></script>
<script>
    document.addEventListener("DOMContentLoaded", function(event) {
        document.querySelector("#save-preparation-form").onsubmit = function(e) {
            e.preventDefault();
            document.querySelector("#save-preparation-form #preparation_candidate_submit").disabled = true;
            let preparation = new Preparation();
            if (document.querySelector("#id_preparation").value != '') {
                preparation.update_modal();
            } else {
                preparation.create_modal();
            }
        };
    });
</script>
