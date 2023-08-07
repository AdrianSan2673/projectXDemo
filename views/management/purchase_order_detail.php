<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <div class="alert alert-success">
                <h3>Detalle de órden de compra <?=$folio?></h3>
            </div> 
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <a class="btn btn-info float-left" href="javascript: history.back()">Regresar</a>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <br>
    <!-- Main content -->
    <section class="content">
        <div class="card">
            <div class="card-header">
              <h3 class="card-title">Listado de vacantes</h3>
            </div>
            <div class="card-body">
              <table id="tb_vacancies" class="table table-bordered table-striped" style="font-size: 0.6rem;">
                <thead>
                    <tr>
                      <th class="align-middle">Cliente</th>
                      <th class="align-middle">Razón social</th>
                      <th class="align-middle text-center">Vacante</th>
                      <th class="align-middle">Candidato</th>
                      <th class="align-middle text-center">Estado</th>
                      <th class="align-middle text-center">Ejecutivo</th>
                      <th class="align-middle text-center">Solicita</th>
                      <th class="align-middle text-center">CC RHI</th>
                      <th class="align-middle text-right">Monto</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($orders as $order): ?>
                    <tr>
                        <?php switch ($order['id_status']) {
                          case 1: $class_color = 'bg-info';break;
                          case 2: $class_color = 'bg-success';break;
                          case 3: $class_color = 'bg-warning';break;
                          case 4: $class_color = 'bg-navy';break;
                          case 5: $class_color = 'bg-danger';break;
                          default: $class_color = '';break;
                        }
                        ?>
                        <td><b><?=$order['customer']?></b></td>
                        <td><?=$order['business_name']?></td>
                        <td class="text-center align-middle"><?=$order['vacancy']?></td>
                        <td><?=$order['candidate']?></td>
                        <td class="text-center align-middle <?=$class_color?>"><?=$order['status']?></td>
                        <td class="text-center align-middle"><?=$order['recruiter']?></td>
                        <td class="text-center align-middle"><?=$order['customer_contact']?></td>
                        <td class="text-center align-middle"><?=$order['cost_center']?></td>
                        <td class="text-right align-middle">$ <?=number_format($order['amount'])?></td>
                    </tr>
                <?php endforeach; ?>
                    
                </tbody>
                <tfoot>
                    <tr>
                      <th class="align-middle">Cliente</th>
                      <th class="align-middle">Razón social</th>
                      <th class="align-middle text-center">Vacante</th>
                      <th class="align-middle">Candidato</th>
                      <th class="align-middle text-center">Estado</th>
                      <th class="align-middle text-center">Ejecutivo</th>
                      <th class="align-middle text-center">Solicita</th>
                      <th class="align-middle text-center">CC RHI</th>
                      <th class="align-middle text-right">Monto</th>
                    </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
        </div>
        <div class="card card-navy">
            <div class="card-header">
              <h3 class="card-title">Listado de psicometrías</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="tb_psychometrics" class="table table-bordered table-striped" style="font-size: 0.6rem;">
                <thead>
                  <tr>
                      <th class="align-middle text-center">Cliente</th>
                      <th class="align-middle text-center">Razón social</th>
                      <th class="align-middle text-center">Psicometría</th>
                      <th class="align-middle text-center">Candidato</th>
                      <th class="align-middle text-center">Estado</th>
                      <th class="align-middle text-right">Monto</th>
                    </tr>
                </thead>
                <tbody>
                  <?php foreach($psychometrics as $psycho): ?>
                      <tr>
                          <?php switch ($psycho['status']) {
                            case 1: $class_color = 'bg-warning';break;
                            case 2: $class_color = 'bg-success';break;
                            case 3: $class_color = 'bg-info';break;
                            default: $class_color = '';break;
                          }
                          ?>
                          <td class="text-center align-middle"><?=$psycho['customer']?></td>
                          <td class="text-center align-middle"><?=$psycho['business_name']?></td>
                          <td class="text-center align-middle"><?=$psycho['type']?></td>
                          <td class="text-center align-middle"><?=$psycho['first_name'].' '.$psycho['surname'].' '.$psycho['last_name']?></td>
                          <td class="text-center align-middle <?=$class_color?>"><?=$psycho['estado']?></td>
                          <td class="text-right align-middle">$ <?=number_format($psycho['amount'])?></td>
                      </tr>
                  <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                      <th class="align-middle text-center">Cliente</th>
                      <th class="align-middle text-center">Razón social</th>
                      <th class="align-middle text-center">Psicometría</th>
                      <th class="align-middle text-center">Candidato</th>
                      <th class="align-middle text-center">Estado</th>
                      <th class="align-middle text-right">Monto</th>
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
    let table = document.querySelector('#tb_vacancies');
    utils.dtTable(table);

    let table2 = document.querySelector('#tb_psychometrics');
    utils.dtTable(table2);
  });
</script>