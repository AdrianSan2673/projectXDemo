<div class="modal fade" id="modal_editar_factura">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Folio</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="bill-edit-form" action="post">
                <input type="hidden" name="id" id="id">

                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-form-label" for="">Folio Factura</label>
                        <input type="text" name="folio" id="" class="form-control" maxlength="250" value="" required>
                    </div>


                    <div class="form-group ">
                        <label class="col-form-label">Fecha</label>
                        <input name="emit_date" type="date" id="emit_date" class="form-control" value="">
                        <input name="Hora_Emision" type="hidden" id="Hora_Emision" class="form-control" value="">
                    </div>
                    <div class="form-group ">
                        <label class="col-form-label">Cliente</label>
                        <input type="" name="customer" id="customer" class="form-control" readonly value="">
                    </div>
                    <div class="form-group ">
                        <label class="col-form-label">Rázon Social</label>
                        <select name="id_business_name"  class="form-control">
                            <option value="Pendiente">Pendiente</option>
                        </select>
                    </div>
                    <div class="form-group ">
                        <label class="col-form-label">Estado</label>
                        <select name="status" id="status" class="select-box form-control">
                            <option value="1">Pendiente de pago</option>
                            <option value="2">Pagada</option>
                            <option value="3">Cancelada</option>
                        </select>
                    </div>
                    <div class="form-group ">
                        <label class="col-form-label">Fecha de Promesa de pago</label>
                        <input type="date" name="payment_promise_date" id="" class="form-control" value="">
                    </div>

                    <div class="form-group ">
                        <label class="col-form-label">Monto</label>
                        <input type="" name="amount" id="amount" class="form-control" value="" readonly>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-2">¿Retener el 6%?</label>
                        <div class="col-md-10">
                            <div class="icheck-success form-check-inline">
                                <input class="form-check-input" type="radio" name="iva" id="yes" value="1.1">
                                <label class="form-check-label" for="yes">Sí</label>
                            </div>
                            <div class="icheck-success form-check-inline">
                                <input class="form-check-input" type="radio" value="1.16" name="iva" id="no">
                                <label class="form-check-label" for="no">No</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label class="col-form-label">Fecha de pago</label>
                        <input type="date" name="payment_date" id="" class="form-control" value="">
                    </div>


            </form>

            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <input type="submit" name="submit" id="submit" class="btn btn-orange" value="Guardar">
            </div>

        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        document.querySelector("#modal_editar_factura").onsubmit = function(e) {
            e.preventDefault();
            document.querySelector("#modal_editar_factura #submit").disabled = true;
            
            let management = new Management();
            management.bill_update_modal();
        };
    });
</script>