<style>
  .form-control-plaintext{
    font-size: 0.6rem !important;
  }
</style>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <div class="alert alert-success">
              <h4>Solicitud de múltiples Servicios de Apoyo</h4>
          </div>         
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Instrucciones</h4>
            </div>
            <div class="card-body">
              <ul class="list-group">
                <li class="list-group-item">Lo primero, necesitará el layout para llenar los datos de sus candidatos. Haga clic en <a class="btn btn-success" href="<?=base_url?>Reporte/layout_candidatos">Descargar Layout</a></li>
                <li class="list-group-item">Abra el archivo Excel que acaba de descargar. En este archivo encontrará una tabla con las columnas correspondientes a los datos que debe proporcionar. No modifique el encabezado de las columnas ya que esto puede generar errores al cargar los datos.</li>
                <li class="list-group-item">Llene las celdas correspondientes con la información requerida. Asegúrese de completar toda la información necesaria, ya que esto garantizará que la carga de datos sea exitosa.</li>
                <li class="list-group-item">Una vez que haya llenado todas las celdas, guarde el archivo en su computadora. Utilice un nombre de archivo que sea fácil de recordar y que refleje el contenido del archivo.</li>
                <li class="list-group-item">Regrese a esta página web y ubique la sección correspondiente a la carga del archivo Excel. Allí encontrará un botón para cargar el archivo. Haga clic en el botón para cargar el archivo.</li>
                <li class="list-group-item">Busque el archivo Excel que acaba de completar, selecciónelo y haga clic en Importar datos. Espere a que se complete el proceso de carga de datos. Dependiendo del tamaño del archivo y de la velocidad de conexión, esto puede tomar algunos segundos.</li>
                <li class="list-group-item">Una vez que se complete el proceso de carga, verifique que todos los datos se hayan cargado correctamente. Si hay algún error en el archivo, se le notificará en la página web. Si todo está correcto, se le notificará que los datos se han cargado exitosamente.</li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-md-12">
          <!-- form start -->
          <form method="POST" id="SA_form">
            <!-- general form elements -->
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Carga de datos de candidatos desde archivo de Excel</h4>
              </div>
              <div class="card-body">
                <div class="form-group">
                  <label class="col-form-label" for="excel">Seleccionar archivo</label>
                  <input type="file" class="form-control" id="excel" name="excel" accept=" application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
                </div> 
              </div>
              <div class="card-footer">
                <div class="form-group text-center">
                  <input type="submit" id="btn-import" style="display: none;" value="Importar datos" class="btn btn-lg btn-info">
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
      <!-- /.row -->
      <div id="row-table" class="row" style="display: none;">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Solicitudes por cargar</h4>
            </div>
            <form method="post" id="list-form">
              <div class="card-body table-responsive p-0" style="height: 400px;">
                <table class="table table-head-fixed table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>Nombre</th>
                      <th>Apellido Paterno</th>
                      <th>Apellido Materno</th>
                      <th>Servicio Solicitado</th>
                      <th>Municipio</th>
                      <th>Estado MX</th>
                      <th>Clave Única de Registro de Población</th>
                      <th>Número Seguridad Social</th>
                      <th>Fecha Nac.</th>
                      <th>Lugar Nacimiento</th>
                      <th>Teléfono</th>
                      <th>Puesto</th>
                      <th>Nombre Comercial</th>
                      <th>Razón Social</th>
                      <th>Ejecutivo</th>
                      <th>Centro de Costos</th>
                      <th>Nivel Organizacional</th>
                      <th>Comentarios</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
              <div class="card-footer">
                <input type="submit" class="btn btn-lg btn-orange float-right" value="Subir candidatos">
              </div>
            </form>
              
          </div>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
</div>
<script>
  let formattedDate = function(date){

    const fecha = new Date(date);

    const year = fecha.getFullYear();
    const month = fecha.getMonth() + 1;
    const day = fecha.getDate();

    const formattedMonth = month < 10 ? `0${month}` : month;
    const formattedDay = day < 10 ? `0${day}` : day;

    const formattedDate = `${year}-${formattedMonth}-${formattedDay}`;
    return formattedDate;
    }

  document.querySelector('#SA_form').addEventListener('submit', e => {
    e.preventDefault();
    var form = document.querySelector("#SA_form");
    var formData = new FormData(form);
    //form.querySelectorAll('.btn')[0].disabled = true;
      
    let xhr = new XMLHttpRequest();
    xhr.open('POST', '../Reporte/cargaSA');
    xhr.send(formData);

    xhr.onreadystatechange = function(){
        if (xhr.readyState == 4 && xhr.status == 200) {
            let r = xhr.responseText;
            console.log(r);
            try {
                let json_app = JSON.parse(r);
                let data = json_app.data;
                let EstadosMX = json_app.EstadosMX;
                let Clientes = json_app.Clientes;
                let Servicio_Solicitado = json_app.Servicio_Solicitado;
                let Nivel = json_app.Nivel;
                let data_table = '';
                let selectEstados = '';
                let selectClientes = '';
                let selectRazones = '';
                let selectEjecutivos = '';
                let selectServicio = '';
                let selectNivel = '';
                for (let i = 0; i < EstadosMX.length; i++) {
                  selectEstados += `<option value="${EstadosMX[i].Estado}">${EstadosMX[i].Descripcion}</option>`;
                }
                for (let i = 0; i < Clientes.length; i++) {
                  selectClientes += `<option value="${Clientes[i].Cliente}">${Clientes[i].Nombre_Cliente}</option>`;
                }
                for (let i = 0; i < Servicio_Solicitado.length; i++) {
                  selectServicio += `<option value="${Servicio_Solicitado[i].id}">${Servicio_Solicitado[i].Servicio}</option>`;
                }
                for (let i = 0; i < Nivel.length; i++) {
                  selectNivel += `<option value="${Nivel[i].id}">${Nivel[i].Nivel}</option>`;
                }
                for (let i = 0; i < data.length; i++) {
                  let Fecha_de_Nacimiento = formattedDate((data[i].Fecha_de_Nacimiento - (25567 + 1)) * 86400 * 1000)
                    
                  data_table += `
                    <tr>
                      <td><input type="text" class="form-control-plaintext" name="Nombres[]" value="${data[i].Nombres}"></td>
                      <td><input type="text" class="form-control-plaintext" name="Apellido_Paterno[]" value="${data[i].Apellido_Paterno}"></td>
                      <td><input type="text" class="form-control-plaintext" name="Apellido_Materno[]" value="${data[i].Apellido_Materno}"></td>
                      <td><select class="form-control-plaintext" name="Servicio_Solicitado[]">${selectServicio}</select></td>
                      <td><input type="text" class="form-control-plaintext" name="Ciudad[]" value="${data[i].Municipio}"></td>
                      <td><select class="form-control-plaintext" name="Estado[]">${selectEstados}</select></td>
                      <td><input type="text" class="form-control-plaintext" name="CURP[]" value="${data[i].CURP}"></td>
                      <td><input type="text" class="form-control-plaintext" name="NSS[]" value="${data[i].Numero_Seguridad_Social}"></td>
                      <td><input type="date" class="form-control-plaintext" name="Fecha_Nacimiento[]" value="${Fecha_de_Nacimiento}"></td>
                      <td><input type="text" class="form-control-plaintext" name="Lugar_Nacimiento[]" value="${data[i].Lugar_de_Nacimiento}"></td>
                      <td><input type="text" class="form-control-plaintext" name="Telefono[]" value="${data[i].Telefono}"></td>
                      <td><input type="text" class="form-control-plaintext" name="Puesto[]" value="${data[i].Puesto}"></td>
                      <td><select class="form-control-plaintext" name="Cliente[]">${selectClientes}</select></td>
                      <td><select class="form-control-plaintext" name="Razon[]">${selectRazones}</select></td>
                      <td><select class="form-control-plaintext" name="Ejecutivo[]">${selectEjecutivos}</select></td>
                      <td><input type="text" class="form-control-plaintext" name="CC_Cliente[]" value="${data[i].Centro_Costos}"></td>
                      <td><select class="form-control-plaintext" name="Nivel[]">${selectNivel}</select></td>
                      <td><textarea class="form-control-plaintext" rows="3" name="Comentarios_Cliente[]">${data[i].Comentarios}</textarea></td>
                    </tr>`;

                }
                let tabla = document.querySelector('table tbody');
                tabla.innerHTML = data_table;
                for (let i = 0; i < data.length; i++) {
                  let optionsEstados = document.getElementsByName('Estado[]')[i].options;
                  for (let j = 0; j < optionsEstados.length; j++) {
                    if (optionsEstados[j].text == data[i].Estado_MX){
                      optionsEstados[j].selected = true;
                      continue;
                    }
                  }
                  let optionsClientes = document.getElementsByName('Cliente[]')[i].options;
                  for (let j = 0; j < optionsClientes.length; j++) {
                    if (optionsClientes[j].text == data[i].Nombre_Comercial){
                      optionsClientes[j].selected = true;
                      continue;
                    }
                  }
                  let optionsServicio = document.getElementsByName('Servicio_Solicitado[]')[i].options;
                  for (let j = 0; j < optionsServicio.length; j++) {
                    if (optionsServicio[j].text == data[i].Servicio_Solicitado){
                      optionsServicio[j].selected = true;
                      continue;
                    }
                  }
                  let optionsNivel = document.getElementsByName('Nivel[]')[i].options;
                  for (let j = 0; j < optionsNivel.length; j++) {
                    if (optionsNivel[j].text == data[i].Nivel_Organizacional){
                      optionsNivel[j].selected = true;
                      continue;
                    }
                  }
                  if (data[i].Razones) {
                    for (let j = 0; j < data[i].Razones.length; j++) {
                      selectRazones = `<option value="${data[i].Razones[j]}" ${data[i].Razones[j] == data[i].Razon_Social ? "selected" : ""}>${data[i].Razones[j]}</option>`;
                    }
                    document.getElementsByName('Razon[]')[i].innerHTML = selectRazones;
                  }
                  if (data[i].Ejecutivos) {
                    for (let j = 0; j < data[i].Ejecutivos.length; j++) {
                      selectEjecutivos = `<option value="${data[i].Ejecutivos[j]}">${data[i].Ejecutivos[j]}</option>`;
                    }
                    document.getElementsByName('Ejecutivo[]')[i].innerHTML = selectEjecutivos;
                  }
                }
                document.querySelector('#row-table').style.display = "flex";
            } catch (error) {
              console.log(error)
                //form.querySelectorAll('.btn')[0].disabled = false;
                //utils.showToast('Algo salió mal. Inténtalo de nuevo '+error, 'error');
            }
        }
    }
  })

  document.querySelector('#list-form').addEventListener('submit', e => {
    e.preventDefault();
    var form = document.querySelector("#list-form");
    var formData = new FormData(form);
    form.querySelectorAll('.btn')[0].disabled = true;
      
    let xhr = new XMLHttpRequest();
    xhr.open('POST', '../ServicioApoyo/create_multiple');
    xhr.send(formData);

    xhr.onreadystatechange = function(){
        if (xhr.readyState == 4 && xhr.status == 200) {
            let r = xhr.responseText;
			console.log(r);
			let json_app = JSON.parse(r);
            if(json_app.status == 0){
				form.querySelectorAll('.btn')[0].disabled = false;
				utils.showToast('Omitiste algún dato','error');
			}else if(json_app.status == 1){
				utils.showToast('Los candidatos fue registrados exitosamente', 'success');
				setTimeout(() => { location.reload();}, 3000);
			}
        }
    }
  })
  let excel = document.querySelector('#excel');
  let btn_import = document.querySelector('#btn-import');
  excel.addEventListener('change', e => {
    if (excel.value)
      btn_import.style.display = 'inline-block'
    else
      btn_import.style.display = 'none';
  })
</script>