<style type="text/css">
  .table .form-control{
    font-size: 0.6rem;
  }
</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <div class="alert alert-success">
                <h3>Facturación de Servicios de Apoyo</h3>
            </div>
            
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content-header">
      <div class="container-fluid">
         <form method="POST" action="<?= base_url . "administracion_SA/facturacion" ?>" class="row">
        <div class="col-12 col-md-3">
          <div class="form-group">
            <label for="start_date" class="col-form-label">Fecha inicial:</label>
            <input type="date" name="start_date" id="start_date" value="<?= isset($_POST['start_date']) ? $_POST['start_date'] : date('Y-m-d') ?>" class="form-control">
          </div>
        </div>
        <div class="col-12 col-md-3">
          <div class="form-group">
            <label for="end_date" class="col-form-label">Fecha final:</label>
            <input type="date" name="end_date" id="end_date" value="<?= isset($_POST['end_date']) ? $_POST['end_date'] : date('Y-m-d') ?>" class="form-control">
          </div>
        </div>

        <div class="col-12 col-md-4">
          <div class="form-group">
            <label for="end_date" class="col-form-label">Empresa:</label>
            <select name="Empresa" class="form-control select2">
              <option value="0">-- Sin empresa --</option>
              <?php $Empresas = Utils::showEmpresas(); ?>
              <?php foreach ($Empresas as $empresa) : ?>
                                <option value="<?= $empresa['Empresa']  ?>" <?= isset($_POST['Empresa']) && $_POST['Empresa'] == $empresa['Empresa']?'selected':'' ?> ><?= $empresa['Nombre_Empresa']  ?></option>

              <?php endforeach; ?>
            </select>
          </div>
        </div>


        <div class="col-12 col-md-2" style="padding-right: 14px;">
          <button type="submit" name="search" id="search" class="btn btn-app btn-block btn-info" style="background-color: #17a2b8; color: #fff;"><i class="fas fa-search"></i>Buscar</button>
        </div>
      </form>
        <hr>
        <div class="row">
          <div class="col-lg-2 col-12">
              <div class="small-box bg-orange">
                  <div class="inner">
                      <h5><?=count($servicios)?></h5>
                      
                      <p style="font-size: 0.8rem">Operaciones</p>
                      <p style="font-size: 0.8rem">Ingresadas</p>
                  </div>
                  <div class="icon">
                      <i class="ion ion-clipboard"></i>
                  </div>
              </div>
          </div>
          <div class="col-lg-2 col-12">
              <div class="small-box bg-info">
                  <div class="inner">
                      <h5 id="no_ordenes"></h5>
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
                      <h4 id="no_facturadas"></h4>
                      <p style="font-size: 0.8rem">Facturadas</p>
                      <h5>$??</h5>
                  </div>
                  <div class="icon">
                      <i class="ion ion-cash"></i>
                  </div>
              </div>
          </div>
          <div class="col-lg-5 col-12 row">
              <div class="col-lg-4 col-4">
                  <div class="info-box">
                    <span class="info-box-icon elevation-1" style="background-color:#193975; color: white;"><i class="fas fa-file-invoice-dollar"></i></span>

                    <div class="info-box-content">
                      <span class="info-box-text"># ESE</span>
                      <span id="no_ESE" class="info-box-number"></span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
              </div>
              <div class="col-lg-4 col-4">
                  <div class="info-box">
                    <span class="info-box-icon elevation-1" style="background-color:#F50E0E; color: white;"><i class="far fa-id-badge"></i></span>

                    <div class="info-box-content">
                      <span class="info-box-text"># INV</span>
                      <span id="no_INV" class="info-box-number"></span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
              </div>
              <div class="col-lg-4 col-4">
                  <div class="info-box">
                    <span class="info-box-icon elevation-1" style="background-color:#F8ED07;"><i class="fas fa-gavel"></i></span>

                    <div class="info-box-content">
                      <span class="info-box-text"># RAL</span>
                      <span id="no_RAL" class="info-box-number"></span>
                    </div>
                    <!-- /.info-box-content -->
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
              <h3 class="card-title">Listado de servicios</h3>
            </div>
            <!-- /.card-header -->
			 <div class="container-fluid">
        <div class="mx-auto text-center">
          <div class="row" >
            <div class="col-6">
              <button class="btn btn-danger" id="btn_facturas">Preactura a Factura</button>
            </div>

            <div class="col-6">
              <button class="btn btn-info" id="btn_Prefacturas">Afectar a Prefacturas</button>
            </div>
          </div>
        </div>
      </div>
            <div class="card-body">
              <form method="POST">
                <!-- <input type="submit" name="submit" class="btn btn-success btn-block btn-lg" value="Guardar"> -->
                <table id="tb_facturacion" class="table table-responsive table-striped display table-sm" style="display: none;">
                  <thead>
                      <tr>
                        <th></th>
                        <th class="filterhead"></th>
                        <th class="filterhead"></th>
                        <th class="filterhead"></th>
                        <th></th>
                        <th></th>
                        <th class="filterhead"></th>
                        <th class="filterhead"></th>
                        <th class="filterhead"></th>
                        <th class="filterhead"></th>
                        <th class="filterhead"></th>
                        <th></th>
                        <th class="filterhead"></th>
                        <th></th>
                        <th hidden></th>
                        <th hidden></th>
                      </tr>
                      <tr>
                        <th class="align-middle">Solicitud</th>
                        <th class="align-middle">Empresa</th>
                        <th class="align-middle">Cliente</th>
                        <th class="align-middle text-center">Facturable a</th>
                        <th class="align-middle text-center">CC Cliente</th>
                        <th class="align-middle">Candidato</th>
                        <th class="align-middle">Servicio solicitado</th>
                        <th class="align-middle text-center">Fase</th>
                        <th class="align-middle text-center">Estado</th>
                        <th class="align-middle">Ejecutivo</th>
                        <th class="align-middle">Solicita</th>
                        <th class="align-middle">% avance ESE</th>
                        <th class="align-middle">Factura</th>
                        <th>Accion</th>
                        <th hidden></th>
                        <th hidden></th>
                      </tr>
                  </thead>
                  <tbody>
                  <?php foreach($servicios as $servicio): ?>
                      <tr> 
                        <?php 
                        if ($servicio['Solicitud_De'] > 0)
                          $Color_Solicitud_De = 'bg-orange';
                        else
                          $Color_Solicitud_De = '';
                         
                        if ($servicio['Servicio_Solicitado'] == 'ESE') 
                          $Color_Servicio_Solicitado = 'bg-navy';
                        elseif ($servicio['Servicio_Solicitado'] == 'INV. LABORAL') 
                          $Color_Servicio_Solicitado = 'bg-danger';
                        elseif ($servicio['Servicio_Solicitado'] == 'RAL')
                          $Color_Servicio_Solicitado = 'bg-warning';
                        else
                          $Color_Servicio_Solicitado = '';

                        if ($servicio['Fase'] == 'ESE' || $servicio['Fase'] == 'RAL + INV.LAB + ESE')
                          $Color_Fase = 'bg-navy';
                        elseif ($servicio['Fase'] == 'INV. LABORAL' || $servicio['Fase'] == 'RAL + INV.LAB')
                          $Color_Fase = 'bg-danger';
                        elseif ($servicio['Fase'] == 'RAL')
                          $Color_Fase = 'bg-warning';
                        else
                          $Color_Fase = '';

                        if ($servicio['Estatus'] == 'Ral en Proceso')
                          $Color_Estatus = 'bg-warning';
                        elseif ($servicio['Estatus'] == 'Investigación en Proceso')
                          $Color_Estatus = 'bg-secondary';
                        elseif ($servicio['Estatus'] == 'Visita en Proceso')
                          $Color_Estatus = 'bg-navy';
                        elseif($servicio['Estatus'] == 'Finalizado'|| $servicio['Estatus'] == 'RAL Consultado')
                          $Color_Estatus = 'bg-primary';
                        elseif($servicio['Estatus'] == 'Facturado')
                          $Color_Estatus = 'table-info';
                        elseif($servicio['Estatus'] == 'Cancelado')
                          $Color_Estatus = 'bg-danger';
                        elseif($servicio['Estatus'] == 'Validación de Licencia en Proceso')
                          $Color_Estatus = 'bg-orange';
                        else
                          $Color_Estatus = '';
                        
                        ?>
                          <td><?=Utils::getShortDate($servicio['Solicitud']);?></td>
                          <td class="font-weight-bold"><?=$servicio['Empresa']?></td>
                          <td c lass="font-weight-bold">
							  
							  <?=$servicio['Cliente'] //Utils::isManager()|| Utils::isAdmin()? '<a href="'.base_url.'cliente_SA/ver&id='.Encryption::encode($servicio['ID_Cliente']).'" target="_blank">'.$servicio['Cliente'].'</a>':$servicio['Cliente']?>
						  
						  </td>
                          <td id="razon<?=$servicio['Folio']?>"><?=$servicio['Razon']?></td>
                          <td><?=$servicio['CC_Cliente']?></td>
                          <td class="<?=$Color_Solicitud_De?>"><?=$servicio['Nombre_Candidato']?></td>
                          <td class="<?=$Color_Servicio_Solicitado?>"><?=$servicio['Servicio_Solicitado']?></td>
                          <td class="<?=$Color_Fase?>"><?=$servicio['Fase']?></td>
                          <td class="align-middle text-center <?=$Color_Estatus?>">
							  <?=$servicio['Estatus']=='RAL Consultado'?'Finalizado':$servicio['Estatus']?></td>
                          <td class="text-center"><?=$servicio['Ejecutivo']?></td>
                          <td class="text-center"><?=$servicio['Solicita']?></td>
                          <td><?=$servicio['Progreso']?></td>
                          <td class="text-center align-middle factura" name="folio<?=$servicio['Folio']?>" id="folio<?=$servicio['Folio']?>"><?=$servicio['Factura']?></td>
                            <td class="text-center py-0 align-middle">
                    <div class="row">
                      <div class="btn-group btn-group-sm col-6">
                        <button type="button" data-id="<?= $servicio['Folio'] ?>" class="btn btn-info btn-edit btn-lg"><i class="fas fa-pencil-alt"></i></button>
                      </div>

                      <div class="btn-group btn-group-sm col-6">
                        <a href="<?= base_url  ?>ServicioApoyo/seguimiento&candidato=<?= Encryption::encode($servicio['Folio']) ?>" target="_blank" class="btn btn-orange btn-sm">
                          <i class="fas fa-history"></i>
                        </a>
                      </div>
                    </div>
                  </td>
                          <td hidden><?=$servicio['Folio']?></td>
                          <td ><?=$servicio['ID_Cliente']==null?'' :$servicio['ID_Cliente']?></td>
                      </tr>
                  <?php endforeach; ?>
                  </tbody>
                  <tfoot>
                      <tr>
                        <th class="align-middle">Solicitud</th>
                        <th class="align-middle">Empresa</th>
                        <th class="align-middle">Cliente</th>
                        <th class="align-middle text-center">Facturable a</th>
                        <th class="align-middle">CC Cliente</th>
                        <th class="align-middle">Candidato</th>
                        <th class="align-middle">Servicio solicitado</th>
                        <th class="align-middle text-center">Fase</th>
                        <th class="align-middle text-center">Estado</th>
                        <th class="align-middle text-center">Ejecutivo</th>
                        <th class="align-middle text-center">Solicita</th>
                        <th class="align-middle">% avance ESE</th>
                        <th class="align-middle text-center">Factura</th>
                        <th>Accion</th>
                        <th hidden></th>
                        <th hidden></th>
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
                    <input type="hidden" name="Candidato" id="Candidato">
                    <input type="hidden" name="ID_Cliente">
                    <div class="form-group mb-3">
                        <label class="col-form-label" for="Cliente">Cliente</label>
                        <input type="text" class="form-control" id="Cliente" name="Cliente" readonly>
                    </div>
                    <div class="form-group mb-3">
                        <label class="col-form-label" for="Fase">Fase</label>
                        <input type="text" class="form-control" id="Fase" name="Fase" readonly>
                    </div>
                    <div class="form-group mb-3">
                        <label class="col-form-label" for="Comentario_Cliente">Comentario del cliente</label>
                        <textarea class="form-control" id="Comentario_Cliente" name="Comentario_Cliente" readonly></textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label class="col-form-label" for="Comentario_Cancelado">Comentario de cancelación</label>
                        <textarea class="form-control" id="Comentario_Cancelado" name="Comentario_Cancelado" readonly></textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label class="col-form-label" for="Factura">Folio de facturación</label>
                        <input type="text" class="form-control" id="Factura" name="Factura" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">
                    </div>
                    <div class="form-group">
                        <label for="Razon_Social" class="col-form-label">Razón social:</label>
                        <select name="Razon_Social" class="form-control"></select>
                    </div>

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <input type="submit" name="submit" class="btn btn-orange" value="Guardar">
                </div>
            </form>
        </div>
    </div>              
</div>
<script src="<?=base_url?>app/administracion.js?v=<?=rand()?>"></script>
<script>
  $(document).ready(function(){
    utils.applyEdit('tb_facturacion', [12]);
    let table = document.querySelector('#tb_facturacion');
    table.style.display = "block";
    utils.dtTable(table, true);
    
    var flag = 0
    var text, tag, comodinInput;

    table.addEventListener('click', e => {
      /*if (e.target.classList.contains('factura')) {
        if (flag == 0) {
          tag = e.target;
          text = e.target.innerText;
          e.target.innerHTML = `<input type="text" id="comodinInput" class="inputFactura form-control form-control-sm" value="${text}">`;
          comodinInput = document.querySelector('#comodinInput');
          flag++;
        }


      }

      if (!e.target.classList.contains('inputFactura')) {
        if (flag == 1) {
          flag++;
        } else {
          text = comodinInput.value;
          comodinInput.remove();
          tag.textContent = text;
          flag = 0;
          console.log(tag.parentElement.children[14].textContent);
          console.log(tag.parentElement.children[15].textContent);
          console.log(text);
          //let administracion = new Administracion();
          //administracion.update_folio();
        }
      }*/

    })

    
    $("#tb_facturacion").on('click','.btn-edit', function (e) { 
        let administracion = new Administracion();
        let id;

        if (e.target.classList.contains('btn-info')) {
          id = e.target.dataset.id;
        }else{
          id = e.target.parentElement.dataset.id;
        }
        administracion.getServicio(id);
    });
    
    document.querySelector("#update-form").onsubmit = function(e){
      e.preventDefault();
      let administracion = new Administracion();
      administracion.update_folio();
    };
	  
	
    //============================[Ulises Marzo 08]=========================================
    document.querySelector('#btn_facturas').addEventListener('click', function() {
      let administracion = new Administracion();
      administracion.getFacturasEmpresa('#modal_afectar_facturas', 1);

      $('#modal_afectar_facturas').modal({
        keyboard: false
      });

      $("#modal_afectar_facturas").draggable({
        handle: ".modal-header"
      });


      document.querySelector('#modal_afectar_facturas form [name="ID_Cliente"]').innerHTML = ''
      document.querySelector('#modal_afectar_facturas form [name="Razon_Social"]').innerHTML = ''
      document.querySelector('#modal_afectar_facturas form [name="Prefactura"]').innerHTML = ''
      document.querySelector('#modal_afectar_facturas form [name="Factura"]').value = ''
    })


    document.querySelector("#modal_afectar_facturas").onsubmit = function(e) {
      e.preventDefault();
      let administracion = new Administracion();
      administracion.updatePrefolioAFolio('#modal_afectar_facturas')
    };
    //==========================================================================================


    //============================[Ulises Marzo 21]=========================================
    document.querySelector('#btn_Prefacturas').addEventListener('click', function() {
      let administracion = new Administracion();
      administracion.getFacturasEmpresa('#modal_afectar_Prefacturas', 2);

      document.querySelector('#modal_afectar_Prefacturas form [name="ID_Cliente"]').innerHTML = ''
      document.querySelector('#modal_afectar_Prefacturas form [name="Razon_Social"]').innerHTML = ''
      $("#modal_afectar_Prefacturas form [name='Candidatos[]']").empty();
      document.querySelector('#modal_afectar_Prefacturas form [name="Prefactura"]').innerHTML = ''

      $('#modal_afectar_Prefacturas').modal({
        keyboard: false
      });

      $("#modal_afectar_Prefacturas").draggable({
        handle: ".modal-header"
      });
    })



    document.querySelector("#modal_afectar_Prefacturas").onsubmit = function(e) {
      e.preventDefault();
      let administracion = new Administracion();
      administracion.updateSinFolioAPrefolio('#modal_afectar_Prefacturas')
    };

    //======================================================================================

  });
</script>