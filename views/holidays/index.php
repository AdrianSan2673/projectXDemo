<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <div class="alert <?= $_SESSION['identity']->username == 'salmaperez' ? 'alert-maroon' : 'alert-success' ?>">
                        <h3>Control de Vacaciones</h3>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <br>
    <?php if (Utils::permission($_GET['controller'], 'create')) : ?>
        <section class="content-header">
            <div class="row">
                <div class="col-sm-2 ml-auto">
                    <button class="btn btn-orange float-right" id="btn_new_holidays">Crear Solicitud</button>
                </div>
            </div>
        </section>
    <?php endif ?>
    <section class="content">
        <div class="card bg-transparent">
            <div class="card-header">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link active" href="#tab_1" data-toggle="tab">Control de Vacaciones</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#tab_3" data-toggle="tab"> Solicitudes de Vacaciones</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content">

                    <div class="tab-pane active" id="tab_1">
                        <table id="tb_employees" class="table table-responsive table-striped table-sm" style="display: none;">
                            <thead>
                                <tr>
                                    <th class="align-middle">Nombre</th>
                                    <th class="align-middle text-center">Fecha de Ingreso</th>
                                    <th class="align-middle text-center">Antigüedad (años)</th>
                                    <th class="align-middle text-center">Días a disfrutar</th>
                                    <th class="align-middle text-center">Días disponibles</th>
                                    <th class="align-middle text-center">Fecha a vencer</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach ($employees as $employee) : ?>
                                    <tr>
                                        <td class="align-middle text-bold">
                                            <?= $employee['first_name'] . ' ' . $employee['surname'] . ' ' . $employee['last_name'] ?>
                                        </td>
                                        <td class="text-center align-middle"><?= Utils::getDate($employee['start_date']) ?>
                                        </td>
                                        <td class="text-center align-middle"><?= $employee['years']  ?></td>
                                        <td class="text-center align-middle"><?= $employee['holidays_by_year']  ?></td>
                                        <td class="text-center align-middle">
                                            <?= $employee['holidays_by_year'] - $employee['taken_holidays'] ?></td>
                                        <td class="text-center align-middle"><?= Utils::getDate($employee['due_date']) ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th class="align-middle">Nombre</th>
                                    <th class="align-middle text-center">Fecha de Ingreso</th>
                                    <th class="align-middle text-center">Antigüedad (años)</th>
                                    <th class="align-middle text-center">Días a disfrutar</th>
                                    <th class="align-middle text-center">Días disponibles</th>
                                    <th class="align-middle text-center">Fecha a vencer</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <!-- ===[gabo 24 julio  solicitud vacaciones]=== -->
                    <div class="tab-pane" id="tab_3">
                        <div class="table-responsive">
                            <table id="table3" class="table table-responsive table-striped table-sm" style="display: none;">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 50px;max-width:50px;min-width:50px">#
                                        </th>
                                        <th class="text-center" style="width: 150px;max-width:150px;min-width:150px">
                                            Nombre
                                        </th>
                                        <th class="text-center" style="width: 100px;max-width:100px;min-width:100px">
                                            Fecha de
                                            la solicitud</th>
                                        <th class="text-center" style="width: 150px;max-width:150px;min-width:150px">
                                            Periodo
                                            de Vacaciones</th>
                                        <th class="text-center" style="width: 100px;max-width:100px;min-width:100px">
                                            Dias
                                            solicitados</th>
                                        <th class="text-center" style="width: 100px;max-width:100px;min-width:100px">
                                            Dias
                                            Disponibles</th>
                                        <th class="text-center" style="width: 180px;max-width:180px;min-width:158px">
                                            Comentarios</th>
                                        <th class="text-center" style="width: 150px;max-width:150px;min-width:150px">
                                            Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $cont = count($solicitudes_pendientes);
                                    foreach ($solicitudes_pendientes as $solicitud) :

                                    ?>
                                        <tr id="tr>">
                                            <td class="text-center text-bold"> <?= $cont  ?></td>
                                            <td class="text-center">
                                                <?= $solicitud['first_name'] . " " . $solicitud['surname'] . " " . $solicitud['last_name']; ?>
                                            </td>
                                            <td class="text-center"> <?= Utils::getDate($solicitud['created_at']);  ?></td>
                                            <td class="text-center">
                                                <?= Utils::getDate($solicitud['start_date']) . " Al " . Utils::getDate($solicitud['end_date']);  ?>
                                            </td>
                                            <td class="text-center"> <?= $solicitud['days'];  ?></td>

                                            <td class="text-center">
                                                <?= $solicitud['holidays_by_year'] - $solicitud['taken_holidays'];  ?>
                                            </td>
                                            <td class="text-center">
                                                <?= ($solicitud['comments'] != '') ? $solicitud['comments']  : '-' ?>
                                            </td>

                                            <td class="text-center" id="td">

                                                <?php if ($solicitud['status'] == 'En revisión') : ?>

                                                    <button data-id="" value="<?= Encryption::encode($solicitud['id']) ?>" class="btn btn-success mt-1" id="btn-aceptar">
                                                        <i class="fas fa-check"> Aceptar</i>
                                                    </button>

                                                    <button data-id="<?= Encryption::encode($solicitud['id']) ?>" class="btn btn-danger mt-1" id="btn-denegar">
                                                        <i class="fas fa-ban"> Declinar</i>
                                                    </button>
                                                    <button value="<?= Encryption::encode($solicitud['id']) ?>" class="btn btn-warning mt-1" id="btn-borrar">
                                                        <i class="fas fa-ban"> Borrar</i>
                                                    </button>
                                                <?php else : ?>
                                                    <?php if ($solicitud['status'] == 'Aceptada') : ?>
                                                        <small class="badge badge-success">
                                                            Aceptada</small>
                                                    <?php else : ?>
                                                        <small class="badge badge-danger">
                                                            Declinada</small>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            </td>
                                        </tr>

                                    <?php $cont--;
                                    endforeach; ?>

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th class="text-center" style="width: 50px;max-width:50px;min-width:50px">#
                                        </th>
                                        <th class="text-center" style="width: 150px;max-width:150px;min-width:150px">
                                            Nombre
                                        </th>
                                        <th class="text-center" style="width: 100px;max-width:100px;min-width:100px">
                                            Fecha de
                                            la solicitud</th>
                                        <th class="text-center" style="width: 150px;max-width:150px;min-width:150px">
                                            Periodo
                                            de Vacaciones</th>
                                        <th class="text-center" style="width: 100px;max-width:100px;min-width:100px">
                                            Dias
                                            solicitados</th>
                                        <th class="text-center" style="width: 100px;max-width:100px;min-width:100px">
                                            Dias
                                            Disponibles</th>
                                        <th class="text-center" style="width: 180px;max-width:180px;min-width:158px">
                                            Comentarios</th>
                                        <th class="text-center" style="width: 150px;max-width:150px;min-width:150px">
                                            Acción</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    <!-- ===[gabo 24 julio  solicitud vacaciones fin]=== -->

                </div>
            </div>
            <!-- /.card-body -->
        </div>
    </section>
</div>

<script type="text/javascript" src="<?= base_url ?>app/RH/holidays.js?v=<?= rand() ?>"></script>
<script type="text/javascript" src="<?= base_url ?>app/RH/Employee_RH.js?v=<?= rand() ?>"></script>

<script>
    document.addEventListener('DOMContentLoaded', e => {
        let table = document.querySelector('#tb_employees');
        table.style.display = "table";
        utils.dtTable(table, true);


        //===[gabo 24 julio solicitud vacaciones]===
        let table3 = document.querySelector('#table3');
        table3.style.display = 'table';
        utils.dtTable(table3, true);
        //===[gabo 24 julio solicitud vacaciones fin]===

        document.querySelector('#btn_new_holidays').addEventListener('click', e => {
            e.preventDefault();

            document.querySelector("#modal_create_holidays form").reset();
            $('#modal_create_holidays form select').val(null).trigger('change');
            $('#modal_create_holidays').modal({
                backdrop: 'static',
                keyboard: false
            });
        });

        document.querySelector('#modal_create_holidays form').addEventListener('submit', e => {
            console.log('funcion');
            let holidays = new Holidays();
            holidays.save()
            e.preventDefault();
        });

    })

    // ===[gabo 24 julio  solicitud vacaciones]===
    let table3 = document.querySelector('#table3 tbody');

    table3.addEventListener('click', e => {
        if (e.target.classList.contains('btn-success') || e.target.offsetParent.classList.contains(
                'btn-success')) {

            let id;
            if (e.target.classList.contains('btn-success'))
                id = e.target.value;
            else
                id = e.target.offsetParent.value;
            $('#id_solicitud').val(id);
            $('#div-comments').hide();
            $('#titulo-responder').text("Aceptar Solicitud");
            $('#descripcion').text("¿Estás seguro de aceptar esta solicitud? ")
            $('#accion').val("1");
            $('#modal_responder').modal('show');

        }

        if (e.target.classList.contains('btn-danger') || e.target.offsetParent.classList.contains(
                'btn-danger')) {

            let id;
            if (e.target.classList.contains('btn-danger'))
                id = e.target.dataset.id;
            else
                id = e.target.offsetParent.dataset.id;

            $('#id_solicitud').val(id);
            $('#titulo-responder').text("Declinar Solicitud");
            $('#descripcion').text("¿Estás seguro de declinar esta solicitud? ")
            $('#div-comments').show();
            $('#accion').val("0");
            $('#modal_responder').modal('show');

        }
        if (e.target.classList.contains('btn-warning') || e.target.offsetParent.classList.contains(
                'btn-warning')) {
            let ID;
            if (e.target.classList.contains('btn-warning')) {
                ID = e.target.value

            } else {
                ID = e.target.offsetParent.value
            }

            Swal.fire({
                title: '¿Quieres eliminar esta solicitud de vacaciones?',
                //text: "Se eliminara permanetemente y ya no aparecera en la lista.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Eliminar'
            }).then((result) => {
                if (result.value == true) {
                    let holidays = new Holidays();
                    holidays.delete(ID)
                }
            })
        }
    })
    // ===[gabo 24 julio  solicitud vacaciones fin]===
</script>