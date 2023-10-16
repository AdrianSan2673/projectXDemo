<div class="modal fade" id="modal_workdays">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Días laborales</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <input type="hidden" name="Empresa">
                    <input type="hidden" name="Cliente">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="sunday">
                        <label class="form-check-label">Domingo</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="monday">
                        <label class="form-check-label">Lunes</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="tuesday">
                        <label class="form-check-label">Martes</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="wednesday">
                        <label class="form-check-label">Miércoles</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="thursday">
                        <label class="form-check-label">Jueves</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="friday">
                        <label class="form-check-label">Viernes</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="saturday">
                        <label class="form-check-label">Sábado</label>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <input type="submit" name="submit" class="btn btn-orange" value="Guardar">
                </div>
            </form>
        </div>
    </div>
</div> 