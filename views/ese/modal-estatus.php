<div class="modal fade" id="modal_cancelar_servicio">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Cancelar servicio</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="Folio">
                    <input type="hidden" name="Servicio_Solicitado">
                    <input type="hidden" name="Fase">
                    <input type="hidden" name="Estatus">
                    <p></p>
                    <b></b>
                    <textarea name="Comentario_Cancelado" class="form-control" rows="6" maxlength="500"></textarea>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <input type="submit" name="submit" class="btn btn-danger" value="Cancelar servicio">
                </div>
            </form>
        </div>
    </div>              
</div>

<div class="modal fade" id="modal_finalizar_servicio">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Finalizar servicio</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="Folio">
                    <input type="hidden" name="Servicio_Solicitado">
                    <input type="hidden" name="Fase">
                    <input type="hidden" name="Estatus">
                    <p></p>
                    <b></b>
                    <textarea name="Comentario_Finalizado" class="form-control" rows="6" maxlength="500"></textarea>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <input type="submit" name="submit" class="btn btn-success" value="Finalizar">
                </div>
            </form>
        </div>
    </div>              
</div>