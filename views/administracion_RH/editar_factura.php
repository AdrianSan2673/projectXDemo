<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <div class="alert alert-success">
                        <h3>Factura <?= $factura->factura ?></h3>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <br>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-4">
                    <div class="card">
                        <form id="edit-rh-form" action="post">
                            <div class="card-body">
                                <div class="form-group">
                                    <input type="hidden" name="id" id="id" value="<?= Encryption::encode($factura->id)  ?>">
                                    <input type="hidden" name="Folio" id="Folio" class="form-control" value="<?= $factura->factura ?>">
                                    <label for="Folio_Factura" class="col-form-label">Folio factura:</label>
                                    <input type="text" name="Folio_Factura" id="Folio_Factura" class="form-control" value="<?= $factura->factura ?>">
                                </div>
                                <div class="form-group">
                                    <label for="emision_Date" class="col-form-label">Fecha:</label>
                                    <input name="emision_Date" type="date" id="emision_Date" class="form-control" value="<?= isset($factura) && is_object($factura) ? $factura->emision_date : ''; ?>">
                                </div>
                                <div class="form-group">
                                    <input type="hidden" name="id_cliente" id="id_cliente" value="<?= $factura->id_cliente ?>">
                                    <label for="Cliente" class="col-form-label">Cliente:</label>
                                    <input name="Cliente" type="text" id="Cliente" class="form-control" value="<?= isset($factura) && is_object($factura) ? $factura->Nombre_Cliente : ''; ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="Razon_Social" class="col-form-label">Razón social:</label>
                                    <select name="Razon_Social" id="Razon_Social" class="form-control">
                                        <?php $razones = Utils::showRazonesSocialesPorCliente($factura->id_cliente); ?>
                                        <option value="Pendiente">Pendiente</option>
                                        <?php foreach ($razones as $razon) : ?>
                                            <option value="<?= $razon['ID_Razon'] ?>" <?= isset($factura) && is_object($factura) && $razon['ID_Razon'] == $factura->razon_social ? 'selected' : ''; ?>>
                                                <?= $razon['Nombre_Razon'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="Estado" class="col-form-label">Estado:</label>
                                    <select name="Estado" id="Estado" class="form-control">
                                        <option value="Pendiente de pago" <?= isset($factura) && is_object($factura) && $factura->status == 'Pendiente de pago' ? 'selected' : ''; ?>>
                                            Pendiente de pago</option>
                                        <option value="Pagada" <?= isset($factura) && is_object($factura) && $factura->status == 'Pagada' ? 'selected' : ''; ?>>
                                            Pagada</option>
                                        <option value="Cancelada" <?= isset($factura) && is_object($factura) && $factura->status == 'Cancelada' ? 'selected' : ''; ?>>
                                            Cancelada</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="Promesa_Pago" class="col-form-label">Fecha de promesa de pago:
                                        <?= $factura->Promesa_Pago ?></label>
                                    <input name="Promesa_Pago" type="date" id="Promesa_Pago" class="form-control" value="<?= isset($factura) && is_object($factura) ? $factura->Promesa_Pago : ''; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="Monto" class="col-form-label">Monto:</label>
                                    <input type="number" name="Monto" id="Monto" step="0.01" min="0" class="form-control" value="<?= isset($factura) && is_object($factura) ? round($factura->cost, 2) : ''; ?>">
                                </div>

                                <div class="form-group">
                                    <label for="Fecha_de_Pago" class="col-form-label">Fecha de pago:</label>
                                    <input name="Fecha_de_Pago" type="date" id="Fecha_de_Pago" class="form-control" value="<?= isset($factura) && is_object($factura) ? $factura->payment_date : ''; ?>">
                                </div>
                            </div>
                            <div class="card-footer">
                                <a class="btn btn-info float-left" href="javascript: history.back()">Regresar</a>
                                <input type="submit" name="submit" value="Guardar" id="submit" class="btn btn-success float-right">
                            </div>
                        </form>

                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
                <div class="col-12 col-md-8">
                    <div class="card card-orange">
                        <div class="card-header">
                            <h4 class="card-title">Servicios de esta factura</h4>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="tb_vacancies" class="table table-sm table-responsive table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">Fecha Inicio</th>
                                        <th class="text-center">Factura</th>
                                        <th class="text-center">Costo</th>
                                        <th class="text-center">Cliente</th>
                                        <th class="text-center">Dias</th>
                                        <th class="text-center">Paquete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($servicios as $servicio) :

                                        if ($servicio['status'] == strtoupper('Finalizado'))
                                            $Color_Estatus = 'bg-primary';
                                        elseif ($servicio['status'] == strtoupper('Facturado'))
                                            $Color_Estatus = 'table-info';
                                        elseif ($servicio['status'] == strtoupper('Cancelado'))
                                            $Color_Estatus = 'bg-danger';
                                        else
                                            $Color_Estatus = '';
                                    ?>
                                        <tr>
                                            <td class="text-center">
                                                <?= ($servicio['start_date'] != '') ? Utils::getShortDate($servicio['start_date']) : '' ?>
                                            </td>
                                            <td class="text-center" id="folio<?= $servicio['id'] ?>">
                                                <?= $servicio['factura'] ?>
                                            </td>
                                            <td class="text-center"><?= number_format($servicio['cost'], 2) ?></td>
                                            <td class="text-center"><?= $servicio['Nombre_Cliente'] ?></td>
                                            <td class="text-center"><?= $servicio['days'] ?></td>
                                            <td class="text-center"><?= $servicio['name'] ?></td>
                        </div>
                        </td>
                        </tr>
                    <?php endforeach; ?>

                    </tbody>
                    <tfoot>
                        <tr>
                            <th class="text-center">Fecha Inicio</th>
                            <th class="text-center">Factura</th>
                            <th class="text-center">Costo</th>
                            <th class="text-center">Cliente</th>
                            <th class="text-center">Dias</th>
                            <th class="text-center">Paquete</th>
                        </tr>
                    </tfoot>
                    </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <div class="col-12 col-md-12">
                <div class="card card-info">
                    <div class="card-header">
                        <h4 class="card-title">Gestiones de esta factura</h4>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="tb_follow_ups" class="table table-responsive table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center">Fecha</th>
                                    <th class="text-center">Usuario</th>
                                    <th class="text-center">Factura</th>
                                    <th class="text-center">Persona contactada</th>
                                    <th class="text-center">Promesa de pago</th>
                                    <th class="text-center">Comentarios</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($seguimientos as $seguimiento) : ?>
                                    <tr>

                                        <td class="text-center"><?= Utils::getFullDate($seguimiento['Fecha']) ?></td>
                                        <td class="text-center"><?= $seguimiento['Usuario'] ?></td>
                                        <td class="text-center"><?= $seguimiento['Folio_Factura'] ?></td>
                                        <td class="text-center"><?= $seguimiento['Contacto_Con'] ?></td>
                                        <td class="text-center">
                                            <?= is_null($seguimiento['Promesa_Pago']) || empty($seguimiento['Promesa_Pago']) ? '' : Utils::getShortDate($seguimiento['Promesa_Pago']) ?>
                                        </td>
                                        <td><?= $seguimiento['Comentarios'] ?></td>
                                    </tr>
                                <?php endforeach; ?>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th class="text-center">Fecha</th>
                                    <th class="text-center">Usuario</th>
                                    <th class="text-center">Factura</th>
                                    <th class="text-center">Persona contactada</th>
                                    <th class=" text-center">Promesa de pago</th>
                                    <th class=" text-center">Comentarios</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
        <br>

</div>

</section>
</div>
<script src="<?= base_url ?>app/RH/administracion_RH.js?v=<?= rand() ?>"></script>
<script>
    $(document).ready(function() {
        let table = document.querySelector('#tb_vacancies');
        utils.dtTable(table);
    });

    document.querySelector("#edit-rh-form").onsubmit = function(e) {
        e.preventDefault();
        document.querySelector("#edit-rh-form #submit").disabled = true;
        let administracion = new Administracion_RH();
        administracion.editar_factura();
    };
</script>