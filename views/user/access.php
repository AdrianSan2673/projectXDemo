<div class="content-wrapper">
  <div class="container">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <div class="alert alert-success">
              <h3>Permisos de usuario</h3>
            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
      <div class="card">
        <div class="card-body">
          <table id="tb_users" class="table table-sm table-striped">
            <thead>
              <tr>
                <th>Nombre</th>
                <th>Puesto</th>
                <th>Correo</th>
                <th>Teléfono</th>
                <th>Extensión</th>
                <th>Celular</th>
                <th>Cumpleaños</th>
                <th>Usuario</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($contactos as $contacto) : ?>
                <tr>
                  <td><?= $contacto['Nombre_Contacto'] . ' ' . $contacto['Apellido_Contacto'] ?></td>
                  <td><?= $contacto['Puesto'] ?></td>
                  <td><?= $contacto['Correo'] ?></td>
                  <td><?= $contacto['Telefono'] ?></td>
                  <td><?= $contacto['Extension'] ?></td>
                  <td><?= $contacto['Celular'] ?></td>
                  <td><?= $contacto['Fecha_Cumpleaños'] ?></td>
                  <td><?= $contacto['Usuario'] ?></td>
                  <td class="text-center py-0 align-middle">
                    <div class="btn-group btn-group-sm">
                      <button class="btn btn-warning" data-id="<?= Encryption::encode($contacto['id_user']) ?>">
                        <i class="fas fa-lock"></i>
                      </button>
                    </div>
                  </td>
                </tr>
              <?php endforeach; ?>
             </tbody>
            <tfoot>
              <tr>
                <th>Nombre</th>
                <th>Puesto</th>
                <th>Correo</th>
                <th>Teléfono</th>
                <th>Extensión</th>
                <th>Celular</th>
                <th>Cumpleaños</th>
                <th>Usuario</th>
                <th></th>
              </tr>
            </tfoot>
      </table>
      </div>
      <!-- /.card-body -->
  </div>
  </section>
</div>
</div>
<script>
  $(document).ready(function() {
    let table = document.querySelector('#tb_users');
    utils.dtTable(table);
    table.addEventListener('click', e => {
      e.preventDefault();
      if (e.target.classList.contains('btn-warning') || e.target.parentElement.classList.contains('btn-warning')) {
        $('#modal_permission').modal({
          backdrop: 'static',
          keyboard: false
        });
        let Id;
        if (e.target.classList.contains('btn-warning')) {
          Id = e.target.dataset.id;
          Nombre = e.target.parentElement.parentElement.parentElement.children[0].textContent;
          Puesto = e.target.parentElement.parentElement.parentElement.children[1].textContent;
        }
        else {
          Id = e.target.parentElement.dataset.id;
          Nombre = e.target.parentElement.parentElement.parentElement.parentElement.children[0].textContent;
          Puesto = e.target.parentElement.parentElement.parentElement.parentElement.children[1].textContent;
        }
        
        document.querySelectorAll('#modal_permission input')[0].value = Id;
        document.querySelectorAll('#modal_permission input')[1].value = Nombre;
        document.querySelectorAll('#modal_permission input')[2].value = Puesto;

        this.Id = Id;
        let xhr = new XMLHttpRequest();
        let data = `id_user=${this.Id}`;
        document.querySelectorAll('#modal_permission form .btn')[1].disabled = false;
        xhr.open('POST', '../usuario/getPermissions');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(data);
        xhr.onreadystatechange = function(){
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                try {
                  let json_app = JSON.parse(r);
                  if (json_app.status == 1) {
                    let accesos = '';
                    json_app.access.forEach(acceso => {
                      accesos += 
                      `<tr>
                            <th scope="row">${acceso.section_name}</th>
                            <!-- <td>
                                <div class="form-group text-center">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" ${acceso.create == 1 && acceso.read == 1 && acceso.update == 1 && acceso.delete == 1 ? 'checked' : ''} class="custom-control-input control" id="control_${acceso.id}" name="control_${acceso.id}">
                                        <label class="custom-control-label" for="control_${acceso.id}"></label>
                                    </div>
                                </div>
                            </td> -->
                            <td>
                                <div class="form-group text-center">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" ${acceso.create == 1 ? 'checked' : ''} class="custom-control-input" id="create_${acceso.id}" name="create_${acceso.id}">
                                        <label class="custom-control-label" for="create_${acceso.id}"></label>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="form-group text-center">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" ${acceso.read == 1 ? 'checked' : ''} class="custom-control-input" id="read_${acceso.id}" name="read_${acceso.id}">
                                        <label class="custom-control-label" for="read_${acceso.id}"></label>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="form-group text-center">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" ${acceso.update == 1 ? 'checked' : ''} class="custom-control-input" id="update_${acceso.id}" name="update_${acceso.id}">
                                        <label class="custom-control-label" for="update_${acceso.id}"></label>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="form-group text-center">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" ${acceso.delete == 1 ? 'checked' : ''} class="custom-control-input" id="delete_${acceso.id}" name="delete_${acceso.id}">
                                        <label class="custom-control-label" for="delete_${acceso.id}"></label>
                                    </div>
                                </div>
                            </td>
                        </tr>`;
                    });
                    document.querySelector('#modal_permission table tbody').innerHTML = accesos;
					$('#modal_permission').modal('hide');
                  }else {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                  }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                }
                    
          }
        }
      }

    })
  });
</script>