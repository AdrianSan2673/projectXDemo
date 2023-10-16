<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12 ">
                    <div class="alert alert-success">
                        <h3>Contactos</h3>
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
                <h3 class="card-title">Listado de contactos</h3>
            </div>
            <div class="card-body">




                <table id="tb_candidates" class="table table-responsive table-striped table-sm" style="display: none;">
                    <thead>
                        <tr>

                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                        <tr>
                            <th class="text-center align-middle">Nombre</th>
                            <th class="text-center align-middle">Telefono</th>
                            <th class="text-center align-middle">Vacante</th>
                            <th class="text-center align-middle">Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($candidatecontact as $candidate) :  ?>
                        <tr class="">
                            <td class="text-center align-middle">
                                <?= $candidate['first_name'] . " " . $candidate['surname'] . " " . $candidate['last_name'] ?>
                            </td>
                            <td class="text-center align-middle"><?= $candidate['telephone'] ?></td>
                            <td class="text-center align-middle"><?= $candidate['vacancy'] ?></td>
                            <td class="text-center  align-middle">
                                <div class="btn-group">

                                    <?php if ($candidate['status'] == 1) : ?>
                                    <button class="btn btn-success" data-id="<?= $candidate['id'] ?>">
                                        <i class="fas fa-check"></i>
                                    </button>
                                    <button class="btn btn-danger " data-id="<?= $candidate['id'] ?>">
                                        <i class="fas fa-times-circle "></i>
                                    </button>

                                    <?php else : ?>

                                    <?= ($candidate['status'] == 2) ? 'Descartado' : '' ?>
                                    <?= ($candidate['status'] == 3) ? 'En directorio' : '' ?>

                                    <?php endif; ?>





                                </div>
                            </td>
                        </tr>
                        <?php endforeach;
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th class="text-center align-middle">Fecha de registro</th>
                            <th class="text-center align-middle">Nombre</th>
                            <th class="text-center align-middle">Telefono</th>
                            <th class="text-center align-middle">Estado</th>
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


    document.querySelector('#tb_candidates').addEventListener('click', e => {
        if (e.target.classList.contains('btn-success') || e.target.offsetParent.classList.contains(
                'btn-success')) {

            // let ID;
            // if (e.target.classList.contains('btn-info'))
            //     ID = e.target.dataset.id;
            // else
            //     ID = e.target.offsetParent.dataset.id;


            // let candidatedirectory = new Candidatedirectory();
            // candidatedirectory.fill_modal(ID);

            Swal.fire({
                title: '¿Seguro que desea agregar este candidato al directorio?',
                //text: "Se eliminara permanetemente y ya no aparecera en la lista.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#2DD52D',
                cancelButtonColor: '#6c757d',
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Aceptar'
            }).then((result) => {
                if (result.value == true) {

                    //Eliminar
                    let ID;
                    if (e.target.classList.contains('btn-success')) {
                        ID = e.target.dataset.id;
                    } else {
                        ID = e.target.offsetParent.dataset.id;
                    }


                    let candidatedirectory = new Candidatedirectory();
                    candidatedirectory.save_contact(ID);

                }



            })

        }

        if (e.target.classList.contains('btn-danger') || e.target.offsetParent.classList.contains(
                'btn-danger')) {
            Swal.fire({
                title: '¿Seguro que quieres descartar este candidato?',
                //text: "Se eliminara permanetemente y ya no aparecera en la lista.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Eliminar'
            }).then((result) => {
                if (result.value == true) {

                    //Eliminar
                    let ID;
                    if (e.target.classList.contains('btn-danger'))
                        ID = e.target.dataset.id;
                    else
                        ID = e.target.offsetParent.dataset.id;

                    let candidatedirectory = new Candidatedirectory();
                    candidatedirectory.descart_contact(ID);

                }
            })
        }
        e.stopPropagation();
    })

})
</script>