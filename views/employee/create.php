<div class="content-wrapper">
  <div class="container">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">

          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left mb-2">
              <li class="breadcrumb-item"><a href="<?= base_url ?>">Inicio</a></li>
              <li class="breadcrumb-item"><a href="<?= base_url . 'empleado/index&flag=' . Encryption::encode(1) ?>">Empleados </a></li>
              <li class="breadcrumb-item">Nuevo empleado</li>
            </ol>
          </div>

          <div class="col-sm-12">
            <div class="alert alert-success">
              <h4>Nuevo Empleado</h4>
            </div>
          </div>

        </div>
      </div><!-- /.container-fluid -->
    </section>


    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <form id="employee-form" name="employee-form" method="POST">
            <div class="col-md-12">
              <!-- form start -->
              <input type="hidden" name="flag" value="<?= Encryption::encode(2) ?>">

              <!-- general form elements -->
              <div class="card">
                <div class="card-body">
                  <div class="form-row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="first_name" class="col-form-label">Nombre(s)*</label>
                        <input type="text" name="first_name" id="first_name" class="form-control" maxlength="40" required>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="surname" class="col-form-label">Apellido Paterno*</label>
                        <input type="text" name="surname" id="last_name" class="form-control" maxlength="40" required>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="last_name" class="col-form-label">Apellido Materno*</label>
                        <input type="text" name="last_name" id="surname" class="form-control" maxlength="40" required>
                      </div>
                    </div>
                  </div>


                  <div class="row">
                    <div class="col-md-2">
                      <div class="form-group">
                        <label for="gender" class="col-form-label">Sexo*</label>
                        <?php $genders = Utils::showGenders(); ?>
                        <select name="id_gender" id="id_gender" class="form-control" required>
                          <option disabled value="" selected>Selecciona sexo</option>
                          <?php foreach ($genders as $gender) : ?>
                            <option value="<?= $gender['id'] ?>" <?= isset($candidato) && is_object($candidato) && $gender['id'] == $candidato->id_gender ? 'selected' : ''; ?>><?= $gender['gender'] ?></option>
                          <?php endforeach ?>
                        </select>
                      </div>
                    </div>

                    <div class="col-md-2">
                      <div class="form-group">
                        <label for="civil_status" class="col-form-label">Estado civil*</label>
                        <select name="civil_status" id="civil_status" class="form-control" required>
                          <option disabled value="" selected>Selecciona estado civil</option>
                          <option value="Casado(a)">Casado(a)</option>
                          <option value="Divorciado(a)">Divorciado(a)</option>
                          <option value="Soltero(a)">Soltero(a)</option>
                          <option value="Union libre">Union libre</option>
                          <option value="Viudo(a)">Viudo(a)</option>
                        </select>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="date_birth" class="col-form-label">Fecha de nacimiento*</label>
                        <input type="date" name="date_birth" id="date_birth" class="form-control" required>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="start_date" class="col-form-label">Fecha ingreso*</label>
                        <input type="date" name="start_date" id="start_date" class="form-control" required>
                      </div>
                    </div>
                  </div>


                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="contract" class="col-form-label">Tipo de contratacion*</label>
                        <select class="form-control" name="contract" id="selectContract" required>
                          <option disabled selected value="">Selecciona tipo de contrato</option>
                          <option value="<?= Encryption::encode(1)  ?>">Periodo de prueba</option>
                          <option value="<?= Encryption::encode(2)  ?>">Capacitación</option>
                          <option value="<?= Encryption::encode(3)  ?>">Contrato por obra</option>
                          <option value="<?= Encryption::encode(4)  ?>">Tiempo determinado</option>
                          <option value="<?= Encryption::encode(5)  ?>">Tiempo indeterminado</option>
                        </select>
                      </div>
                    </div>

                    <div class="col-md-2" id="divNumber" hidden>
                      <div class="form-group">
                        <label for="" class="col-form-label">Numero</label>
                        <input type="number" name="number" id="number" class="form-control" min="0" maxlength="2">
                      </div>
                    </div>

                    <div class="col-md-2" id="divPeriodo" hidden>
                      <div class="form-group">
                        <label for="rfc" class="col-form-label">Periodo*</label>
                        <select class="form-control" name="period" id="period">
                          <option disabled selected value="">Selecciona el periodo</option>
                          <option value="days">Dias</option>
                          <option value="month">Meses</option>
                          <option value="year">Años</option>
                        </select>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="contract" class="col-form-label">Numero de empleado</label>
                        <input type="number" name="employee_number" minlength="0" class="form-control">
                      </div>
                    </div>
                  </div>


                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="curp" class="col-form-label">CURP*</label>
                        <input type="text" name="curp" id="CURP" class="form-control" maxlength="18" required>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="nss" class="col-form-label">NSS</label>
                        <input type="text" name="nss" id="NSS" class="form-control" maxlength="11">
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="rfc" class="col-form-label">RFC</label>
                        <input type="text" name="rfc" id="RFC" class="form-control" maxlength="13">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="gender" class="col-form-label">Titulo profesional</label>
                        <input type="text" name="scholarship" id="scholarship" placeholder="Licenciatura" class="form-control">
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="gender" class="col-form-label">Sucursal*</label>
                        <?php $contactos = Utils::getEmpresaByContactoRH(); ?>
                        <select name="cliente" id="Cliente" class="form-control" required>
                          <option disabled selected value="">Selecciona comercio</option>
                          <?php foreach ($contactos as $contacto) : ?>
                            <option value="<?= $contacto['Cliente'] ?>"><?= $contacto['Nombre_Cliente'] ?></option>
                          <?php endforeach ?>
                        </select>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="col-form-label" for="id_razon">Razón social*</label>
                        <select class="form-control" name="id_razon" id="select_razon_social" required></select>
                      </div>
                    </div>

                    <?php if (Utils::isAdmin()) : ?>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="col-form-label" for="ID_Contacto">Contacto</label>
                          <select class="form-control" name="ID_Contacto" required></select>
                        </div>
                      </div>

                    <?php else : ?>
                      <input type="hidden" name="ID_Contacto" value="<?= Encryption::encode($id_contacto)  ?>">
                      <input type="hidden" name="Empresa" value="<?= Encryption::encode($Empresa)  ?>">
                    <?php endif; ?>
                  </div>


                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="col-label">Puesto*</label>
                        <select name="id_position" id="puesto" class="form-control" required>
                          <option disabled value="" selected>Selecciona puesto</option>
                          <option class="text-bold" value="0">Crear puesto</option>
                          <?php foreach ($positionObj as $pos) : ?>
                            <option value="<?= Encryption::encode($pos['id']) ?>"><?= $pos['title'] ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group" hidden id="new_position">
                        <label class="col-label">Crear puesto*</label>
                        <input type="text" name="new_position" id="new_position2" class="form-control">
                      </div>
                    </div>

                    <div class="col-md-6" hidden id="deparment">
                      <div class="form-group ">
                        <label class="col-label">Departamento*</label>
                        <select name="id_departament" id="departmentSelect" class="form-control">
                          <option disabled value="" selected>Selecciona departamento</option>
                          <option class="text-bold" value="0">Crear departamento</option>
                          <?php foreach ($deparment as $dep) : ?>
                            <option value=" <?= Encryption::encode($dep['id']) ?>"><?= $dep['department']  ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                    </div>

                    <div class="col-md-6" id="new_deparment" hidden>
                      <div class="form-group ">
                        <label class="col-label">Crear departamento*</label>
                        <input type="text" name="new_deparment" id="deparamentInput" class="form-control">
                      </div>
                    </div>
                  </div>

                  <div class="row" <?= count($type_positions) == 0 ? 'hidden' : '' ?>>
                    <div class="col-6">
                      <div class="form-group">
                        <label for="contract" class="col-form-label">A quien reporta </label>
                        <select class="form-control " name="id_boss">
                          <option selected value="0">Selecciona a quien reporta</option>
                          <?php foreach ($type_positions as $type_pos) : ?>
                            <option value="<?= Encryption::encode($type_pos['id_employee']) ?>"> <?= $type_pos['employePosition'] ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>

              </div>


              <div class="card-footer">
                <button class="btn btn-lg btn-orange float-right">Registrar Empleado</button>
              </div>

            </div>
          </form>
        </div>
      </div>

    </section>
  </div>
</div>

<script src="<?= base_url ?>app/RH/employee.js?v=<?= rand() ?>"></script>
<script type="text/javascript" src="<?= base_url ?>app/cliente.js?v=<?= rand() ?>"></script>

<script type="text/javascript">
  document.querySelector('#employee-form').addEventListener('submit', e => {
    e.preventDefault();
    let empleado = new Employee();
    empleado.save_empleado();
  });

  document.querySelector('#puesto').addEventListener('change', e => {
    if (document.querySelector('#puesto').value == 0) {
      document.querySelector('#new_position').hidden = false
      document.querySelector('#new_position2').required = true
      document.querySelector('#deparment').hidden = false
      document.querySelector('#departmentSelect').required = true
    } else {
      document.querySelector('#new_position').hidden = true
      document.querySelector('#new_position2').required = false
      document.querySelector('#deparment').hidden = true
      document.querySelector('#departmentSelect').required = false
      document.querySelector('#new_deparment').hidden = true
    }
  })

  document.querySelector('#departmentSelect').addEventListener('change', e => {
    if (document.querySelector('#departmentSelect').value == 0) {
      document.querySelector('#new_deparment').hidden = false
      document.querySelector('#deparamentInput').required = true

    } else {
      document.querySelector('#new_deparment').hidden = true
      document.querySelector('#deparamentInput').required = false
    }
  })

  var select = document.getElementById('selectContract');
  select.addEventListener('change', function() {
    let number = document.querySelector('#number'),
      period = document.querySelector('#period')

    if (select.selectedIndex == 5) {
      document.querySelector('#divNumber').hidden = true
      document.querySelector('#divPeriodo').hidden = true
      number.required = false
      period.required = false
    } else {
      document.querySelector('#divNumber').hidden = false
      document.querySelector('#divPeriodo').hidden = false
      number.required = true
      period.required = true
    }
  });


  var id_cliente = document.querySelector('#Cliente');
  id_cliente.addEventListener('change', e => {
    let cliente = new Employee();
    cliente.getContactosYRazonesPorCliente(id_cliente.value);
  })
</script>