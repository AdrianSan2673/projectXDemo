<div class="content-wrapper">
  <div class="container">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <div class="alert alert-success">
              <?php if (isset($cliente) && is_object($cliente)): ?>
                <h4><?=$cliente->customer?></h4>
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
                  <h3 class="card-title"><?=$cliente->customer?></h3>
                <?php else: ?>
                  <h3 class="card-title">Nuevo contacto</h3>
                <?php endif ?>
                
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <div class="card-body">
                <form id="customer-contact-form" name="customer-contact-form" class="col-md-12">
                  <div class="row">
                    <input type="hidden" id="id" value="<?=isset($contacto) && is_object($contacto) ? $_GET['id'] : ''?>">
                    <input type="hidden" id="id_customer" value="<?=isset($contacto) && is_object($contacto) ? Encryption::encode($contacto->id_customer) : $_GET['id']?>">
                    <input type="hidden" id="id_user" value="<?=isset($contacto) && is_object($contacto) ? Encryption::encode($contacto->id_user) : ''?>">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="first_name" class="col-form-label">Nombre</label>
                        <input type="text" name="first_name" id="first_name" class="form-control" value="<?=isset($contacto) && is_object($contacto) ? $contacto->first_name : ''; ?>">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="last_name" class="col-form-label">Apellidos:</label>
                        <input type="text" name="last_name" id="last_name" class="form-control" value="<?=isset($contacto) && is_object($contacto) ? $contacto->last_name : ''; ?>">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                          <label for="position" class="col-form-label">Puesto:</label>
                          <input type="text" name="position" id="position" class="form-control" value="<?=isset($contacto) && is_object($contacto) ? $contacto->position : ''; ?>">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="email" class="col-form-label">Dirección de correo electrónico:</label>
                        <input type="email" name="email" id="email" maxlength="255" class="form-control" value="<?=isset($contacto) && is_object($contacto) ? $contacto->email : ''; ?>">
                        <div id="email_exists" style="display: none"></div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="telephone" class="col-form-label">Teléfono:</label>
                        <input type="text" name="telephone" id="telephone" class="form-control"  value="<?=isset($contacto) && is_object($contacto) ? $contacto->telephone : ''; ?>"data-inputmask='"mask": "999 999 9999"' data-mask>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label for="extension" class="col-form-label">Extensión:</label>
                        <input type="text" name="extension" id="extension" class="form-control" value="<?=isset($contacto) && is_object($contacto) ? $contacto->extension : ''; ?>">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="cellphone" class="col-form-label">Celular:</label>
                        <input type="text" name="cellphone" id="cellphone" class="form-control" value="<?=isset($contacto) && is_object($contacto) ? $contacto->cellphone : ''; ?>" data-inputmask='"mask": "999 999 9999"' data-mask>
                      </div>
                    </div>
                  </div>
                  <label class="col-form-label">Fecha de nacimiento</label>
                  <div class="row">
                    <div class="col">
                      <div class="input-group mb-3">
                        <select id="day" name="day" class="form-control" required>
                          <option value="" hidden selected>Día</option>
                          <?php foreach (range(1, 31) as $i): ?>
                            <option value="<?=$i?>" <?=isset($contacto) && is_object($contacto) && (int)$birthday[0] == $i ? 'selected' : ''; ?>><?=$i?></option>
                          <?php endforeach ?>
                        </select>
                      </div>
                    </div>
                    <div class="col">
                      <div class="input-group mb-3">
                        <select id="month" name="month" class="form-control" required>
                          <option value="" hidden selected>Mes</option>
                          <?php $months = Utils::getMonths(); ?>
                          <?php foreach ($months as $i => $m): ?>
                            <option value="<?=$i+1?>" <?=isset($contacto) && is_object($contacto) && (int)$birthday[1] == $i+1 ? 'selected' : ''; ?>><?=$m?></option>
                          <?php endforeach ?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="username" class="col-form-label">Nombre de usuario:</label>
                        <input type="text" name="username" id="username" class="form-control" value="<?=isset($contacto) && is_object($contacto) ? $contacto->username : ''; ?>">
                        <div id="user_exists" style="display: none"></div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="password" class="col-form-label">Contraseña:</label>
                        <input type="text" name="password" id="password" class="form-control" value="<?=isset($contacto) && is_object($contacto) && !empty($contacto->password) ? Utils::decrypt($contacto->password) : ''; ?>">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <a class="btn btn-info float-left" href="javascript: history.back()">Regresar</a>
                      <input type="submit" class="btn btn-orange float-right" id="submit" value="<?=($_GET['action'] == 'crear' ? 'Crear contacto' : 'Editar contacto')?>">
                    </div>
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
<script src="<?=base_url?>app/customercontact.js?v=<?=rand();?>"></script>
<script>
document.querySelector('#customer-contact-form').addEventListener('submit', e => {
  e.preventDefault();
  let contact = new CustomerContact();

  if (document.querySelector("#id").value != '') {
    contact.update();
  }else{
    contact.save();
  }

});


document.querySelector('#customer-contact-form #username').addEventListener('input', e => {
    let user = new User();
    user.checkUsername();
});

document.querySelector('#customer-contact-form #email').addEventListener('input', e => {
    let user = new User();
    user.checkEmail();
});
</script>