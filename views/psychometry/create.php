<div class="content-wrapper">
  <div class="container">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <div class="alert alert-success">
              <?php if (isset($edit) && isset($psycho) && is_object($psycho)) : ?>
                <h4>Psicometrías de <?= $psycho->candidate . ' de ' . $psycho->customer ?></h4>
              <?php else : ?>
                <h4>Registrar psicometría</h4>
              <?php endif ?>

            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card">
              <div class="card-header">
                <?php if (isset($edit) && isset($psycho) && is_object($psycho)) : ?>
                  <h3 class="card-title">Editar psicometría</h3>
                <?php else : ?>
                  <h3 class="card-title">Nueva psicometría</h3>
                <?php endif ?>

              </div>
              <!-- /.card-header -->
              <!-- form start -->

              <div class="card-body">
                <form role="form" id="psychometry-form">
                  <?php if (isset($edit) && isset($psycho) && is_object($psycho)) : ?>
                    <input type="hidden" name="id" id="id" value="<?= $_GET['id'] ?>">
                    <input type="hidden" name="id_candidate" id="id_candidate" value="<?= isset($psycho) && is_object($psycho) ? $psycho->id_candidate : ''; ?>">
                    <div class="form-group row">
                      <label for="request_date" class="">Fecha de solicitud</label>
                      <input type="date" name="request_date" id="request_date" class="form-control" value="<?= isset($psycho) && is_object($psycho) ? $psycho->request_date : ''; ?>">
                    </div>
                  <?php endif ?>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label for="first_name" class="col-form-label">Nombre(s)</label>
                        <input type="text" name="first_name" id="first_name" class="form-control" required value="<?= isset($psycho) && is_object($psycho) ? $psycho->first_name : ''; ?>">
                      </div>
                    </div>
                    <div class="col-lg-3">
                      <div class="form-group">
                        <label for="surname" class="col-form-label">Apellido Paterno</label>
                        <input type="text" name="surname" id="surname" class="form-control" required value="<?= isset($psycho) && is_object($psycho) ? $psycho->surname : ''; ?>">
                      </div>
                    </div>
                    <div class="col-lg-3">
                      <div class="form-group">
                        <label for="last_name" class="col-form-label">Apellido Materno</label>
                        <input type="text" name="last_name" id="last_name" class="form-control" required value="<?= isset($psycho) && is_object($psycho) ? $psycho->last_name : ''; ?>">
                      </div>
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col">
                      <label class="col-form-label" for="job_title">Puesto, título o cargo</label>
                      <input type="text" class="form-control" name="job_title" id="job_title" maxlength="100" value="<?= isset($psycho) && is_object($psycho) ? $psycho->job_title : ''; ?>" required>
                    </div>
                    <div class="form-group col">
                      <label class="col-form-label" for="telephone">Teléfono</label>
                      <input type="text" name="telephone" class="form-control" id="telephone" data-inputmask='"mask": "999 999 9999"' data-mask value="<?= isset($psycho) && is_object($psycho) ? $psycho->telephone : ''; ?>" required>
                    </div>
                    <div class="form-group col">
                      <label class="col-form-label" for="email">Correo electrónico</label>
                      <input type="email" name="email" id="email" class="form-control" value="<?= isset($psycho) && is_object($psycho) ? $psycho->email : ''; ?>">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="customer" class="col-form-label">Cliente:</label>

                    <?php if (Utils::isCustomer()) : ?>
                      <select name="customer" id="customer" class="form-control" required readonly>
                        <option readonly selected="selected" value="<?= $cliente->id ?>"><?= $cliente->customer ?></option>
                      </select>
                    <?php else : ?>
                      <?php $customers = Utils::showCustomers(); ?>
                      <select name="customer" id="customer" class="form-control select2" required>
                        <?php if (isset($_GET['customer'])) : ?>
                          <option value="<?= $cliente->id ?>"><?= $cliente->customer ?></option>
                        <?php else : ?>
                          <option value="" selected disabled>Selecciona cliente</option>
                          <?php foreach ($customers as $customer) : ?>
                            <option value="<?= $customer['id'] ?>" <?= isset($psycho) && is_object($psycho) && $customer['id'] == $psycho->id_customer ? 'selected' : ''; ?>><?= $customer['customer'] ?></option>
                          <?php endforeach ?>
                        <?php endif ?>
                      </select>
                    <?php endif ?>
                  </div>
                  <?php if (Utils::isCustomer()) : ?>
                    <input type="hidden" name="customer_contact" value="<?= $customer_contact ?>">
                  <?php else : ?>

                    <div class="form-group">
                      <label for="customer_contact" class="col-form-label">Contacto</label>
                      <select name="customer_contact" id="customer_contact" class="form-control" readonly>
                        <option readonly selected="selected" value="">Seleciona contacto</option>
                        <?php foreach ($customerContact as $contact) : ?>
                          <option value="<?= $contact['id'] ?>" <?= $contact['id'] == $psycho->id_customer_contact ? 'selected' : ''  ?>><?= $contact['first_name'] . ' ' . $contact['last_name']  ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>

                  <?php endif ?>


                  <div class="form-group">
                    <label for="business_name" class="col-form-label">Razón social:</label>


                    <?php if (Utils::isCustomer()) : ?>
                      <select name="business_name" id="business_name" class="form-control">
                        <?= $BNs = Utils::showBNByCustomer($id_customer); ?>
                        <?php foreach ($BNs as $bn) : ?>
                          <option value="<?= $bn['id'] ?>" <?= isset($vacante) && is_object($vacante) && $bn['id'] == $vacante->id_business_name ? 'selected' : ''; ?>><?= $bn['business_name'] ?></option>
                        <?php endforeach ?>
                        <option value>Pendiente</option>
                      </select>
                    <?php else : ?>
                      <select name="business_name" id="business_name" class="form-control">
                        <?php if (isset($psycho) && is_object($psycho) && !empty($psycho->id_customer)) : ?>
                          <?= $BNs = Utils::showBNByCustomer($psycho->id_customer); ?>
                          <?php foreach ($BNs as $bn) : ?>
                            <option value="<?= $bn['id'] ?>" <?= isset($psycho) && is_object($psycho) && $bn['id'] == $psycho->id_business_name ? 'selected' : ''; ?>><?= $bn['business_name'] ?></option>
                          <?php endforeach ?>
                          <option value>Pendiente</option>
                        <?php else : ?>
                          <?php if (isset($_GET['customer'])) : ?>
                            <?= $BNs = Utils::showBNByCustomer(Encryption::decode($_GET['customer'])); ?>
                            <?php foreach ($BNs as $bn) : ?>
                              <option value="<?= $bn['id'] ?>"><?= $bn['business_name'] ?></option>
                            <?php endforeach ?>
                            <option value>Pendiente</option>
                          <?php else : ?>
                            <option value>Pendiente</option>
                          <?php endif ?>
                        <?php endif ?>
                      </select>
                    <?php endif ?>



                  </div>

                  <div class="form-group" <?= Utils::isCustomer() ? 'hidden' : '' ?>>
                    <label for="recruiter" class="col-form-label">Reclutador</label>
                    <?php $recruiters = Utils::showRecruiters(); ?>
                    <select name="id_recruiter" id="id_recruiter" class="form-control select2" required>
                      <option disabled selected="selected">Selecciona Ejecutivo</option>
                      <?php foreach ($recruiters as $recruiter) : ?>
                        <option value="<?= $recruiter['id'] ?>" <?= isset($psycho) && is_object($psycho) && $recruiter['id'] == $psycho->id_recruiter ? 'selected' : ''; ?>>
                          <?= $recruiter['first_name'] . ' ' . $recruiter['last_name'] ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>

                  <?php if (isset($edit) && isset($psycho) && is_object($psycho)) : ?>
                    <div class="form-group">
                      <label for="end_date" class="col-form-label">Fecha de entrega</label>
                      <input type="date" name="end_date" id="end_date" class="form-control" value="<?= isset($psycho) && is_object($psycho) ? $psycho->end_date : ''; ?>">
                    </div>

                    <div class="form-group">
                      <label for="status" class="col-form-label">Estado:</label>
                      <select name="status" id="status" class="select-box form-control">
                        <option <?= isset($psycho) && is_object($psycho) && $psycho->status == 1 ? 'selected' : ''; ?> value="1">Pendiente</option>
                        <option <?= isset($psycho) && is_object($psycho) && $psycho->status == 2 ? 'selected' : ''; ?> value="2">Entregada</option>
                        <option <?= isset($psycho) && is_object($psycho) && $psycho->status == 3 ? 'selected' : ''; ?> value="3">Facturada</option>
                        <option <?= isset($psycho) && is_object($psycho) && $psycho->status == 0 ? 'selected' : ''; ?> value="0">Cancelada</option>
                      </select>
                    </div>

                    <div class="form-group">
                      <label for="status" class="col-form-label">Comentario:</label>
                      <textarea class="form-control" name="comment" cols="30" rows="10"><?= isset($psycho) && is_object($psycho) ? $psycho->comment : ''; ?></textarea>
                    </div>

                  <?php endif ?>
                  <div class="form-group">
                    <a class="btn btn-info float-left" href="javascript: history.back()">Regresar</a>
                    <?php if (isset($edit) && isset($psycho) && is_object($psycho)) : ?>
                      <button type="submit" class="btn btn-success float-right" id="submit">Editar</button>
                    <?php else : ?>
                      <button type="submit" class="btn btn-success float-right" id="submit">Registrar psicometría</button>
                    <?php endif ?>
                  </div>
                </form>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
  </div>

</div>
<script src="<?= base_url ?>app/businessname.js?v=<?= rand() ?>"></script>
<script src="<?= base_url ?>app/psychometry.js?v=<?= rand() ?>"></script>
<script src="<?= base_url ?>app/customercontact.js?v=<?= rand() ?>"></script>
<script>
  document.querySelector('#customer').onchange = function() {
    let contact = new CustomerContact();
    contact.getContacts();

    let business_name = new BusinessName();
    business_name.getBusinessName();
  };
</script>
<?php if (isset($_GET['id'])) : ?>
  <script type="text/javascript">
    document.querySelector("#psychometry-form").onsubmit = function(e) {
      e.preventDefault();
      document.querySelector("#submit").disabled = true;
      let psychometry = new Psychometry();
      psychometry.update();
    };
  </script>
<?php else : ?>
  <script type="text/javascript">
    document.querySelector("#psychometry-form").onsubmit = function(e) {
      e.preventDefault();
      document.querySelector("#submit").disabled = true;
      let psychometry = new Psychometry();
      psychometry.create();
    };
  </script>
<?php endif ?>