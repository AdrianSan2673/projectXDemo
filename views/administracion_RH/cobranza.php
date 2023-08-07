<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left mb-2">
                        <li class="breadcrumb-item"><a href="<?= base_url ?>">Inicio</a></li>
                        <li class="breadcrumb-item active">Cobranza</li>
                    </ol>
                </div>
                <div class="col-sm-12">
                    <div class="alert alert-success">
                        <h3>Cobranza de Modulo de RH</h3>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>



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
                    <div class="tab-pane active table-responsive" id="tab_1">
                        <table id="tb_unpaid_bills" class="table table-responsive table-striped table-responsive-lg" style="display: none;">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th class="filterhead"></th>
                                    <th></th>
                                    <th class="filterhead"></th>
                                    <th class="filterhead"></th>
                                    <th class="filterhead"></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <!-- <th></th> -->
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
                                    <th class="align-middle">Días trans</th>
                                    <th class="align-middle">Empresa</th>
                                    <th class="align-middle text-center">Cliente</th>
                                    <th class="align-middle">Razón social</th>
                                    <th class="align-middle text-right">Monto</th>
                                    <!-- <th class="align-middle text-right">Monto + IVA</th> -->
                                    <th class="align-middle text-center">Fecha de pago</th>
                                    <th class="align-middle text-center">Estado</th>
                                    <th class="align-middle">Fecha última gestión</th>
                                    <th class="align-middle">Próxima gestión</th>
                                    <th class="align-middle text-center">Promesa de pago</th>
                                    <th>Última gestión</th>
                                    <th class="align-middle text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($facturas_pendientes as $bill) : ?>
                                    <tr id="factura<?= $bill['id'] ?>">
                                        <?php
                                        switch ($bill['status']) {
                                            case 'Pendiente de pago':
                                                $class_color = 'bg-orange';
                                                break;
                                            case 'Pagada':
                                                $class_color = 'bg-success';
                                                break;
                                            default:
                                                $class_color = '';
                                                break;
                                        }
                                        if ($bill['Dias_Transcurridos'] > $bill['Plazo_Credito'])
                                            $class_color_days = ' bg-danger';
                                        else
                                            $class_color_days = '';
                                        ?>
                                        <td class="text-center align-middle"><b><?= $bill['factura'] ?></b></td>
                                        <td class="text-center align-middle">
                                            <?= Utils::getShortDate($bill['emision_date']); ?></td>
                                        <td class="text-center align-middle"><?= $bill['Plazo_Credito'] ?></td>
                                        <td class="text-center align-middle<?= $class_color_days ?>">
                                            <?= $bill['Dias_Transcurridos'] ?></td>
                                        <td class="text-center align-middle"><?= $bill['Nombre_Empresa'] ?></td>
                                        <td class="text-center align-middle"><?= $bill['nombre_cliente'] ?></td>
                                        <td class="align-middle"><?= $bill['razon'] ?></td>
                                        <td class="text-right align-middle">$ <?= number_format($bill['cost'], 2) ?></td>
                                        <!-- <td class="text-right align-middle">$ <?= number_format($bill['iva_amount'], 2) ?>
                                    </td> -->
                                        <td class="text-center align-middle">
                                            <?= !is_null($bill['payment_date']) ? Utils::getShortDate($bill['payment_date']) : '' ?>
                                        </td>
                                        <td class="text-center align-middle <?= $class_color ?>"><?= $bill['status'] ?></td>
                                        <td class="text-center align-middle">
                                            <?= !is_null($bill['Fecha_Ultima_Gestion']) ? Utils::getShortDate($bill['Fecha_Ultima_Gestion']) : '' ?>
                                        </td>
                                        <td class="text-center align-middle">
                                            <?= !is_null($bill['Proxima_Gestion']) ? Utils::getShortDate($bill['Proxima_Gestion']) : '' ?>
                                        </td>
                                        <td class="text-center align-middle">
                                            <?= !is_null($bill['Promesa_Pago']) ? Utils::getShortDate($bill['Promesa_Pago']) : '' ?>
                                        </td>
                                        <td><?= $bill['Ultima_Gestion'] ?></td>
                                        <td class="text-center py-0 align-middle">
                                            <div class="btn-group btn-group-sm">
                                                <a href="<?= base_url ?>administracion_RH/editar_factura&factura=<?= Encryption::encode($bill['factura']) ?>&id=<?= Encryption::encode($bill['id']) ?>" class="btn btn-success btn-sm mr-1">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <button class="btn btn-info btn-sm mr-1" data-id="<?= $bill['id'] ?>">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </button>
                                                <button class="btn btn-secondary btn-sm mr-1" data-id="<?= $bill['id'] ?>">
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
                                    <th class="align-middle">Días trans</th>
                                    <th class="align-middle">Empresa</th>
                                    <th class="align-middle text-center">Cliente</th>
                                    <th class="align-middle">Razón social</th>
                                    <th class="align-middle text-right">Monto</th>
                                    <!-- <th class="align-middle text-right">Monto + IVA</th> -->
                                    <th class="align-middle text-center">Fecha de pago</th>
                                    <th class="align-middle text-center">Estado</th>
                                    <th class="align-middle">Fecha última gestión</th>
                                    <th class="align-middle">Próxima gestión</th>
                                    <th class="align-middle text-center">Promesa de pago</th>
                                    <th>Última gestión</th>
                                    <th class="align-middle text-center">Acciones</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="tab-pane" id="tab_2">
                        <table id="tb_paid_bills" class="table table-responsive table-striped" style="display: none;">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th class="filterhead"></th>
                                    <th></th>
                                    <th class="filterhead"></th>
                                    <th class="filterhead"></th>
                                    <th class="filterhead"></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <!-- <th></th> -->
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
                                    <th class="align-middle">Días trans</th>
                                    <th class="align-middle">Empresa</th>
                                    <th class="align-middle text-center">Cliente</th>
                                    <th class="align-middle">Razón social</th>
                                    <th class="align-middle text-right">Monto</th>
                                    <!-- <th class="align-middle text-right">Monto + IVA</th> -->
                                    <th class="align-middle text-center">Fecha de pago</th>
                                    <th class="align-middle text-center">Estado</th>
                                    <th class="align-middle">Fecha última gestión</th>
                                    <th class="align-middle">Próxima gestión</th>
                                    <th class="align-middle text-center">Promesa de pago</th>
                                    <th>Última gestión</th>
                                    <th class="align-middle text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($facturas_pagadas as $bill) : ?>
                                    <tr id="factura<?= $bill['id'] ?>">
                                        <?php switch ($bill['status']) {
                                            case 'Pendiente de pago':
                                                $class_color = 'bg-orange';
                                                break;
                                            case 'Pagada':
                                                $class_color = 'bg-success';
                                                break;
                                            default:
                                                $class_color = '';
                                                break;
                                        }
                                        ?>
                                        <td class="text-center align-middle"><b><?= $bill['factura'] ?></b></td>
                                        <td class="text-center align-middle">
                                            <?= Utils::getShortDate($bill['emision_date']); ?></td>
                                        <td class="text-center align-middle"><?= $bill['Plazo_Credito'] ?></td>
                                        <td class="text-center align-middle<?= $class_color_days ?>">
                                            <?= $bill['Dias_Transcurridos'] ?></td>
                                        <td class="text-center align-middle"><?= $bill['Nombre_Empresa'] ?></td>
                                        <td class="text-center align-middle"><?= $bill['Nombre_Cliente'] ?></td>
                                        <td id="razon<?= $bill['id'] ?>" class="align-middle">
                                            <?= $bill['razon'] ?></td>
                                        <td class="text-right align-middle">$ <?= number_format($bill['cost'], 2) ?></td>
                                        <!-- <td class="text-right align-middle">$ <?= number_format($bill['Monto_IVA'], 2) ?> -->
                                        </td>
                                        <td class="text-center align-middle">
                                            <?= !is_null($bill['payment_date']) ? Utils::getShortDate($bill['payment_date']) : '' ?>
                                        </td>
                                        <td id="estado<?= $bill['id'] ?>" class="text-center align-middle <?= $class_color ?>"><?= $bill['status'] ?></td>
                                        <td class="text-center align-middle">
                                            <?= !is_null($bill['Fecha_Ultima_Gestion']) ? Utils::getShortDate($bill['Fecha_Ultima_Gestion']) : '' ?>
                                        </td>
                                        <td class="text-center align-middle">
                                            <?= !is_null($bill['Proxima_Gestion']) ? Utils::getShortDate($bill['Proxima_Gestion']) : '' ?>
                                        </td>
                                        <td class="text-center align-middle">
                                            <?= !is_null($bill['Promesa_Pago']) ? Utils::getShortDate($bill['Promesa_Pago']) : '' ?>
                                        </td>
                                        <td id="gestion<?= $bill['Folio_Factura'] ?>"><?= $bill['Ultima_Gestion'] ?></td>
                                        <td class="text-center py-0 align-middle">
                                            <div class="btn-group btn-group-sm">
                                                <a href="<?= base_url ?>administracion_RH/editar_factura&factura=<?= Encryption::encode($bill['factura']) ?>&id=<?= Encryption::encode($bill['id']) ?>" class="btn btn-success btn-sm mr-1">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <button class="btn btn-info btn-sm mr-1" data-id="<?= $bill['id'] ?>">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </button>
                                                <button class="btn btn-secondary btn-sm mr-1" data-id="<?= $bill['id'] ?>">
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
                                    <th class="align-middle">Días trans</th>
                                    <th class="align-middle">Empresa</th>
                                    <th class="align-middle text-center">Cliente</th>
                                    <th class="align-middle">Razón social</th>
                                    <th class="align-middle text-right">Monto</th>
                                    <!-- <th class="align-middle text-right">Monto + IVA</th> -->
                                    <th class="align-middle text-center">Fecha de pago</th>
                                    <th class="align-middle text-center">Estado</th>
                                    <th class="align-middle">Fecha última gestión</th>
                                    <th class="align-middle">Próxima gestión</th>
                                    <th class="align-middle text-center">Promesa de pago</th>
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
<script type="text/javascript" src="<?= base_url ?>app/RH/administracion_RH.js?v=<?= rand() ?>"></script>
<script>
    $(document).ready(function() {
        let table = document.querySelector('#tb_unpaid_bills');
        table.style.display = "table";
        utils.dtTable(table, false);

        let table2 = document.querySelector('#tb_paid_bills');
        table2.style.display = "table";
        utils.dtTable(table2, false);


        table.addEventListener('click', e => {
            if (e.target.classList.contains('btn-info') || e.target.offsetParent.classList.contains(
                    'btn-info')) {
                $('#modal_factura').modal('show');
                let id;
                if (e.target.classList.contains('btn-info'))
                    id = e.target.dataset.id;
                else
                    id = e.target.offsetParent.dataset.id;

                let administracion = new Administracion_RH();
                administracion.getFactura(id);
            }

            if (e.target.classList.contains('btn-secondary') || e.target.offsetParent.classList.contains(
                    'btn-secondary')) {
                $('#modal_factura_gestion').modal('show');
                let folio;
                if (e.target.classList.contains('btn-secondary'))
                    id = e.target.dataset.id;
                else
                    id = e.target.offsetParent.dataset.id;

                let administracion = new Administracion_RH();
                administracion.getFacturaGestion(id);
            }
        })

        table2.addEventListener('click', e => {
            if (e.target.classList.contains('btn-info') || e.target.offsetParent.classList.contains(
                    'btn-info')) {
                $('#modal_factura').modal('show');
                let id;
                if (e.target.classList.contains('btn-info'))
                    id = e.target.dataset.id;
                else
                    id = e.target.offsetParent.dataset.id;

                let administracion = new Administracion_RH();
                administracion.getFactura(id);
            }

            if (e.target.classList.contains('btn-secondary') || e.target.offsetParent.classList.contains(
                    'btn-secondary')) {
                $('#modal_factura_gestion').modal('show');
                let id;
                if (e.target.classList.contains('btn-secondary'))
                    id = e.target.dataset.id;
                else
                    id = e.target.offsetParent.dataset.id;

                let administracion = new Administracion_RH();
                administracion.getFacturaGestion(id);
            }
        })

        document.querySelector("#rh-form-factura").onsubmit = function(e) {
            e.preventDefault();
            let administracion = new Administracion_RH();
            administracion.update_factura();
        };

        document.querySelector('#modal_factura_gestion').onsubmit = function(e) {
            e.preventDefault();
            let administracion = new Administracion_RH();
            administracion.update_factura_gestion();
        }
        // //============================[Ulises Febrero 17]=========================================
        // document.querySelector('#facturas_group_cobranza').addEventListener('click', function() {
        //     $('#modal_afectar_facturas').modal({
        //         keyboard: false
        //     });
        //     $("#modal_afectar_facturas").draggable({
        //         handle: ".modal-header"
        //     });
        // })
        // //==========================================================================================

        // //============================[Ulises Febrero 22]=========================================
        // document.querySelector('#facturas_group_gestion').addEventListener('click', function() {
        //     $('#modal_afectar_factura_gestion').modal({
        //         keyboard: false
        //     });
        //     $("#modal_afectar_factura_gestion").draggable({
        //         handle: ".modal-header"
        //     });
        // })
        // //==========================================================================================
        // //============================[Ulises Marzo 31 Vetar cliente]===============================
        // document.querySelector('#vetar_cliente').addEventListener('click', function() {
        //     $('#modal_vetar_cliente').modal({
        //         keyboard: false
        //     });
        // })
        // //==========================================================================================
    });
</script>