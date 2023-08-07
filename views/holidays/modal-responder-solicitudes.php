<div class="modal fade" id="modal_responder">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h4 class="modal-title" id="titulo-responder">Aceptar Solicitud</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id_solicitud" id="id_solicitud">
                    <input type="hidden" id="accion" name="accion">

                    <div class="form-group">
                        <h6 id="descripcion"> </h6>
                    </div>

                    <div class="form-group" id="div-comments">
                        <label class="col-form-label" for="comments">Comentarios</label>
                        <textarea class="form-control" name="comments" rows="5"></textarea>
                    </div>

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <input type="submit" name="submit" class="btn btn-orange" value="Aceptar">
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.querySelector("#modal_responder form").onsubmit = function(e) {

        e.preventDefault();
        let empleado = new Employee_RH();
        empleado.responder_solicitud();

    };
</script>