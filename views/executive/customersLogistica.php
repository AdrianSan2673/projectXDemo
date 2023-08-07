<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left mb-2">
                        <li class="breadcrumb-item"><a href="<?= base_url ?>">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url ?><?= $_GET['controller'] == 'ejecutivos' ? 'ejecutivos/de_reclutamiento' : ($_GET['controller'] == 'ejecutivos_SA' ? 'ejecutivos_SA/de_cuenta' : '') ?>"><?= $_GET['controller'] == 'ejecutivos' ? 'Ejecutivos de reclutamiento' : ($_GET['controller'] == 'ejecutivos_SA' ? 'Ejecutivos de cuenta' : '') ?></a></li>
                        <li class="breadcrumb-item active">Clientes de <?= ' <b>' . $ejecutivo->first_name . ' ' . $ejecutivo->last_name . '</b>' ?></li>
                    </ol>
                </div>
                <div class="col-sm-12">
                    <div class="alert alert-success">
                        <h3 id="nombre_ejecutivo">Clientes asignados a <?= $ejecutivo->first_name . ' ' . $ejecutivo->last_name ?></h3>
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
                <h3 class="card-title">Listado de ejecutivos</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="customer" class="col-form-label">Ejecutivo</label>
                            <select name="customer" id="customer" class="form-control select2" required>
                                <option disabled selected value="">Selecciona ejecutivo</option>

                                <?php if ($_GET['controller'] == 'ejecutivos_SA') : ?>
                                    <?php foreach ($executives as $ex) : ?>
                                        <option value="<?= Encryption::encode($ex['username']) ?>"><?= $ex['first_name'] . ' ' . $ex['last_name'] ?></option>
                                    <?php endforeach ?>
                                <?php endif ?>

                            </select>
                            <input type="hidden" id="recruiter" value="<?= Encryption::encode($ejecutivo->username) ?>">
                        </div>
                    </div>
                    <div class="col-md-4 align-middle text-center">
                        <div class="form-group">
                            <button type="submit" class="btn btn-success" id="btn_assign_customer">Asignar ejecutivo</button>
                        </div>
                    </div>
                </div>

                <table id="tb_customers" class="table table-striped">
                    <?php if ($_GET['controller'] == 'ejecutivos_SA') : ?>
                        <thead>
                            <tr>
                                <th>Ejecutivo</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="tbody_customers">
                            <?php foreach ($executiveJR_cuenta  as $ejeCuenta) : ?>
                                <tr>
                                    <td><?= $ejeCuenta['first_name'] . ' ' . $ejeCuenta['last_name'] ?></td>
                                    <td class="text-center py-0 align-middle">
                                        <div class="btn-group btn-group-sm">
                                            <button value="<?= Encryption::encode($ejeCuenta['username'])  ?>" class="btn btn-danger text-bold">X</button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Ejecutivo</th>
                                <th></th>
                            </tr>
                        </tfoot>
                    <?php endif ?>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
    </section>
</div>


    <script type="text/javascript" src="<?= base_url ?>app/Ejecutivo_plaza.js?v=<?= rand() ?>"></script>

    <script>
        $(document).ready(function() {
            let table = document.querySelector('#tb_customers');
            utils.dtTable(table);

            document.querySelector("#btn_assign_customer").onclick = function(e) {
                let ep = new Ejecutivo_plaza();
                ep.saveApoyo();
                e.preventDefault();
            };


            document.querySelector('#tbody_customers').addEventListener('click', function(e) {

                if (e.target.classList.contains('btn-danger') ) {
                    let nombre_ejecutivo = document.querySelector('#nombre_ejecutivo').textContent
                    let ep = new Ejecutivo_plaza();

                    Swal.fire({
                        title: '¿Quieres desactivar este ejecutivo?',
                        text: "El ejecutivo actual es " + nombre_ejecutivo,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#6c757d',
                        cancelButtonText: 'Cancelar',
                        confirmButtonText: 'Eliminar'
                    }).then((result) => {
                        if (result.value == true) {
                            let ep = new Ejecutivo_plaza();
                            ep.deleteApoyo(e.target.value);
                            e.preventDefault();
                        }
                    })


                }
            })

        });
    </script>
