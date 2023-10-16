<style>
    .navbar {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        background-color: transparent;
        transition: background-color 0.3s ease;
    }

    .photo {
        width: 200px;
        height: 200px;
        border-radius: 50%;
        overflow: hidden;

        left: 50%;
        position: absolute;
        top: 80px;
        margin-left: -100px;
    }

    .photo img {
        width: 100%;
        height: auto;
    }
</style>
<div class="content-wrapper">
    <div class="card card-widget widget-user shadow-lg">
        <!-- Add the bg color to the header using any of the bg-* classes -->
        <div class="widget-user-header text-white" style="background: url('<?= base_url ?>dist/img/services/<?=$candidato_datos->Servicio_Solicitado == 'ESE' ? 'RRHHIngenia-23-BannerServiciosEstudiosSocioeconomicos.webp' : ($candidato_datos->Servicio_Solicitado == 'INV. LABORAL' ? 'RRHHIngenia-23-BannerServiciosInvestigacionesLaborales.webp' : '')?>') center center; height: 180px;">
            <h3 class="widget-user-username text-right"><?= $candidato_datos->Nombres . ' ' . $candidato_datos->Apellido_Paterno . ' ' . $candidato_datos->Apellido_Materno ?></h3>
            <h5 class="widget-user-desc text-right">
                <?= $candidato_datos->Puesto ?>
            </h5>
        </div>
        <div class="photo">
            <img src="<?= $perfil[0] ?>" alt="User Avatar">
        </div>
        <div class="card-footer" style="padding-top: 100px;">
            <div class="row">
                <div class="col-sm-4 border-right">
                    <div class="description-block">
                        <h5 class="description-header">Servicio solicitado</h5>
                        <span class="description-text"><?=$candidato_datos->Servicio_Solicitado?></span>
                    </div>
                    <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-4 border-right">
                    <div class="description-block">
                        <h5 class="description-header">Empresa Solicitante</h5>
                        <span class="description-text"><?=$candidato_datos->Nombre_Cliente?></span>
                    </div>
                    <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-4">
                    <div class="description-block">
                        <h5 class="description-header">Resultado</h5>
                        <span class="description-text"><?=$observaciones ? ($observaciones->Viable == 0 ? 'Viable' : ($observaciones->Viable == 1 ? 'No viable' : ($observaciones->Viable == 2 ? 'Viable con reservas' : ($observaciones->Viable == 4 ? 'Sin viabilidad' : ($observaciones->Viable == 5 ? 'Viable con observaciones' : ''))))) : 'Sin obtener'?></span>
                    </div>
                    <!-- /.description-block -->
                </div>
                <!-- /.col -->
            </div>
            <div class="row mt-5">
                <div class="col-md-8 col-6 mx-auto">
                    <b>Comentarios generales de la Investigación laboral</b>
                    <p><?= $observaciones && $observaciones->Comentario_General_il ? Utils::lineBreak($observaciones->Comentario_General_il) : 'Aún no hay comentarios de la investigación' ?></p>
                </div>
            </div>
        </div>
    </div>
    <div class="container" hidden>
        <div class="row">
            <div class="col-md-4 col-6">
                <div class="text-center ml-5 mr-5 mb-3">
                    <img src="<?= $perfil[0] ?>" class="img-fluid img-circle user-image mt-3">
                </div>
                <h3 class="profile-username text-center"><b></b>
                </h3>
                <h6 class="text-muted text-center"><?= $candidato_datos->Puesto ?></h6>
            </div>
            <div class="col-md-8 col-6">
                <b>Comentarios generales de la Investigación laboral</b>
                <p><?= $observaciones && $observaciones->Comentario_General_il ? $observaciones->Comentario_General_il : 'Aún no hay comentarios de la investigación' ?></p>
            </div>
        </div>
    </div>
</div>