<!-- gabo 20/02/2022 -->
<div class="modal fade" id="modal_gestionar_factura" >
    <div class="modal-dialog">
        <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Folio</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="bill-gestion-form" action="post">
                <input type="hidden" name="id" id="id" >
                <div class="modal-body">
                                <div class="form-group">
                                    <input type="hidden" name="Folio" id="Folio"  class="form-control" value="">
                                    <label for="folio" class="col-form-label">Folio factura:</label>
                                    <input type="text" name="folio" id="folio"  class="form-control" value="" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="emit_date" class="col-form-label">Fecha:</label>
                                    <input name="emit_date" type="date" id="emit_date" class="form-control" value="" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="customer" class="col-form-label">Cliente:</label>
                                    <input name="customer" type="text" id="customer" class="form-control" value="" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="id_business_name" class="col-form-label">Razón social:</label>
                                    <select name="id_business_name" id="id_business_name" class="form-control" >                                       
                                        <option value="Pendiente">Pendiente</option>                                                                           
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="status" class="col-form-label">Estado:</label>
                                    <select name="status" id="status" class="form-control">
                                      <option value="1" >Pendiente de pago</option>
                                      <option value="2" >Pagada</option>
                                      <option value="3" >Cancelada</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="payment_promise_date" class="col-form-label">Fecha de promesa de pago:</label>
                                    <input name="payment_promise_date" type="date" id="payment_promise_date" class="form-control" value="">
                                </div>
                                <div class="form-group">
                                    <label for="who_contacted" class="col-form-label">Persona con la que se contactó:</label>
                                    <input type="text" name="who_contacted" id="who_contacted" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="comments" class="col-form-label">Comentarios:</label>
                                    <textarea name="comments" id="comments" class="form-control" rows="10"></textarea>
                                </div>  
                            </div>
                
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <input type="submit" name="submit" id="submit" class="btn btn-orange" value="Guardar">
                </div>
           </form>

        </div>
    </div>
</div>




<script type="text/javascript">
    
    document.querySelector("#bill-gestion-form").onsubmit = function(e) {
       
      e.preventDefault();
      document.querySelector("#bill-gestion-form #submit").disabled = true;
      let management2 = new Management(); 
      
      management2.bill_manage_modal();
    };
</script>