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
                                <a class="nav-link active  ml-2" href="#tabla-holidays" data-toggle="tab">Dias
                                    Festivos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " href="#tabla-asystence" data-toggle="tab">Tipos de
                                    Asistencia</a>
                            </li>

                        </ul>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane  " id="tabla-asystence">
                                <?php require_once 'views/SettingsRH/AsistenceTypes/tablaAsistenceTypes.php';  ?>
                            </div>

                            <div class="tab-pane active" id="tabla-holidays">
                                <?php require_once 'views/SettingsRH/Holidays/tablaHolidays.php';
                                ?>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
    </section>
</div>
<script src="<?= base_url ?>app/area.js?v=<?= rand() ?>"></script>