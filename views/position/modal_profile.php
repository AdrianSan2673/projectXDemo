<div class="modal fade" id="modal_profile">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header ">
                    <h4 class="modal-title">Descripción del puesto</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-form-label">Escolaridad</label>
                        <input type="text" name="scholarship" value="<?= $position->scholarship ?>" class="form-control" maxlength="400" >
                    </div>

                    <div class="form-group">
                        <label class="col-form-label">Experiencia</label>
                        <textarea name="experience"  class="form-control" rows="4" maxlength="4000"><?= $position->experience  ?></textarea>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Estudio adicionales</label>
                        <input type="text" name="additional_studies" class="form-control" value="<?= $position->additional_studies ?>" maxlength="400">
                    </div>

                    <div class="form-group">
                        <label class="col-form-label">Años de experiencia</label>
                        <input type="text" name="experience_years" class="form-control" value="<?= $position->experience_years  ?>" >
                    </div>

                    <div class="form-group">
                        <label class="col-form-label">Idioma</label>
                        <input type="text" name="language" class="form-control" value="<?= $position->language  ?> " maxlength="40">
                    </div>

                    <input type="hidden" name="id_position" value="<?= $_GET['id'] ?>">

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <input type="submit" name="submit" class="btn btn-orange" value="Guardar">
                </div>
            </form>
        </div>
    </div>
</div>