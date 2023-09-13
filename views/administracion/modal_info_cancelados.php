<div class="modal fade" id="modal_info_cancelados">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="form-info-cancelados">
                <div class="modal-header">
                    <h4 id="titulo"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" value="" name="factura">
                    <div class="form-group">
                        <label for="fecha_cancelacion" class="col-form-label">Fecha de cancelación:</label>
                        <input type="date" name="fecha_cancelacion" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="comentarios" class="col-form-label">comentarios:</label>
                        <textarea name="comentarios" class="form-control" required> </textarea>
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


<script>
document.querySelector("#form-info-cancelados").onsubmit = function(e) {
    e.preventDefault();
    let administracion = new Administracion();
    administracion.updateInfoCancelados();
    //gabo
};
</script>