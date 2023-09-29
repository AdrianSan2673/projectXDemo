<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left mb-2">
                        <li class="breadcrumb-item"><a href="<?= base_url ?>">Inicio</a></li>
                        <li class="breadcrumb-item active">Empresas</li>
                    </ol>
                </div>
                <div class="col-sm-12">
                    <div class="alert alert-success">
                        <h3>Empresas de SA</h3>
                    </div>

                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <?php if (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager()) : ?>
        <section class="content-header">
            <div class="row">
                <div class="col-sm-2 ml-auto">
                    <a class="btn btn-orange float-right" href="<?= base_url ?>empresa_SA/crear">Crear empresa</a>
                </div>
            </div>
        </section>
        <br>
    <?php endif ?>
    <!-- Main content -->
    <section class="content">
        <div class="card car-success">
            <div class="card-header">
                <h3 class="card-title">Listado de empresas</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="tb_customers" class="table table-striped">
                    <thead>

                        <tr>
                            <th class="align-middle">Empresa</th>
                            <!-- ===[gabo 7 agosto creado por ]=== -->
                            <th class="text-center">Creado Por</th>
                            <!-- ===[gabo 7 agosto creado por fin=== -->
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($empresas as $empresa) : ?>
                            <tr>
                                <td class="text-left align-middle"><?= $empresa['Nombre_Empresa'] ?></td>
                                <td class="text-center py-0 align-middle"> <?= $empresa['creado_por'] ?> </td>
                                <td class="text-center py-0 align-middle">
                                    <div class="btn-group btn-group-sm">
                                        <a href="<?= base_url ?>empresa_SA/ver&id=<?= Encryption::encode($empresa['Empresa']) ?>" class="btn btn-success"> <i class="fas fa-eye"></i> Ver
                                        </a>  <button class="btn btn-danger ml-3"
                                        data-id="<?= Encryption::encode($empresa['Empresa']) ?>"
                                        <?= (!Utils::isAdmin()) ? 'hidden' : ''; ?>>
                                        <b class="h6 text-bold">X</b>
                                    </button>
                                           
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Empresa</th>
                            <!-- ===[gabo 7 agosto creado por ]=== -->
                            <th class="text-center">Creado por</th>
                            <!-- ===[gabo 7 agosto creado por fin=== -->
                            <th class="text-center">Acciones</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
    </section>
</div>
<script type="text/javascript" src="<?= base_url ?>app/cliente.js?v=<?= rand() ?>"></script>
<script>
  $(document).ready(function() {
    let table = document.querySelector('#tb_customers');
    utils.dtTable(table);

    console.log("inciio")
    document.querySelector('#tb_customers').addEventListener('click', e => {
        console.log("jla")
        if (e.target.classList.contains('btn-danger') || e.target.offsetParent.classList.contains(
                'btn-danger')) {
            let ID;
            if (e.target.classList.contains('btn-danger'))
                ID = e.target.dataset.id;
            else
                ID = e.target.offsetParent.dataset.id;

            Swal.fire({
                title: '¿Quieres eliminar esta empresa?',
                text: "No debe contener nada, como servicios, razon social, contactos, etcetera.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Eliminar'
            }).then((result) => {
                if (result.value == true) {
                    console.log(ID);
                    let cliente = new Cliente();
                    cliente.eliminarEmpresa(ID);
                }
            })

        }
        e.stopPropagation();
    })
});
</script>