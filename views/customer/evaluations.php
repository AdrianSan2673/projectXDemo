<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <div class="alert alert-success">
                <h3>Últimas evaluaciones de nuestros clientes</h3>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-2 mr-auto">
            <a class="btn btn-secondary btn-block float-left" href="<?=base_url?>cliente/index">Regresar</a>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="card car-success">
            <div class="card-header">
              <h3 class="card-title">Listado de clientes</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="tb_customers" class="table table-striped">
                <thead>
                    <tr>
                      <th>Cliente</th>
                      <th>Alias</th>
                      <th class="text-center align-middle">Centro de costo</th>
                      <th class="align-middle text-center">Fecha</th>
                      <!-- <th class="align-middle text-center">Tiempo de respuesta</th> -->
                      <th class="align-middle text-center">Tiempo de recepción de candidatos</th>
                      <th class="align-middle text-center">Comunicación con su ejecutivo</th>
                      <th class="align-middle text-center">Amabilidad de su ejecutivo</th>
                      <th class="align-middle text-center">Calidad de los candidatos</th>
                      <th class="align-middle text-center">Total</th>
                      <th class="align-middle text-center">Comentarios</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($customers as $customer): ?>
                    <tr>
                        <td><?=$customer['customer']?></td>
                        <td><?=$customer['alias']?></td>
                        <td class="text-center"><?=$customer['cost_center']?></td>
                        <td class="text-center"><?=Utils::getFullDate($customer['created_at'])?></td>
                        <!-- <td class="text-center"><?=$customer['response_time']?></td> -->
                        <td class="text-center"><?=$customer['reception_time']?></td>
                        <td class="text-center"><?=$customer['communication_with_executive']?></td>
                        <td class="text-center"><?=$customer['executive_friendliness']?></td>
                        <td class="text-center"><?=$customer['quality_of_candidates']?></td>
                        <td class="text-center"><b><?=number_format($customer['score'], 1)?></b></td>
                        <td><?=$customer['comments']?></td>
                    </tr>
                <?php endforeach; ?>
                    
                </tbody>
                <tfoot>
                    <tr>
                      <th>Cliente</th>
                      <th>Alias</th>
                      <th class="text-center align-middle">Centro de costo</th>
                      <th class="align-middle text-center">Fecha</th>
                      <!-- <th class="align-middle text-center">Tiempo de respuesta</th> -->
                      <th class="align-middle text-center">Tiempo de recepción de candidatos</th>
                      <th class="align-middle text-center">Comunicación con su ejecutivo</th>
                      <th class="align-middle text-center">Amabilidad de su ejecutivo</th>
                      <th class="align-middle text-center">Calidad de los candidatos</th>
                      <th class="align-middle text-center">Total</th>
                      <th class="align-middle text-center">Comentarios</th>
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
    let table = document.querySelector('#tb_customers');
    utils.dtTable(table);
  });
</script>