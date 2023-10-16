<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <div class="alert alert-success">
                        <h3>Configuraciones</h3>
                    </div>

                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="card car-success">
            <div class="card-header">
                <h3 class="card-title">Configuraciones</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-pills">
                            <li class="nav-item">
                                <a class="nav-link active" href="#tabla-area" data-toggle="tab">Areas</a>
                            </li>
                        </ul>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <?php require_once 'views/configuraciones/Areas/tablaArea.php';  ?>

                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
    </section>
</div>
<script src="<?= base_url ?>app/area.js?v=<?= rand() ?>"></script>