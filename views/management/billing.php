<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <div class="alert alert-success">
                <h3>Facturación (vacantes)</h3>
            </div>
            
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content-header">
      <div class="container-fluid">
        <form method="POST" action="<?=base_url."administracion/facturacion"?>" class="row">
          <div class="col-12 col-md-5">
            <div class="form-group">
              <label for="start_date" class="col-form-label">Fecha inicial:</label>
              <input type="date" name="start_date" id="start_date" value="<?=isset($_POST['start_date']) ? $_POST['start_date'] : date('Y-m-d', strtotime("-" . date('w') . " days"))?>" class="form-control">
            </div>
          </div>
          <div class="col-12 col-md-5">
            <div class="form-group">
              <label for="end_date" class="col-form-label">Fecha final:</label>
              <input type="date" name="end_date" id="end_date" value="<?=isset($_POST['end_date']) ? $_POST['end_date'] : date('Y-m-d')?>" class="form-control">
            </div>
          </div>
          <div class="col-12 col-md-2" style="padding-right: 14px;">
              <button type="submit" name="search" id="search" class="btn btn-app btn-block btn-info" style="background-color: #17a2b8; color: #fff;"><i class="fas fa-search"></i>Buscar</button>
          </div>
        </form>
        <hr>
        <div class="row">
          <div class="col-lg-3 col-12">
              <div class="small-box bg-orange">
                  <div class="inner">
                      <h5><?=count($vacancies)?></h5>
                      
                      <p style="font-size: 0.8rem">Operaciones</p>
                      <p style="font-size: 0.8rem">Ingresadas</p>
                  </div>
                  <div class="icon">
                      <i class="ion ion-clipboard"></i>
                  </div>
              </div>
          </div>
          <div class="col-lg-3 col-12">
              <div class="small-box bg-info">
                  <div class="inner">
                      <h5>??</h5>
                      <p style="font-size: 0.8rem">En proceso de OC</p>
                      <h5>$</h5>
                  </div>
                  <div class="icon">
                      <i class="ion ion-android-sync"></i>
                  </div>
              </div>
          </div>
          <div class="col-lg-3 col-12">
              <div class="small-box bg-success">
                  <div class="inner">
                      <h4>??</h4>
                      <p style="font-size: 0.8rem">Facturadas</p>
                      <h5>$??</h5>
                  </div>
                  <div class="icon">
                      <i class="ion ion-cash"></i>
                  </div>
              </div>
          </div>
        </div>
      </div>  
    </section>
    <br>
    <!-- Main content -->
    <section class="content">
        <div class="card car-success">
            <div class="card-header">
              <h3 class="card-title">Listado de vacantes</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <form method="POST">
                <!-- <input type="submit" name="submit" class="btn btn-success btn-block btn-lg" value="Guardar"> -->
                <table id="tb_vacancies" class="table table-striped table-responsive" style="font-size: 0.6rem;">
                  <thead>
                      <tr>
                        <th class="align-middle">Fecha de recepción</th>
                        <th class="align-middle">Cliente</th>
                        <th class="align-middle text-center">Facturable a</th>
                        <th class="align-middle">Vacante</th>
                        <th class="align-middle text-center">Candidato</th>
                        <th class="align-middle">Ciudad</th>
                        <th class="align-middle text-center">Sueldo</th>
                        <th class="align-middle">Estado vacante</th>
                        <th class="align-middle">Reclutador</th>
                        <th class="align-middle">Folio</th>
                        <th></th>
                      </tr>
                  </thead>
                  <tbody>
                  <?php foreach($vacancies as $vacancy): ?>
                      <tr>
                          <?php switch ($vacancy['id_status']) {
                            case 1: $class_color = 'bg-info';break;
                            case 2: $class_color = 'bg-success';break;
                            case 3: $class_color = 'bg-orange';break;
                            case 4: $class_color = 'bg-navy';break;
                            case 5: $class_color = 'bg-danger';break;
                            default: $class_color = '';break;
                          }
                          ?>
                          <td><?=Utils::getShortDate($vacancy['request_date']);?></td>
                          <td><b><?=$vacancy['customer']?></b></td>
                          <td><?=$vacancy['business_name']?></td>
                          <td><?=$vacancy['vacancy']?></td>
                          <td><?=$vacancy['candidate']?></td>
                          <td><?=$vacancy['city'].', '.$vacancy['abbreviation']?></td>
                          <td class="align-middle text-center">$<?=$vacancy['salary_min'] != $vacancy['salary_max'] ? number_format($vacancy['salary_min'])  .' - $'.number_format($vacancy['salary_max']) : number_format($vacancy['salary_min'])?></td>
                          <td class="text-center <?=$class_color?>"><?=$vacancy['status']?></td>
                          <td><?=$vacancy['recruiter']?></td>
                          <td class="text-center align-middle"><span name="folio<?=$vacancy['id_applicant']?>" id="folio<?=$vacancy['id_applicant']?>"><?=$vacancy['folio']?></span></td>
                          <td class="text-center py-0 align-middle">
                              <div class="btn-group btn-group-sm">
                                <button type="button" id="<?=$vacancy['id_applicant']?>" class="btn btn-info btn-edit"><i class="fas fa-pencil-alt"></i></button>
                              </div>
                          </td>
                      </tr>
                  <?php endforeach; ?>
                      
                  </tbody>
                  <tfoot>
                      <tr>
                        <th class="align-middle">Fecha de recepción</th>
                        <th class="align-middle">Cliente</th>
                        <th class="align-middle text-center">Facturable a</th>
                        <th class="align-middle">Vacante</th>
                        <th class="align-middle text-center">Candidato</th>
                        <th class="align-middle">Ciudad</th>
                        <th class="align-middle text-center">Sueldo</th>
                        <th class="align-middle">Estado vacante</th>
                        <th class="align-middle">Reclutador</th>
                        <th class="align-middle">Folio</th>
                        <th></th>
                      </tr>
                  </tfoot>
                </table>
              </form>
                
            </div>
            <!-- /.card-body -->
        </div>
    </section>
</div>
<div class="modal fade" id="modal_edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="update-form">
                <div class="modal-header">
                    <h4 class="modal-title">Editar</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id_applicant" id="id_applicant">
                    <input type="hidden" name="id_customer" id="id_customer">
                    <input type="hidden" name="id_business_name" id="id_business_name">
                    <input type="hidden" name="id_purchase_order" id="id_purchase_order">
                    <div class="form-group mb-3">
                        <label class="col-form-label" for="vacancy">Vacante</label>
                        <input type="text" class="form-control" name="vacancy" id="vacancy" readonly>
                    </div>
                    <div class="form-group mb-3">
                        <label class="col-form-label" for="customer">Cliente</label>
                        <input type="text" class="form-control" id="customer" name="customer" readonly>
                    </div>
                    <div class="form-group mb-3">
                        <label class="col-form-label" for="candidate">Candidato</label>
                        <input type="text" class="form-control" name="candidate" id="candidate" readonly>
                    </div>
                    <div class="form-group mb-3">
                        <label class="col-form-label" for="entry_date">Fecha de Ingreso</label>
                        <input type="date" class="form-control" id="entry_date" name="entry_date">
                    </div>
                    <div class="form-group mb-3">
                        <label class="col-form-label" for="folio">Folio</label>
                        <input type="text" class="form-control" id="folio" name="folio" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">
                    </div>
                    <div class="form-group mb-3">
                        <label class="col-form-label" for="amount">Monto</label>
                        <input type="number" class="form-control" id="amount" name="amount" placeholder="$" step=".01">
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <input type="submit" name="submit" id="submit" class="btn btn-orange" value="Guardar">
                </div>
            </form>
        </div>
    </div>              
</div>
<script src="<?=base_url?>app/applicant.js?v=<?=rand()?>"></script>
<script>
  $(document).ready(function(){
    let table = document.querySelector('#tb_vacancies');
    utils.dtTable(table,false, false);

    $("#tb_vacancies").on('click','.btn-edit', function () { 
        let applicant = new Applicant();
        applicant.getApplicant($(this).attr('id'));
    });
    
    document.querySelector("#update-form").onsubmit = function(e){
      e.preventDefault();
      let applicant = new Applicant();
      applicant.update_folio();
    };
  });
</script>
