<style type="text/css">
    .table .form-control {
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
                        <h3>Facturación RH</h3>
                    </div>

                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <br>
    <!-- Main content -->
    <section class="content">
        <div class="card car-success">
            <div class="card-header">
                <h3 class="card-title">Listado de servicios</h3>
            </div>
            <!-- /.card-header -->

            <div class="card-body">
                <form method="POST">
                    <!-- <input type="submit" name="submit" class="btn btn-success btn-block btn-lg" value="Guardar"> -->
                    <table id="tb_rh" class="table table-responsive-lg table-striped  table-condensed ">
                        <thead>

                            <tr>
                                <th class="text-center">Fecha Inicio</th>
                                <th class="text-center">Factura</th>
                                <th class="text-center">Costo</th>
                                <th class="text-center">Cliente</th>
                                <th class="text-center">Dias</th>
                                <th class="text-center">Paquete</th>
                                <th>Accion</th>
                                <th hidden></th>
                                <th hidden></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($servicios as $servicio) : ?>
                                <tr>

                                    <td class="text-center">
                                        <?= ($servicio['start_date'] != '') ? Utils::getShortDate($servicio['start_date']) : '' ?>
                                    </td>
                                    <td class="text-center" id="folio<?= $servicio['id'] ?>"><?= $servicio['factura'] ?>
                                    </td>
                                    <td class="text-center"><?= number_format($servicio['cost'], 2) ?></td>
                                    <td class="text-center"><?= $servicio['Nombre_Cliente'] ?></td>
                                    <td class="text-center"><?= $servicio['days'] ?></td>
                                    <td class="text-center"><?= $servicio['name'] ?></td>
                                    <td class="text-center">

                                        <div class="row">
                                            <div class="btn-group btn-group-sm col-6">
                                                <button type="button" data-id="<?= $servicio['id'] ?>" class="btn btn-info btn-edit btn-lg"><i class="fas fa-pencil-alt"></i></button>
                                            </div>


                                        </div>
                                    </td>
                                    <td hidden><?= $servicio['Folio'] ?></td>
                                    <td hidden><?= $servicio['ID_Cliente'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th class="text-center">Fecha Inicio</th>
                                <th class="text-center">factura</th>
                                <th class="text-center">costo</th>
                                <th class="text-center">cliente</th>
                                <th class="text-center">dias</th>
                                <th class="text-center">paquete</th>
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

<script src="<?= base_url ?>app/RH/administracion_RH.js?v=<?= rand() ?>"></script>
<script>
    $(document).ready(function() {

        let table = document.querySelector('#tb_rh');
        utils.dtTable(table, true);



        $("#tb_rh").on('click', '.btn-edit', function(e) {
            let administracion = new Administracion_RH();
            let id;

            if (e.target.classList.contains('btn-info')) {
                id = e.target.dataset.id;
            } else {
                id = e.target.parentElement.dataset.id;
            }
            console.log(id);
            administracion.getServicio(id);
        });

        document.querySelector("#edit-rh-form").onsubmit = function(e) {
            e.preventDefault();


            let administracion = new Administracion_RH();
            administracion.update_folio();
        };


        // document.querySelector('#btn_facturas').addEventListener('click', function() {
        //     let administracion = new Administracion();
        //     administracion.getFacturasEmpresa('#modal_afectar_facturas', 1);

        //     $('#modal_afectar_facturas').modal({
        //         keyboard: false
        //     });

        //     $("#modal_afectar_facturas").draggable({
        //         handle: ".modal-header"
        //     });


        //     document.querySelector('#modal_afectar_facturas form [name="ID_Cliente"]').innerHTML = ''
        //     document.querySelector('#modal_afectar_facturas form [name="Razon_Social"]').innerHTML = ''
        //     document.querySelector('#modal_afectar_facturas form [name="Prefactura"]').innerHTML = ''
        //     document.querySelector('#modal_afectar_facturas form [name="Factura"]').value = ''
        // })


        // document.querySelector("#modal_afectar_facturas").onsubmit = function(e) {
        //     e.preventDefault();
        //     let administracion = new Administracion();
        //     administracion.updatePrefolioAFolio('#modal_afectar_facturas')
        // };


        // //============================[Ulises Marzo 21]=========================================
        // document.querySelector('#btn_Prefacturas').addEventListener('click', function() {
        //     let administracion = new Administracion();
        //     administracion.getFacturasEmpresa('#modal_afectar_Prefacturas', 2);

        //     document.querySelector('#modal_afectar_Prefacturas form [name="ID_Cliente"]').innerHTML = ''
        //     document.querySelector('#modal_afectar_Prefacturas form [name="Razon_Social"]').innerHTML = ''
        //     $("#modal_afectar_Prefacturas form [name='Candidatos[]']").empty();
        //     document.querySelector('#modal_afectar_Prefacturas form [name="Prefactura"]').innerHTML = ''

        //     $('#modal_afectar_Prefacturas').modal({
        //         keyboard: false
        //     });

        //     $("#modal_afectar_Prefacturas").draggable({
        //         handle: ".modal-header"
        //     });
        // })



        // document.querySelector("#modal_afectar_Prefacturas").onsubmit = function(e) {
        //     e.preventDefault();
        //     let administracion = new Administracion();
        //     administracion.updateSinFolioAPrefolio('#modal_afectar_Prefacturas')
        // };

        //======================================================================================

    });
</script>