<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12 ">
                    <div class="alert alert-success">
                        <h3>Directorio de candidatos</h3>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <br>
    <section class="content-header">

    </section>
    <!-- Main content -->
    <section class="content">
        <div class="card bg-transparent">
            <div class="card-header">
                <h3 class="card-title">Listado de candidatos</h3>
            </div>
            <div class="card-body">

                <div class="row">
                    <div class="col-sm-3 ml-auto">
                        <div class="btn-group mr-3 text-center">
                            <button class="btn btn-orange float-right" id="btn_new_candidate">Agregar candidato</button>
                        </div>
                    </div>
                </div>

                <div class="row pt-3 pb-3">
                    <div class="col-sm-12 ml-auto">
                        <p class="h5">Aquí podrás agregar tus contactos de candidatos para incluirlos en futuras entrevistas. Esta funcionalidad te permite ingresar los datos de contacto de personas que deseas considerar para posibles entrevistas en el futuro.</p>
                    </div>
                </div>

                <form method="post" action="<?= base_url . "CandidatoDirectorio/index" ?>">
                    <div class="row " <?= !Utils::isCustomer() || !Utils::isCustomerSA() ? '' : 'hidden' ?>>
                        <div class="col-6 mx-auto">
                            <select name="vacancy" id="search" class="form-control select2">
                                <option value="0" selected>Sin filtro</option>
                                <?php foreach ($vacancies as $vacancy) : ?>
                                    <option value="<?= $vacancy['id'] ?>" <?= isset($_POST['vacancy']) && $_POST['vacancy'] == $vacancy['id'] ? 'selected' : '' ?>><?= $vacancy['customer'] . ' / ' . $vacancy['vacancy'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-3">
                            <button type="submit" class="btn btn-app btn-block btn-info form-control" style="background-color: #17a2b8; color: #fff;"><i class="fas fa-search"></i>Buscar</button>
                        </div>
                    </div>
                </form>


                <table id="tb_candidates" class="table table-responsive table-striped table-sm" style="display: none;">
                    <thead>
                        <tr>
                            <?= !Utils::isCustomer() ? '<th class="filterhead"></th>' : '' ?>
                            <th class="filterhead"></th>
                            <?= !Utils::isCustomer() ? '<th class="filterhead"></th>' : '' ?>
                            <th></th>
                            <th></th>
                            <th class="filterhead"></th>
                            <?= !Utils::isCustomer() ? '<th class="filterhead"></th>' : '' ?>
                            <th class="filterhead"></th>
                            <?= !Utils::isCustomer() ? '<th class="filterhead"></th>' : '' ?>
                            <th></th>
                            <th></th>
                        </tr>
                        <tr>
                            <?= !Utils::isCustomer() ? '<th class="text-center align-middle">Fecha por mes</th>' : '' ?>
                            <th class="text-center align-middle">Fecha de registro</th>
                            <?= !Utils::isCustomer() ? '<th class="text-center align-middle">Fecha de actualizacion</th>' : '' ?>
                            <th class="text-center align-middle">Nombre</th>
                            <th class="text-center align-middle">Telefono</th>
                            <th class="text-center align-middle">Experencia</th>
                            <?= !Utils::isCustomer() ? ' <th class="text-center align-middle">Vacante</th>' : '' ?>
                            <th class="text-center align-middle">Estado</th>
                            <th class="text-center align-middle">Ciudad</th>
                            <?= !Utils::isCustomer() ? ' <th class="text-center align-middle">Comentario</th>' : '' ?>
                            <th class="text-center align-middle">Accion</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($candidatesDirector as $candidate) :  ?>
                            <tr class="">
                                <?= !Utils::isCustomer() ? '<td class="text-center align-middle">' . $candidate['created_at_month'] . '</td>' : '' ?>
                                <td class="text-center align-middle"><?= $candidate['created_at'] ?></td>
                                <?= !Utils::isCustomer() ? '<td class="text-center align-middle">' . $candidate['modified_at'] . '</td>' : '' ?>
                                <td class="text-center align-middle"><?= $candidate['name'] ?></td>
                                <td class="text-center align-middle"><?= $candidate['telephone'] ?></td>
                                <td class="text-center align-middle"><?= $candidate['experience']  ?></td>
                                <?= !Utils::isCustomer() ? '<td class="text-center align-middle">' . $candidate['vacancy'] . '</td>' : '' ?>
                                <td class="text-center align-middle"><?= $candidate['id_state'] ?></td>
                                <td class="text-center align-middle"><?= $candidate['id_city']  ?></td>
                                <?= !Utils::isCustomer() ? '<td class="text-center align-middle ' . $candidate['color'] . '">' . $candidate['comment'] . '</td>' : '' ?>
                                <td class="text-center  align-middle">
                                    <div class="btn-group">
                                        <button class="btn btn-info" data-id="<?= $candidate['id'] ?>">
                                            <i class="fas fa-pencil-alt"></i>
                                        </button>

                                        <a href="<?= base_url ?>candidato/ver&id=<?= $candidate['id_candidate'] ?>" class="btn btn-success ml-2 mr-2" target="_blank" <?= $candidate['hidden_ver'] ?>>
                                            <i class="fas fa-eye"></i> Ver
                                        </a>
<?php if ($candidate['id_vacancy'] != false && $candidate['vacancy'] != false) :  ?>
                                        <a href="<?= base_url ?>candidato/crear&vacante=<?= $candidate['id_vacancy'] ?>&contact=<?= $candidate['id'] ?>" class="btn btn-orange ml-2 mr-2" target="_blank" <?= $candidate['hidden'] ?>>
                                            <i class="fas fa-user-plus"></i> Agregar
                                        </a>
  <?php endif;    ?>
                                        <button class="btn btn-danger " data-id="<?= $candidate['id'] ?>" value="<?= $id_vacancy ?>" <?= $candidate['hidden'] ?>>
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach;
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <?= !Utils::isCustomer() ? '<th class="text-center align-middle">Fecha por mes</th>' : '' ?>
                            <th class="text-center align-middle">Fecha de registro</th>
                            <?= !Utils::isCustomer() ? '<th class="text-center align-middle">Fecha de actualizacion</th>' : '' ?>
                            <th class="text-center align-middle">Nombre</th>
                            <th class="text-center align-middle">Telefono</th>
                            <th class="text-center align-middle">Experencia</th>
                            <?= !Utils::isCustomer() ? ' <th class="text-center align-middle">Vacante</th>' : '' ?>
                            <th class="text-center align-middle">Estado</th>
                            <th class="text-center align-middle">Ciudad</th>
                            <?= !Utils::isCustomer() ? ' <th class="text-center align-middle">Comentario</th>' : '' ?>
                            <th class="text-center align-middle">Accion</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
    </section>
</div>

<script type="text/javascript" src="<?= base_url ?>app/candidatedirectory.js?v=<?= rand() ?>"></script>
<script type="text/javascript" src="<?= base_url ?>app/vacancy.js?v=<?= rand() ?>"></script>

<script>
    document.addEventListener('DOMContentLoaded', e => {
        let table = document.querySelector('#tb_candidates');

        table.style.display = "table";
        utils.dtTable(table, true);

        document.querySelector('#btn_new_candidate').addEventListener('click', e => {
            e.preventDefault();
            document.querySelector('#modal_create [name="flag"]').value = 1
            document.querySelector('#modal_create [name="id"]').value = ''
            document.querySelector('#modal_create [name="submit"]').hidden = false
            document.querySelector('#modal_create form').reset()

            $('#modal_create form #id_vacancy').val('').trigger('change.select2');
            $("#modal_create form [name='id_state']").val(null).trigger('change');
            $("#modal_create form [name='id_city']").val(null).trigger('change');

            $('#modal_create').modal({
                backdrop: 'static',
                keyboard: false
            });
        })


        document.querySelector('#tb_candidates').addEventListener('click', e => {
            if (e.target.classList.contains('btn-info') || e.target.offsetParent.classList.contains('btn-info')) {

                let ID;
                if (e.target.classList.contains('btn-info'))
                    ID = e.target.dataset.id;
                else
                    ID = e.target.offsetParent.dataset.id;

                document.querySelector('#modal_create [name="flag"]').value = 2
                document.querySelector('#modal_create [name="id"]').value = ID

                $('#modal_create').modal({
                    backdrop: 'static',
                    keyboard: false
                });

                let candidatedirectory = new Candidatedirectory();
                candidatedirectory.getOne();

            }

            if (e.target.classList.contains('btn-danger') || e.target.offsetParent.classList.contains('btn-danger')) {
                Swal.fire({
                    title: '¿Quieres eliminar este candidato?',
                    //text: "Se eliminara permanetemente y ya no aparecera en la lista.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    cancelButtonText: 'Cancelar',
                    confirmButtonText: 'Eliminar'
                }).then((result) => {
                    if (result.value == true) {

                        console.log(e.target.value);

                        //Eliminar
                        let ID;
                        if (e.target.classList.contains('btn-danger'))
                            ID = e.target.dataset.id;
                        else
                            ID = e.target.offsetParent.dataset.id;

                        let candidatedirectory = new Candidatedirectory();
                        candidatedirectory.delete(ID, e.target.value);

                    }
                })
            }
            e.stopPropagation();
        })

    })
</script>