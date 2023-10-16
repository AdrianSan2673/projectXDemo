<div class="content-wrapper">
  <div class="container">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left mb-2">
              <li class="breadcrumb-item"><a href="<?=base_url?>">Inicio</a></li>
              <li class="breadcrumb-item"><a href="<?=base_url?>cliente/index">Clientes</a></li>
              <li class="breadcrumb-item active">Detallado</li>
            </ol>
          </div>
          <div class="col-sm-12">
            <div class="alert alert-success">
                <h3>Detallado vacantes</h3>
            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="card car-success">
            <div class="card-header">
              <h3 class="card-title">Detallado</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="tb_customers" class="table table-striped">
                <thead>
                    <tr>
                      <th class="align-middle text-center">Cliente</th>
                      <th class="align-middle text-center">Plaza</th>
                      <th class="align-middle text-center">Vacantes Ingresadas Enero</th>
                      <th class="align-middle text-center">Vacantes Ingresadas Febrero</th>
                      <th class="align-middle text-center">Total Anual Vacantes </th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($clientes as $cliente): ?>
                    <tr>
                        <td><?=$cliente['customer']?></td>
                        <td class="text-center"><?=$cliente['cost_center']?></td>
                        <td class="text-center"><?=($cliente['january'])?></td>
                        <td class="text-center"><?=($cliente['february'])?></td>
                        <td class="text-center"><?=($cliente['yearly'])?></td>
                    </tr>
                <?php endforeach; ?>
                    
                </tbody>
                <tfoot>
                    <tr>
                      <th class="align-middle text-center">Cliente</th>
                      <th class="align-middle text-center">Plaza</th>
                      <th class="align-middle text-center">Vacantes Ingresadas</th>
                      <th class="align-middle text-center">Vacantes Ingresadas</th>
                      <th class="align-middle text-center">Total Anual Vacantes </th>
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
  $(document).ready(function(){
    let table = document.querySelector('#tb_customers');
    utils.dtTable(table);
  });
</script>