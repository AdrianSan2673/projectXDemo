<div class="modal fade" id="modal_servicios">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Servicios de Apoyo</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="Cliente">
                    <input type="hidden" name="flag" value="1">
                    <div class="form-check form-check-inline">
                        <input type="checkbox" name="Tiene_IL" class="form-check-input" value="1">
                        <label class="form-check-label" for="Tiene_IL">Investigación Laboral</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="checkbox" name="Tiene_ESE" class="form-check-input" value="1">
                        <label class="form-check-label" for="Tiene_ESE">Verificación Domiciliaria</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="checkbox" name="Tiene_SOI" class="form-check-input" value="1">
                        <label class="form-check-label" for="Tiene_SOI">SOI</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="checkbox" name="Tiene_SMART" class="form-check-input" value="1">
                        <label class="form-check-label" for="Tiene_SMART">ESE SMART</label>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <input type="submit" class="btn btn-orange" value="Guardar">
                </div>
            </form>
        </div>
    </div>              
</div>