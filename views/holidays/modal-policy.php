<div class="modal fade" id="modal_policy">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Política de vacaciones</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <input type="hidden" name="id_policy" id="id_policy" value="1">
                    <div class="form-group">
                        <label class="col-form-label" for="">Nombre</label>
                        <input type="text" name="name" id="name" class="form-control" maxlength="250" required>
                    </div>
                    <div class="form-row"></div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <input type="submit" name="submit" class="btn btn-orange" value="Guardar">
                </div>
            </form>
        </div>
    </div>
</div>