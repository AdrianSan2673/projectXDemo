<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <div class="alert alert-success">
                <h4>Psicometrías de <?=$psycho->candidate?> solicitadas por <?=$psycho->customer?></h4>
            </div>       
          </div>
        </div>
        
        <div class="row">
            <div class="col-sm-2 mr-auto">
                <a class="btn btn-secondary btn-block float-left" href="<?=base_url?>psicometria/index">Regresar</a>
            </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-danger">
                <div class="card-header">
                    <h4 class="card-title">Datos de las psicometrías</h4>
                </div>
                <!-- /.card-header -->
                
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 text-center">
                            <b>Fecha de solicitud</b>
                            <p><?=$psycho->request_date?></p>
                        </div>
                        <div class="col-md-4 text-center">
                            <b>Nombre del candidato</b>
                            <p><?=$psycho->candidate?></p>
                        </div>
                        <div class="col-md-4 text-center">
                            <b>Cliente</b>
                            <p><?=$psycho->customer?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 text-center">
                            <b>Razón social</b>
                            <p><?=$psycho->business_name?></p>
                        </div>
                        <div class="col-md-4 text-center">
                            <b>Estado</b>
                            <p><?=$psycho->estado?></p>
                        </div>
                        <div class="col-md-4 text-center">
                            <b>Fecha de entrega</b>
                            <p><?=$psycho->end_date?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col text-center">
                            <b>Psicometrías</b>
                            <p><?=$psycho->behavior == 1 ? 'Comportamiento, ' : ''?><?=$psycho->intelligence == 1 ? 'Inteligencia, ' : ''?><?=$psycho->labor_competencies == 1 ? 'Competencias laborales, ' : ''?><?=$psycho->honesty_ethics_values == 1 ? 'Honestidad, ética y valores, ' : ''?><?=$psycho->personality == 1 ? 'Personalidad, ' : ''?><?=$psycho->sales_skills == 1 ? 'Habilidades de ventas, ' : ''?><?=$psycho->leadership == 1 ? 'Liderazgo' : ''?>
                            </p>
                        </div>
                    </div>
                    <?php if (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior()): ?>
                        <div class="text-center">
                            <a href="<?=base_url?>psicometria/editar&id=<?=$_GET['id']?>" class="btn btn-info">Editar</a>
                        </div>
                    <?php endif ?>
                </div>
                <!-- /.card-body -->
            </div>
            <?php if (!Utils::isCustomer() && ($psycho->status != 2 || $psycho->status != 3)): ?>
            <div class="card card-orange">
                <div class="card-header">
                    <h4 class="card-title">Psicometrías aplicadas</h4>
                </div>
                <div class="card-body">
                    <?php if (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior()): ?>
                        <div class="text-right">
                            <a href="<?=base_url?>psicometria/agregar&candidate=<?=Encryption::encode($psycho->id_candidate)?>" class="btn btn-success">Agregar psicometría</a>
                        </div>
                    <?php endif ?>
                    <br>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Tipo</th>
                                <?php if (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior()): ?>
                                    <th></th>
                                <?php endif ?>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach($psychometrics as $p): ?>
                            <tr>
                                <td><?=$p['type']?></td>
                                <?php if (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior()): ?>
                                    <td class="text-center py-0 align-middle">
                                        <?php if (isset($p['file'])): ?>
                                            <a href="<?=$p['file']?>" class="btn btn-success">
                                          <i class="fas fa-download"></i> Descargar
                                        </a>
                                        <?php endif ?>
                                      </div>
                                    </td>
                                <?php endif ?>
                                
                            </tr>
                        <?php endforeach; ?>
                            
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Tipo</th>
                                <?php if (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior()): ?>
                                    <th></th>
                                <?php endif ?>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>    
            <?php endif ?>
            
          </div>
          
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
</div>
