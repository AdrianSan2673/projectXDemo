<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <div class="alert alert-success">
                <h3>Atracciones de Talento</h3>
            </div>
            
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content-header">
      <div class="row">
        <div class="col-sm-2 ml-auto">
          <button class="btn btn-orange float-right" id="btn_new_attraction">Solicitar Atracción de Talento</button>
        </div>
      </div>
    </section>
    <section class="content">
        <div class="card car-success">
            <div class="card-header">
              <h3 class="card-title">Atracciones de Talento</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="tb_attractions" class="table table-striped">
                <thead>
                  <tr>
                    <th class="align-middle">Puesto</th>
                    <th class="align-middle">Cliente</th>
                    <th class="align-middle">Fecha Solicitud</th>
                    <th class="align-middle">Fecha finalización</th>
                    <th class="align-middle">Ciudad</th>
                    <th class="align-middle">Sueldo</th>
                    <th class="align-middle">Estatus</th>
                    <th class="text-center">Acciones</th>
                  </tr>
                </thead>
                <tbody>
                <?php foreach($attractions as $at): ?>
                    <tr>
                        <td class="align-middle"><?=$at['job_title']?></td>
                        <td class="text-left align-middle"><?=$at['customer']?></td>
                        <td class="align-middle"><?=($at['request_date'])?></td>
                        <td class="align-middle"><?=($at['end_date'])?></td>
                        <td class="align-middle"><?=$at['city'].', '.$at['abbreviation']?></td>
                        <td class="align-middle">$ <?=number_format($at['salary'], 2)?></td>
                        <td class="align-middle"><?=$at['estatus']?></td>
                        <td class="text-center py-0 align-middle">
                            <button class="btn btn-info" data-id="<?=$at['id']?>">
                                <i class="fas fa-pencil-alt"></i>
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
                    
                </tbody>
                <tfoot>
                    <tr>
                      <th class="align-middle">Puesto</th>
                      <th class="align-middle">Cliente</th>
                      <th class="align-middle">Fecha Solicitud</th>
                      <th class="align-middle">Fecha finalización</th>
                      <th class="align-middle">Ciudad</th>
                      <th class="align-middle">Sueldo</th>
                      <th class="align-middle">Estatus</th>
                      <th class="text-center">Acciones</th>
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
    let table = document.querySelector('#tb_attractions');
    utils.dtTable(table);
  });
</script>