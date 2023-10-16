<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <div class="alert alert-success">
            <h3>Cobranza Reclutamiento</h3>
          </div>

        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- <section class="content-header">
      <div class="container-fluid">
        <form method="POST" action="<?= base_url . "administracion/cobranza" ?>" class="row">
          <div class="col-12 col-md-5">
            <div class="form-group">
              <label for="start_date" class="col-form-label">Fecha inicial:</label>
              <input type="date" name="start_date" id="start_date" value="<?= isset($_POST['start_date']) ? $_POST['start_date'] : date('Y-m-d') ?>" class="form-control">
            </div>
          </div>
          <div class="col-12 col-md-5">
            <div class="form-group">
              <label for="end_date" class="col-form-label">Fecha final:</label>
              <input type="date" name="end_date" id="end_date" value="<?= isset($_POST['end_date']) ? $_POST['end_date'] : date('Y-m-d') ?>" class="form-control">
            </div>
          </div>
          <div class="col-12 col-md-2" style="padding-right: 14px;">
              <button type="submit" name="search" id="search" class="btn btn-app btn-block btn-info" style="background-color: #17a2b8; color: #fff;"><i class="fas fa-search"></i>Buscar</button>
          </div>
        </form>
        <hr>
      </div>  
    </section> -->
  <br>
  <!-- Main content -->
  <section class="content">
    <div class="card">
      <div class="card-header">
        <ul class="nav nav-pills">
          <li class="nav-item">
            <a class="nav-link active" href="#tab_1" data-toggle="tab">Facturas pendientes</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#tab_2" data-toggle="tab">Facturas pagadas</a>
          </li>
        </ul>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <div class="tab-content">
          <div class="tab-pane active" id="tab_1">
            <table id="tb_unpaid_bills" class="table table-responsive table-striped table-sm">
              <thead>
                <tr>
                  <th class="filterhead"></th>
                  <th></th>
                  <th class="filterhead"></th>
                  <th></th>
                  <th class="filterhead"></th>
                  <th class="filterhead"></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th class="filterhead"></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                </tr>
                <tr>
                  <th class="align-middle">Factura</th>
                  <th class="align-middle">Fecha</th>
                  <th class="align-middle">Días de crédito</th>
                  <th class="align-middle">Días transcurridos</th>
                  <th class="align-middle text-center">Cliente</th>
                  <th class="align-middle">Razón social</th>
                  <th class="align-middle text-right">Monto</th>
                  <th class="align-middle text-right">Monto + IVA</th>
                  <th class="align-middle text-center">Fecha de pago</th>
                  <th class="align-middle text-center">Estado</th>
                  <th class="align-middle text-center">Promesa de pago</th>
                  <th class="align-middle">Fecha última gestión</th>
                  <th>Última gestión</th>
                  <th>Vacante</th>
                  <th class="align-middle text-center">Acciones</th>
                </tr>
              </thead>
              <tbody id="tboodyFactura">
                <?php foreach ($bills as $bill) : ?>
                  <tr>
                    <?php switch ($bill['status']) {
                      case 1:
                        $class_color = 'bg-orange';
                        break;
                      case 2:
                        $class_color = 'bg-success';
                        break;
                      default:
                        $class_color = '';
                        break;
                    }
                    ?>
                    <td><b><?= $bill['folio'] ?></b></td>
                    <td><?= Utils::getShortDate($bill['emit_date']); ?></td>
                    <td class="text-center"><?= $bill['credit_days'] ?></td>
                    <td class="text-center <?= $bill['days_elapsed'] > $bill['credit_days'] ? 'bg-danger' : '' ?>"><?= $bill['days_elapsed'] ?></td>
                    <td class="text-center"><?= $bill['customer'] ?></td>
                    <td><?= $bill['business_name'] ?></td>
                    <td class="text-right">$ <?= number_format($bill['total']) ?></td>
                    <td class="text-right">$ <?= number_format($bill['total_IVA']) ?></td>
                    <td><?= !is_null($bill['payment_date']) ? Utils::getShortDate($bill['payment_date']) : '' ?></td>
                    <td class="text-center <?= $class_color ?>"><?= $bill['estado'] ?></td>
                    <td><?= !is_null($bill['payment_promise_date']) ? Utils::getShortDate($bill['payment_promise_date']) : '' ?></td>
                    <td><?= !is_null($bill['last_follow_up_date']) ? Utils::getShortDate($bill['last_follow_up_date']) : '' ?></td>
                    <td><?= $bill['last_follow_up_comments'] ?></td>
                    <td><?= Utils::nameVacancy($bill['id']) ?></td>

                    <td class="text-center py-0">
                      <div class="btn-group btn-group-sm">
                        <a href="<?= base_url ?>administracion/editar_factura&id=<?= Encryption::encode($bill['id']) ?>" class="btn btn-success btn-sm mr-1">
                          <i class="fas fa-eye"></i>
                        </a>

                        <button class="btn btn-orange btn-fact mr-1" id="btn-editar-factura" value="<?= Encryption::encode($bill['id'])  ?>">
                          <i class="fas fa-pencil-alt"></i>
                        </button>

                        <button class="btn btn-secondary btn-gestionar-fact mr-1" id="btn-gestionar-factura" value="<?= Encryption::encode($bill['id'])  ?>">
                          <i class="fas fa-cog"></i>
                        </button>
                      </div>
                    </td>
                  </tr>
                <?php endforeach; ?>

              </tbody>
              <tfoot>
                <tr>
                  <th></th>
                  <th></th>
                  <th class="filterhead"></th>
                  <th></th>
                  <th class="filterhead"></th>
                  <th class="filterhead"></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th class="filterhead"></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                </tr>
                <tr>
                  <th class="align-middle">Factura</th>
                  <th class="align-middle">Fecha</th>
                  <th class="align-middle">Días de crédito</th>
                  <th class="align-middle">Días transcurridos</th>
                  <th class="align-middle text-center">Cliente</th>
                  <th class="align-middle">Razón social</th>
                  <th class="align-middle text-right">Monto</th>
                  <th class="align-middle text-right">Monto + IVA</th>
                  <th class="align-middle text-center">Fecha de pago</th>
                  <th class="align-middle text-center">Estado</th>
                  <th class="align-middle text-center">Promesa de pago</th>
                  <th class="align-middle">Fecha última gestión</th>
                  <th>Última gestión</th>
                  <th>Vacante</th>
                  <th class="align-middle text-center">Acciones</th>
                </tr>
              </tfoot>
            </table>
          </div>

          <div class="tab-pane" id="tab_2">
            <table id="tb_paid_bills" class="table table-responsive table-striped table-sm">
              <thead>
                <tr>
                  <th class="align-middle">Factura</th>
                  <th class="align-middle">Fecha</th>
                  <th class="align-middle">Días de crédito</th>
                  <th class="align-middle">Días transcurridos</th>
                  <th class="align-middle text-center">Cliente</th>
                  <th class="align-middle">Razón social</th>
                  <th class="align-middle text-right">Monto</th>
                  <th class="align-middle text-right">Monto + IVA</th>
                  <th class="align-middle text-center">Fecha de pago</th>
                  <th class="align-middle text-center">Estado</th>
                  <th class="align-middle text-center">Promesa de pago</th>
                  <th class="align-middle">Fecha última gestión</th>
                  <th>Última gestión</th>
                  <th class="align-middle text-center">Acciones</th>
                </tr>
              </thead>
              <tbody id="tboodyFacturaPaid">
                <?php foreach ($paid_bills as $bill) : ?>
                  <tr>
                    <?php switch ($bill['status']) {
                      case 1:
                        $class_color = 'bg-orange';
                        break;
                      case 2:
                        $class_color = 'bg-success';
                        break;
                      default:
                        $class_color = '';
                        break;
                    }
                    ?>
                    <td><b><?= $bill['folio'] ?></b></td>
                    <td><?= Utils::getShortDate($bill['emit_date']); ?></td>
                    <td class="text-center"><?= $bill['credit_days'] ?></td>
                    <td class="text-center <?= $bill['days_elapsed'] > $bill['credit_days'] ? 'bg-danger' : '' ?>"><?= $bill['days_elapsed'] ?></td>
                    <td class="text-center"><?= $bill['customer'] ?></td>
                    <td><?= $bill['business_name'] ?></td>
                    <td class="text-right">$ <?= number_format($bill['total']) ?></td>
                    <td class="text-right">$ <?= number_format($bill['total_IVA']) ?></td>
                    <td><?= !is_null($bill['payment_date']) ? Utils::getShortDate($bill['payment_date']) : '' ?></td>
                    <td class="text-center <?= $class_color ?>"><?= $bill['estado'] ?></td>
                    <td><?= !is_null($bill['payment_promise_date']) ? Utils::getShortDate($bill['payment_promise_date']) : '' ?></td>
                    <td><?= !is_null($bill['last_follow_up_date']) ? Utils::getShortDate($bill['last_follow_up_date']) : '' ?></td>
                    <td><?= $bill['last_follow_up_comments'] ?></td>
                    <td class="text-center py-0">
                      <div class="btn-group btn-group-sm">
                        <a href="<?= base_url ?>administracion/editar_factura&id=<?= Encryption::encode($bill['id']) ?>" class="btn btn-success btn-sm mr-1">
                          <i class="fas fa-eye"></i>
                        </a>

                        <button class="btn btn-orange btn-fact mr-1" id="btn-editar-factura" value="<?= Encryption::encode($bill['id'])  ?>">
                          <i class="fas fa-pencil-alt"></i>
                        </button>

                        <button class="btn btn-secondary btn-gestionar-fact mr-1" id="btn-gestionar-factura" value="<?= Encryption::encode($bill['id'])  ?>">
                          <i class="fas fa-cog"></i>
                        </button>
                      </div>
                    </td>

                
                  </tr>
                <?php endforeach; ?>

              </tbody>
              <tfoot>
                <tr>
                  <th class="align-middle">Factura</th>
                  <th class="align-middle">Fecha</th>
                  <th class="align-middle">Días de crédito</th>
                  <th class="align-middle">Días transcurridos</th>
                  <th class="align-middle text-center">Cliente</th>
                  <th class="align-middle">Razón social</th>
                  <th class="align-middle text-right">Monto</th>
                  <th class="align-middle text-right">Monto + IVA</th>
                  <th class="align-middle text-center">Fecha de pago</th>
                  <th class="align-middle text-center">Estado</th>
                  <th class="align-middle text-center">Promesa de pago</th>
                  <th class="align-middle">Fecha última gestión</th>
                  <th>Última gestión</th>
                  <th class="align-middle text-center">Acciones</th>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>

      </div>
      <!-- /.card-body -->
    </div>
  </section>
</div>

<!-- gabo 20/02/2022 -->
<script type="text/javascript" src="<?= base_url ?>app/administracion_reclu_cobranza.js?v=<?= rand() ?>"></script>
<script src="<?= base_url ?>app/management.js?v=<?= rand() ?>"></script>

<script>
  $(document).ready(function() {
    let table = document.querySelector('#tb_unpaid_bills');
    utils.dtTable(table, false, false);

    let table2 = document.querySelector('#tb_paid_bills');
    utils.dtTable(table2, false, false);

    //=========================================[gabo 20/02/2022]============================================================================================
    document.querySelector('#tboodyFactura').addEventListener('click', function(e) { //gabo 20/02/2022
      if ((e.target.classList.contains('btn-fact') || e.target.offsetParent.classList.contains('btn-fact'))) {
        var factura = new administracion_reclu_cobranza();
        if (e.target.offsetParent.classList.contains('btn-fact')) {
          factura.getFactura(e.target.offsetParent.value, "")
        } else {
          factura.getFactura(e.target.value, "")
        }
        $('#modal_editar_factura').modal({
          backdrop: 'static',
          keyboard: false
        });
      }


      if (e.target.classList.contains('btn-gestionar-fact') || e.target.offsetParent.classList.contains('btn-gestionar-fact')) { //gabo 20/02/2022
        var factura = new administracion_reclu_cobranza();
        if (e.target.offsetParent.classList.contains('btn-gestionar-fact')) {
          factura.gestionar_factura(e.target.offsetParent.value)
        } else {
          factura.gestionar_factura(e.target.value)
        }

        $('#modal_gestionar_factura').modal({
          backdrop: 'static',
          keyboard: false
        });
      }
    });


    document.querySelector('#tboodyFacturaPaid').addEventListener('click', function(e) { //gabo 20/02/2022
      if ((e.target.classList.contains('btn-fact') || e.target.offsetParent.classList.contains('btn-fact'))) {
        var factura = new administracion_reclu_cobranza();
        if (e.target.offsetParent.classList.contains('btn-fact')) {
          factura.getFactura(e.target.offsetParent.value)
        } else {
          factura.getFactura(e.target.value)
        }
        $('#modal_editar_factura').modal({
          backdrop: 'static',
          keyboard: false
        });
      }


      if (e.target.classList.contains('btn-gestionar-fact') || e.target.offsetParent.classList.contains('btn-gestionar-fact')) { //gabo 20/02/2022
        var factura = new administracion_reclu_cobranza();
        if (e.target.offsetParent.classList.contains('btn-gestionar-fact')) {
          factura.gestionar_factura(e.target.offsetParent.value)
        } else {
          factura.gestionar_factura(e.target.value)
        }

        $('#modal_gestionar_factura').modal({
          backdrop: 'static',
          keyboard: false
        });
      }
    });
    //=========================================[gabo 20/02/2022]===============================================================

  });
</script>