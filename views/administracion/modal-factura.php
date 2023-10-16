<div class="modal fade" id="modal_factura">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Factura</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" name="Folio" class="form-control">
                        <label for="Folio_Factura" class="col-form-label">Folio factura:</label>
                        <input type="text" name="Folio_Factura" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="Fecha_Emision" class="col-form-label">Fecha:</label>
                        <input name="Fecha_Emision" type="date" class="form-control">
                        <input name="Hora_Emision" type="hidden" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="Cliente" class="col-form-label">Cliente:</label>
                        <input name="Cliente" type="text" id="Cliente" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="Razon_Social" class="col-form-label">Razón social:</label>
                        <select name="Razon_Social" id="Razon_Social" class="form-control"></select>
                    </div>
                    <div class="form-group">
                        <label for="Estado" class="col-form-label">Estado:</label>
                        <select name="Estado" class="form-control">
                            <option value="Pendiente de pago">Pendiente de pago</option>
                            <option value="Pagada">Pagada</option>
                            <option value="Cancelada">Cancelada</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="Promesa_Pago" class="col-form-label">Fecha de promesa de pago:</label>
                        <input name="Promesa_Pago" type="date" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="Monto" class="col-form-label">Monto:</label>
                        <input type="number" name="Monto" step="0.01" min="0" class="form-control">
                    </div>

                    <div class="row">
                        <div class="col-6" >
                            <div class="form-group">
                                <label class="col-form-label">¿Retener el 6%?</label>
                                <div class="">
                                    <div class="icheck-success form-check-inline">
                                        <input class="form-check-input" type="radio" name="iva" value="1.1" id="yes">
                                        <label class="form-check-label" for="yes">Sí</label>
                                    </div>
                                    <div class="icheck-success form-check-inline">
                                        <input class="form-check-input" type="radio" value="1.16" name="iva" id="no" checked>
                                        <label class="form-check-label" for="no">No</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label class="col-form-label">Incobrable</label>
                                <div class="">
                                    <div class="icheck-success form-check-inline">
                                        <input class="form-check-input" type="radio" name="Tipo" value="1" id="si_tipo">
                                        <label class="form-check-label" for="si_tipo">Sí</label>
                                    </div>
                                    <div class="icheck-success form-check-inline">
                                        <input class="form-check-input" type="radio"  name="Tipo" value="0" id="no_tipo">
                                        <label class="form-check-label" for="no_tipo">No</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>






                    <div class="form-group">
                        <label for="Fecha_de_Pago" class="col-form-label">Fecha de pago:</label>
                        <input name="Fecha_de_Pago" type="date" class="form-control">
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
<div class="modal fade" id="modal_factura_gestion">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Gestión de Factura</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" name="Folio" class="form-control">
                        <label for="Folio_Factura" class="col-form-label">Folio factura:</label>
                        <input type="text" name="Folio_Factura" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="Fecha_Emision" class="col-form-label">Fecha:</label>
                        <input name="Fecha_Emision" type="date" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="Cliente" class="col-form-label">Cliente:</label>
                        <input name="Cliente" type="text" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="Razon_Social" class="col-form-label">Razón social:</label>
                        <select name="Razon_Social" class="form-control" readonly></select>
                    </div>
                    <div class="form-group">
                        <label for="Estado" class="col-form-label">Estado:</label>
                        <select name="Estado" class="form-control">
                            <option value="Pendiente de pago">Pendiente de pago</option>
                            <option value="Pagada">Pagada</option>
                            <option value="Cancelada">Cancelada</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="Promesa_Pago" class="col-form-label">Fecha de promesa de pago:</label>
                        <input name="Promesa_Pago" type="date" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="Contacto_Con" class="col-form-label">Persona con la que se contactó:</label>
                        <input type="text" name="Contacto_Con" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="Comentarios" class="col-form-label">Comentarios:</label>
                        <textarea name="Comentarios" class="form-control" rows="10"></textarea>
                    </div>>
                    <div class="form-group">
                        <label for="Proxima_Gestion" class="col-form-label">Fecha de próxima gestión:</label>
                        <input name="Proxima_Gestion" type="date" class="form-control">
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