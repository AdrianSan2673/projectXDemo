<div class="modal fade" id="modal_editRH">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="edit-rh-form">
                <div class="modal-header">
                    <h4 class="modal-title">Editar Servicio</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="id_cliente" id="id_cliente">
                    <div class="form-group mb-3">
                        <label class="col-form-label" for="Cliente">Cliente</label>
                        <input type="text" class="form-control" id="Cliente" name="Cliente" readonly>
                    </div>
                    <div class="form-group mb-3">
                        <label class="col-form-label" for="paquete">Paquete</label>
                        <input type="text" class="form-control" id="paquete" name="paquete" readonly>
                    </div>
                    <div class="form-group mb-3">
                        <label class="col-form-label" for="Factura">Folio de facturación</label>
                        <input type="text" class="form-control" id="factura" name="factura" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">
                    </div>

                    <div class="form-group">
                        <label for="Razon_Social" class="col-form-label">Razón social:</label>
                        <select name="Razon_Social" id="Razon_Social_RH" class="form-control"></select>
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