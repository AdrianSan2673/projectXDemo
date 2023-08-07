<div class="modal fade" id="modal_condiciones">
    <div class="modal-dialog modal-lg" >
        <div class="modal-content"  >
            <form method="post" id="vacante-condiciones-form">
                
            <div class="card card-purple">
                <div class="card-header">
                  <h4 class="card-title">
                    Condiciones Comerciales
                  </h4>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="send_date_candidate" class="col-form-label">Fecha de envio de candidatos:</label>
                        <input type="date" name="send_date_candidate" id="send_date_candidate" class="form-control" value="<?= $vacante->send_date_candidate != null || $vacante->send_date_candidate != ''  ?  date_format(date_create($vacante->send_date_candidate), 'Y-m-d')  : date('Y-m-d'); ?>" required>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="col-form-label">Cantidad anticipo:</label>
                        <input type="number" name="advance_payment" id="advance_payment" class="form-control" value="<?= $vacante->advance_payment != null || $vacante->advance_payment != '' ? str_replace(',', '', number_format($vacante->advance_payment, 2)) : '0'; ?>" required>
                      </div>
                    </div>

                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="col-form-label">Gastos administrativos:</label>
                        <input type="number" name="payment_amount" id="payment_amount" class="form-control" value="<?= $vacante->payment_amount != null || $vacante->payment_amount != '' ? str_replace(',', '', number_format($vacante->payment_amount, 2)) : '0'; ?>" required>
                      </div>
                    </div>

                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="col-form-label">Porcentaje a facturar:</label>
                        <input type="number" name="recruitment_service_cost" id="recruitment_service_cost"   class="form-control" value="<?= $vacante->recruitment_service_cost != null || $vacante->recruitment_service_cost != '' ? number_format($vacante->recruitment_service_cost,0) : '0'; ?>" required>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

                <input type="hidden" id="id" name="id" value="<?= isset($vacante) && is_object($vacante) ? Encryption::encode(round($vacante->id_vacancy)) : ''; ?>" >
                 <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <input type=submit" name="submit" id="edit-condiciones" class="btn btn-orange" value="Guardar">
                </div>
            </form> 
      
      
      </div>
    </div>
</div>

<script>


  document.querySelector('#edit-condiciones').addEventListener('click', e => {
      e.preventDefault();
      let vacancy = new Vacancy();
      vacancy.update_condiciones();
      console.log("entrec");
    });
  </script>