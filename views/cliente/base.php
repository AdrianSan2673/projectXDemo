<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <div class="alert <?=$_SESSION['identity']->username == 'salmaperez' ? 'alert-maroon' : 'alert-success'?>">
                <h3>Base de contactos</h3>
            </div>
            
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="card car-success">
            <div class="card-header">
              <h3 class="card-title">Contactos de empresas</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="tb_contacts" class="table table-striped" style="display: none;">
                <thead>
                    <tr>
                      <th class="align-middle">Empresa</th>
                      <th class="text-center align-middle">Contacto</th>
                      <th class="text-center align-middle">Teléfono</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($base_contactos as $contacto): ?>
                    <tr>
                        <td class="text-left align-middle"><?=$contacto['Empresa']?></td>
                        <td class="text-center align-middle"><?=$contacto['Informante']?></td>
                        <td class="text-center align-middle"><?=$contacto['Telefono']?></td>
                    </tr>
                <?php endforeach; ?>
                    
                </tbody>
                <tfoot>
                    <tr>
                      <th>Empresa</th>
                      <th class="text-center align-middle">Contacto</th>
                      <th>Teléfono</th>
                    </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
        </div>
    </section>      
</div>
<script>
  document.addEventListener('DOMContentLoaded', e => {
    let table = document.querySelector('#tb_contacts');
    table.style.display = "table";
    utils.dtTable(table, true);
  })
</script>