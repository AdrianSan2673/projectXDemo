<div class="modal fade" id="modal_contacto">
    <div class="modal-dialog modal-lg" >
        <div class="modal-content"  >
            <form method="post" id="vacante-contacto-form">
                
            <div class="card card-success">
                  <div class="card-header">
                    <h4 class="card-title">Contacto</h4>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="customer" class="col-form-label">Empresa</label>
                          <?php $customers = Utils::showCustomers(); ?>
                          <select name="customer" id="customer" class="form-control select2" required>
                            <option disabled selected="selected"></option>
                            <?php foreach ($customers as $customer) : ?>
                              <option value="<?= $customer['id'] ?>" <?= isset($vacante) && is_object($vacante) && $customer['id'] == $vacante->id_customer ? 'selected' : ''; ?>><?= $customer['customer'] ?></option>
                            <?php endforeach ?>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="customer_contact" class="col-form-label">Contacto</label>
                          <select name="customer_contact" id="customer_contact" class="form-control">
                            <?php if (isset($vacante) && is_object($vacante) && !empty($vacante->id_customer)) : ?>
                              <?= $contacts = Utils::showContactsByCustomer($vacante->id_customer); ?>
                              <?php foreach ($contacts as $contact) : ?>
                                <option value="<?= $contact['id'] ?>" <?= isset($vacante) && is_object($vacante) && $contact['id'] == $vacante->id_customer_contact ? 'selected' : ''; ?>><?= $contact['first_name'] . ' ' . $contact['last_name'] ?></option>
                              <?php endforeach ?>
                            <?php else : ?>
                              <option disabled selected="selected"></option>
                            <?php endif ?>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="business_name" class="col-form-label">Razón social</label>
                          <select name="business_name" id="business_name" class="form-control">
                            <?php if (isset($vacante) && is_object($vacante) && !empty($vacante->id_customer)) : ?>
                              <?= $BNs = Utils::showBNByCustomer($vacante->id_customer); ?>
                              <?php foreach ($BNs as $bn) : ?>
                                <option value="<?= $bn['id'] ?>" <?= isset($vacante) && is_object($vacante) && $bn['id'] == $vacante->id_business_name ? 'selected' : ''; ?>><?= $bn['business_name'] ?></option>
                              <?php endforeach ?>
                            <?php else : ?>
                              <option disabled selected="selected"></option>
                            <?php endif ?>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="recruiter" class="col-form-label">Reclutador</label>
                          <?php $recruiters = Utils::showRecruiters(); ?>
                          <select name="recruiter" id="recruiter" class="form-control">
                            <option disabled selected="selected"></option>
                            <?php foreach ($recruiters as $recruiter) : ?>
                              <option value="<?= $recruiter['id'] ?>" <?= isset($vacante) && is_object($vacante) && $recruiter['id'] == $vacante->id_recruiter ? 'selected' : ''; ?>><?= $recruiter['first_name'] . ' ' . $recruiter['last_name'] ?></option>
                            <?php endforeach ?>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- /.card-body -->
                </div>

                <input type="hidden" id="id" name="id" value="<?= isset($vacante) && is_object($vacante) ? Encryption::encode(round($vacante->id_vacancy)) : ''; ?>" >
                 <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <input type=submit" name="submit" id="edit-contacto" class="btn btn-orange" value="Guardar">
                </div>
          
            </form> 
      
      
      </div>
    </div>
</div>

<script>


  document.querySelector('#edit-contacto').addEventListener('click', e => {
      e.preventDefault();
      let vacancy = new Vacancy();
      vacancy.update_contacto();
      console.log("entre");
    });
  </script>