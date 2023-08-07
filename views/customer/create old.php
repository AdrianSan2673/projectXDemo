<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <div class="alert alert-success">
              <?php if (isset($edit) && isset($cliente) && is_object($cliente)): ?>
                <h4>Editar cliente</h4>
              <?php else: ?>
                <h4>Crear cliente</h4>
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
                <?php if (isset($edit) && isset($cliente) && is_object($cliente)): ?>
                  <ul class="nav nav-pills ml-auto">
                    <li class="nav-item"><a class="nav-link active" href="#general" data-toggle="tab">General</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contacts" data-toggle="tab">Contactos</a></li>
                    <li class="nav-item"><a class="nav-link" href="#business_name" data-toggle="tab">Razones sociales</a></li>
                  </ul>
                <?php else: ?>
                  <h3 class="card-title">Nuevo cliente</h3>
                <?php endif ?>
                
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="general">
                    <form role="form" id="register-customer-form">
                      <?php if (isset($edit) && isset($cliente) && is_object($cliente)): ?>
                        <input type="hidden" name="id" id="id" value="<?=$cliente->id?>">
                      <?php endif ?>
                      <div class="form-group row">
                        <label for="customer" class="col-md-2 col-form-label">Nombre</label>
                        <input type="text" name="customer" id="customer" class="col-md-10 form-control" value="<?=isset($cliente) && is_object($cliente) ? $cliente->customer : ''; ?>">
                      </div>
                      <div class="form-group row">
                        <label for="alias" class="col-md-2">Alias:</label>
                        <input type="text" name="alias" id="alias" class="col-md-10 form-control" value="<?=isset($cliente) && is_object($cliente) ? $cliente->alias : ''; ?>">
                      </div>
                      <div class="form-group row">
                        <label for="cost_center" class="col-md-2">Centro de costos:</label>
                        <?php $cost_centers = Utils::showCostCenters(); ?>
                        <select name="id_cost_center" id="id_cost_center" class="form-control col-md-10">
                          <option disabled selected></option>
                          <?php foreach ($cost_centers as $center): ?>
                            <option value="<?=$center['id']?>" <?=isset($cliente) && is_object($cliente) && $center['id'] == $cliente->id_cost_center ? 'selected' : ''; ?>><?=$center['cost_center']?></option>
                          <?php endforeach ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <a class="btn btn-info float-left" href="<?=base_url?>cliente/index">Regresar</a>
                        <?php if (isset($edit) && isset($cliente) && is_object($cliente)): ?>
                          <button type="submit" class="btn btn-success float-right" id="editSubmit">Editar</button>
                        <?php else: ?>
                          <button type="submit" class="btn btn-success float-right" id="registerSubmit">Crear cliente</button>
                        <?php endif ?>
                      </div>
                    </form> 
                  </div>
                  <div class="tab-pane" id="contacts">
                    <div class="row">
                      <form id="register-customer-contact-form" class="col-md-12">
                        <div class="row">
                          <input type="hidden" value="<?=$cliente->id?>" id="id_customer">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="first_name" class="col-form-label">Nombre</label>
                              <input type="text" name="first_name" id="first_name" class="form-control">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="last_name" class="col-form-label">Apellidos:</label>
                              <input type="text" name="last_name" id="last_name" class="form-control">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                                <label for="position" class="col-form-label">Puesto:</label>
                                <input type="text" name="position" id="position" class="form-control">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="email" class="col-form-label">Dirección de correo electrónico:</label>
                              <input type="email" name="email" id="email" maxlength="255" class="form-control">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="telephone" class="col-form-label">Teléfono:</label>
                              <input type="text" name="telephone" id="telephone" class="form-control">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="extension" class="col-form-label">Extensión:</label>
                              <input type="text" name="extension" id="extension" class="form-control">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="cellphone" class="col-form-label">Celular:</label>
                              <input type="text" name="cellphone" id="cellphone" class="form-control">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="add_user" class="col-form-label">Agregar cuenta de usuario:</label>
                              <select name="add_user" id="add_user" class="form-control">
                                <option value="0">No</option>
                                <option value="1">Sí</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div id="user-form" style="display: none;">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="username" class="col-form-label">Nombre de usuario:</label>
                                <input type="text" name="username" id="username" class="form-control">
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="password" class="col-form-label">Contraseña:</label>
                                <input type="password" name="password" id="password" class="form-control">
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <button type="submit" class="btn btn-orange float-right" id="contact_submit">Agregar contacto</button>
                          </div>
                        </div>
                      </form>
                    </div>
                    <hr>
                    <div class="row mt-5">
                      <div class="col-md-12">
                        <table id="tb_contacts" class="table table-bordered table-striped">
                          <thead>
                              <tr>
                                <th>Nombre Completo</th>
                                <th>Puesto</th>
                                <th>Correo</th>
                                <th>Teléfono</th>
                                <th>Extensión</th>
                                <th>Celular</th>
                                <th>Usuario</th>
                                <th></th>
                              </tr>
                          </thead>
                          <tbody>
                          </tbody>
                          <tfoot>
                              <tr>
                                <th>Nombre Completo</th>
                                <th>Puesto</th>
                                <th>Correo</th>
                                <th>Teléfono</th>
                                <th>Extensión</th>
                                <th>Celular</th>
                                <th>Usuario</th>
                                <th></th>
                              </tr>
                          </tfoot>
                        </table>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane" id="business_name">
                    <div class="row">
                      <form id="register-customer-bn-form" class="col-md-12">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="business_name" class="col-form-label">Razón social:</label>
                              <input type="text" name="business_name" id="business_name" class="form-control">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="rfc" class="col-form-label">RFC:</label>
                              <input type="text" name="rfc" id="rfc" class="form-control">
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-12">
                            <button type="submit" class="btn btn-orange float-right" id="bn_submit">Agregar razón</button>
                          </div>
                        </div>
                      </form>
                    </div>
                    <hr>
                    <div class="row mt-5">
                      <div class="col-md-12">
                        <table id="tb_bn" class="table table-bordered table-striped">
                          <thead>
                              <tr>
                                <th>Razón social</th>
                                <th>RFC</th>
                                <th></th>
                              </tr>
                          </thead>
                          <tbody>
                          </tbody>
                          <tfoot>
                              <tr>
                                <th>Razón social</th>
                                <th>RFC</th>
                                <th></th>
                              </tr>
                          </tfoot>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>  
</div>
<script src="<?=base_url?>app/customer.js?v=<?=rand()?>"></script>
<?php if (isset($edit) && isset($cliente) && is_object($cliente)): ?>
  <script type="text/javascript">
    document.querySelector('#register-customer-form #editSubmit').addEventListener('click', e => {
        e.preventDefault();
        let customer = new Customer();
        customer.update();
      });
  </script>
  <script src="<?=base_url?>app/customercontact.js?v=<?=rand();?>"></script>
  <script>
    document.querySelector('#register-customer-contact-form #contact_submit').addEventListener('click', e => {
      e.preventDefault();
      let contact = new CustomerContact();
      contact.save();
    });
    setInterval(() => {
      let contactos = new CustomerContact();
      contactos.getTbContacts();
    }, 1000);
    $(document).ready(function(){
      let table = document.querySelector('#tb_contacts');
      utils.dtTable(table);

      var tablita = $('#tb_contacts').DataTable();

      // Edit record
      tablita.on('click', '.btn-info', function(e) {
        e.preventDefault();
          $tr = $(this).closest('tr');

          var data = tablita.row($tr).data();
          console.log(tablita);
      });
    });

    document.querySelector('#add_user').addEventListener('change', e => {
      if (e.target.value == 1) {
        document.querySelector('#user-form').style.display = 'block';
      }else{
        document.querySelector("#user-form").style.display = 'none';
      }
    });
    
  </script>
  <script src="<?=base_url?>app/businessname.js?v=<?=rand();?>"></script>
  <script>
    $(document).ready(function(){
      let table = document.querySelector('#tb_bn');
      utils.dtTable(table);
    });
    setInterval(() => {
      let business_names = new BusinessName();
      business_names.getTbBN();
    }, 1000);
    
    document.querySelector('#register-customer-bn-form #bn_submit').addEventListener('click', e => {
      e.preventDefault();
      let business = new BusinessName();
      business.save();
    });
  </script>
<?php else: ?>
  <script type="text/javascript">
      document.querySelector('#register-customer-form #registerSubmit').addEventListener('click', e => {
          e.preventDefault();
          let customer = new Customer();
          customer.save();
      });

  </script> 
<?php endif ?>

