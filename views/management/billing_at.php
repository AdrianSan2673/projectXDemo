<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <div class="alert alert-success">
                <h3>Facturación (atracción de talento)</h3>
            </div>
            
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content-header">
      <div class="container-fluid">
        <form method="POST" action="<?=base_url."administracion/facturacion_at"?>" class="row">
          <div class="col-12 col-md-5">
            <div class="form-group">
              <label for="start_date" class="col-form-label">Fecha inicial:</label>
              <input type="date" name="start_date" id="start_date" value="<?=isset($_POST['start_date']) ? $_POST['start_date'] : date('Y-m-d', strtotime('-60 days'))?>" class="form-control">
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
                      <h5><?=count($attractions)?></h5>
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
        <div class="card card-success">
            <div class="card-header">
              <h3 class="card-title">Atracciones de Talento</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <form method="POST">
                <!-- <input type="submit" name="submit" class="btn btn-success btn-block btn-lg" value="Guardar"> -->
                <table id="tb_attractions" class="table table-striped">
                  <thead>
                    <tr>
                      <th></th>
                      <th></th>
                      <th class="filterhead"></th>
                      <th class="filterhead"></th>
                      <th class="filterhead"></th>
                      <th></th>
                      <th></th>
                      <th></th>
                    </tr>
                    <tr>
                      <th class="align-middle text-center">Fecha solicitud</th>
                      <th class="align-middle text-center">Puesto</th>
                      <th class="align-middle text-center">Cliente</th>
                      <th class="align-middle text-center">Razón social</th>
                      <th class="align-middle text-center">Estatus</th>
                      <th class="align-middle text-center">Fecha de entrega</th>
                      <th class="align-middle text-center">Folio</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($attractions as $attraction): ?>
                        <tr>
                            <?php switch ($attraction['estatus']) {
                              case 1: $class_color = 'bg-orange';break;
                              case 2: $class_color = 'bg-success';break;
                              case 3: $class_color = 'bg-info';break;
                              default: $class_color = '';break; } ?>
                            <td class="text-center align-middle"><?=Utils::getShortDate($attraction['request_date'])?></td>
                            <td class="text-center align-middle"><?=$attraction['job_title']?></td>
                            <td class="text-center align-middle"><?=$attraction['customer']?></td>
                            <td class="text-center align-middle"><?=$attraction['business_name']?></td>
                            <td class="text-center align-middle <?=$class_color?>"><?=$attraction['estatus']?></td>
                            <td class="text-center align-middle" name="end_date<?=$attraction['id']?>" id="end_date<?=$attraction['id']?>"><?=$attraction['end_date']?></td>
                            <td class="text-center align-middle" name="folio<?=$attraction['id']?>" id="folio<?=$attraction['id']?>"><?=$attraction['folio']?></td>
                            <td class="text-center py-0 align-middle">
                                <div class="btn-group btn-group-sm">
                                  <button type="button" id="<?=$attraction['id']?>" class="btn btn-info btn-edit" data-id="<?=$attraction['id']?>"><i class="fas fa-pencil-alt"></i></button>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                  </tbody>
                  <tfoot>
                      <tr>
                        <th class="align-middle text-center">Fecha solicitud</th>
                        <th class="align-middle text-center">Puesto</th>
                        <th class="align-middle text-center">Cliente</th>
                        <th class="align-middle text-center">Razón social</th>
                        <th class="align-middle text-center">Estatus</th>
                        <th class="align-middle text-center">Fecha de entrega</th>
                        <th class="align-middle text-center">Folio</th>
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
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="id_customer" id="id_customer">
                    <input type="hidden" name="id_business_name" id="id_business_name">
                    <input type="hidden" name="id_purchase_order" id="id_purchase_order">
                    <div class="form-group mb-3">
                        <label class="col-form-label" for="request_date">Fecha de Solicitud</label>
                        <input type="date" class="form-control" id="request_date" name="request_date" readonly>
                    </div>
                    <div class="form-group mb-3">
                        <label class="col-form-label" for="job_title">Puesto</label>
                        <input type="text" class="form-control" name="job_title" id="job_title" readonly>
                    </div>
                    <div class="form-group mb-3">
                        <label class="col-form-label" for="customer">Cliente</label>
                        <input type="text" class="form-control" id="customer" name="customer" readonly>
                    </div>
                    <div class="form-group mb-3">
                        <label class="col-form-label" for="end_date">Fecha de Entrega</label>
                        <input type="date" class="form-control" id="end_date" name="end_date">
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
<script>
  $(document).ready(function(){
    let table = document.querySelector('#tb_attractions');
    utils.dtTable(table, false);

    let form = document.querySelector("#update-form");

    table.addEventListener('click', e => {
      if (e.target.classList.contains('btn-info') || e.target.parentElement.classList.contains('btn-info')) {
        let folio;
        if (e.target.classList.contains('btn-info'))
          folio = e.target.dataset.id;
        else
          folio = e.target.parentElement.dataset.id;

        let xhr = new XMLHttpRequest();
        let data = `id=${folio}`;
        xhr.open('POST', '../Administracion/getAT');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(data);

        xhr.onreadystatechange = function(){
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                if (r != 0){
                    let json_app = JSON.parse(this.responseText);
                    console.log(json_app);
                    form.reset();
                    form.querySelectorAll("input")[0].value = json_app.id;
                    form.querySelectorAll("input")[1].value = json_app.id_customer;
                    form.querySelectorAll("input")[2].value = json_app.id_business_name;
                    form.querySelectorAll("input")[3].value = json_app.id_purchase_order;
                    form.querySelectorAll("input")[4].value = json_app.request_date;
                    form.querySelectorAll("input")[5].value = json_app.job_title;
                    form.querySelectorAll("input")[6].value = json_app.customer;
                    form.querySelectorAll("input")[7].value = json_app.end_date;
                    form.querySelectorAll("input")[8].value = json_app.folio;
                    form.querySelectorAll("input")[9].value = parseFloat(json_app.amount).toFixed(2);
                    $('#modal_edit').modal('show'); 
                }
            }
        }
      }

      e.stopPropagation();
    });


    form.onsubmit = function(e){
      e.preventDefault();
      let id = form.querySelector('#id').value;
      var formData = new FormData(form);

      let xhr = new XMLHttpRequest();
      xhr.open('POST', '../administracion/update_folio_at');
      xhr.send(formData);
      xhr.id = id;
      xhr.onreadystatechange = function(){
        if (xhr.readyState == 4 && xhr.status == 200) {
          let r = xhr.responseText;
          try{
            let json_app = JSON.parse(r);
            if (json_app.status == 0) {
              utils.showToast('Falta algún dato', 'error');
            }else if(json_app.status == 1){
              document.getElementById('folio'+xhr.id).textContent = json_app.folio;
              document.getElementById('end_date'+xhr.id).textContent = json_app.end_date;
              $('#modal_edit').modal('hide');
            }
            else {
              utils.showToast('Algo salió mal', 'error');
            }
          }catch(error){
            utils.showToast('Algo salió mal', 'error');
          }
            
        }
      }
    };
  });
</script>
