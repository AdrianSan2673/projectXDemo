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
            <!-- /.card-header -->
            <div class="card-body">
            <table id="tb_servicios" class="table table-striped" style="font-size: 0.6rem;">
                <thead>
                    <tr>
                      <th class="align-middle">Cliente</th>
                      <th class="align-middle">Razón social</th>
                      <th class="align-middle">Candidato</th>
                      <th class="align-middle text-center">Servicio solicitado</th>
                      <th class="align-middle">Fase</th>
                      <th class="align-middle text-center">Entrega</th>
                      <th class="align-middle text-center">Estado</th>
                      <th class="align-middle text-center">Ejecutivo</th>
                      <th class="align-middle text-center">Solicita</th>
                      <th class="align-middle text-right">CC RHI</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($orders as $order): ?>
                    <tr>
                      <?php 
                         
                        if ($order['Servicio_Solicitado'] == 'ESE') 
                          $Color_Servicio_Solicitado = 'bg-navy';
                        elseif ($order['Servicio_Solicitado'] == 'INV. LABORAL') 
                          $Color_Servicio_Solicitado = 'bg-danger';
                        elseif ($order['Servicio_Solicitado'] == 'RAL')
                          $Color_Servicio_Solicitado = 'bg-warning';
                        else
                          $Color_Servicio_Solicitado = '';

                        if ($order['Fase'] == 'ESE' || $order['Fase'] == 'RAL + INV.LAB + ESE')
                          $Color_Fase = 'bg-navy';
                        elseif ($order['Fase'] == 'INV. LABORAL' || $order['Fase'] == 'RAL + INV.LAB')
                          $Color_Fase = 'bg-danger';
                        elseif ($order['Fase'] == 'RAL')
                          $Color_Fase = 'bg-warning';
                        else
                          $Color_Fase = '';
                        
                        ?>
                        <td><b><?=$order['Cliente']?></b></td>
                        <td><?=$order['Razon']?></td>
                        <td class="text-center align-middle"><?=$order['Nombre_Candidato']?></td>
                        <td class="<?=$Color_Servicio_Solicitado?>"><?=$order['Servicio_Solicitado']?></td>
                        <td class="text-center align-middle <?=$Color_Fase?>"><?=$order['Fase']?></td>
                        <td class="text-center align-middle"><?=Utils::getFullDate($order['Fecha_Entregado'])?></td>
                        <td class="text-center align-middle"><?=$order['Estado']?></td>
                        <td class="text-center align-middle"><?=$order['Ejecutivo']?></td>
                        <td class="text-right align-middle"><?=$order['Solicita']?></td>
                        <td class="text-right align-middle"><?=$order['CC']?></td>
                    </tr>
                <?php endforeach; ?>
                    
                </tbody>
                <tfoot>
                    <tr>
                      <th class="align-middle">Cliente</th>
                      <th class="align-middle">Razón social</th>
                      <th class="align-middle">Candidato</th>
                      <th class="align-middle text-center">Servicio solicitado</th>
                      <th class="align-middle">Fase</th>
                      <th class="align-middle text-center">Entrega</th>
                      <th class="align-middle text-center">Estado</th>
                      <th class="align-middle text-center">Ejecutivo</th>
                      <th class="align-middle text-center">Solicita</th>
                      <th class="align-middle text-right">CC RHI</th>
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
    let table = document.querySelector('#tb_servicios');
    utils.dtTable(table, false, false);
  });
</script>