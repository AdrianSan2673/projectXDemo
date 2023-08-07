<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left mb-2">
              <li class="breadcrumb-item"><a href="<?=base_url?>">Inicio</a></li>
              <li class="breadcrumb-item"><a href="<?=base_url?>cliente_SA/index">Clientes</a></li>
              <li class="breadcrumb-item active">Contactos</li>
            </ol>
          </div>
          <div class="col-sm-12">
            <div class="alert alert-success">
                <h3>Contactos</h3>
            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <br>
    <!-- Main content -->
    <section class="content">
        <div class="card">
            <div class="card-header">
              <h3 class="card-title">Listado de contactos</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="tb_contacts" class="table table-sm table-striped">
                  <thead>
                      <tr>
                          <th class="text-center">Foto</th>
                          <th>Nombre</th>
                          <th>Puesto</th>
                          <th>Empresa</th>
                          <th>Correo</th>
                          <th>Teléfono</th>
                          <th>Extensión</th>
                          <th>Celular</th>
                          <th>Cumpleaños</th>
                          <th>Usuario</th>
                      </tr>
                  </thead>
                  <tbody>
                  <?php foreach($contactos as $contacto): ?>
                      <tr>
                          <td class="image"><img class="img-circle img-fluid img-responsive elevation-2" src="<?=$contacto['avatar']?>" style="width:60px; height:auto;"></td>
                          <td><?=$contacto['Nombre_Contacto'].' '.$contacto['Apellido_Contacto']?></td>
                          <td><?=$contacto['Puesto']?></td>
                          <td><?=$contacto['Nombre_Empresa']?></td>
                          <td><?=$contacto['Correo']?></td>
                          <td><?=$contacto['Telefono']?></td>
                          <td><?=$contacto['Extension']?></td>
                          <td><?=$contacto['Celular']?></td>
                          <td><?=$contacto['Fecha_Cumpleaños']?></td>
                          <td><?=$contacto['Usuario']?></td>
                      </tr>
                  <?php endforeach; ?>
                      
                  </tbody>
                  <tfoot>
                      <tr>
                          <th class="text-center">Foto</th>
                          <th>Nombre</th>
                          <th>Puesto</th>
                          <th>Empresa</th>
                          <th>Correo</th>
                          <th>Teléfono</th>
                          <th>Extensión</th>
                          <th>Celular</th>
                          <th>Cumpleaños</th>
                          <th>Usuario</th>                     
                      </tr>
                  </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
        </div>
    </section>       
</div>
<script>
  $(document).ready(function(){
    let table = document.querySelector('#tb_contacts');
    utils.dtTable(table);
  });
</script>