<style type="text/css">
    .timeline-item{
        background-color: transparent !important;
        box-shadow: none !important;
    }
    .timeline-header{
        border: none !important ;
    }
    .timeline .bg-secondary {
        background-color: #ccc !important;
    }
</style>
<div class="content-wrapper">
    <div class="container">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left mb-2">
                        <li class="breadcrumb-item"><a href="<?=base_url?>">Inicio</a></li>
                    </ol>
                </div>
                  <div class="col-sm-12">
                    <div class="alert alert-success">
                        <h4>Seguimiento a <?=$candidato_datos->Servicio_Solicitado?></h4>
                    </div>       
                  </div>
            </div>
          </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <div class="timeline">
                            <?php foreach ($fechas as $key => $fecha): ?>
                                <?php if ($key == 'Fecha_RAL' && !is_null($fecha)): ?>
                                    <!-- timeline item -->
                                    <div>
                                        <i class="fas fa-check bg-success"></i>
                                        <div class="timeline-item">
                                            <span class="time"><i class="fas fa-clock"></i> <?=Utils::getFullDate($busqueda_RAL->Fecha)?></span>
                                            <h3 class="timeline-header">Consulta de Registro de Antecedentes Legales</h3>
                                        </div>
                                    </div>
                                    <!-- END timeline item -->  
                                <?php endif ?>
                                <?php if ($key == 'Fecha'): ?>
                                    <!-- timeline item -->
                                    <div>
                                        <i class="fas fa-check bg-success"></i>
                                        <div class="timeline-item">
                                            <span class="time"><i class="fas fa-clock"></i> <?=Utils::getFullDate($candidato_datos->Fecha)?></span>
                                            <h3 class="timeline-header">Solicitud de <?=$candidato_datos->Servicio_Solicitado?> iniciada</h3>
                                        </div>
                                    </div>
                                    <!-- END timeline item -->
                                <?php endif ?>
                                <?php if ($key == 'Fecha_Contactado' && !is_null($fecha)): ?>
                                    <!-- timeline item -->
                                    <div>
                                        <i class="fas fa-check bg-success"></i>
                                        <div class="timeline-item">
                                            <span class="time"><i class="fas fa-clock"></i> <?=Utils::getFullDate($candidato_datos->Fecha_Contactado)?></span>
                                            <h3 class="timeline-header">Se contactó <?=$candidato_datos->Sexo == 99 ? 'a la candidata': 'al candidato'?></h3>
                                        </div>
                                    </div>
                                    <!-- END timeline item -->
                                <?php endif ?>
                                <?php if ($key == 'Fecha_Entregado_INV'): ?>
                                    <?php if ($candidato_datos->Servicio == 299 || $candidato_datos->Servicio == 300 || $candidato_datos->Servicio == 231): ?>
                                        <!-- timeline item -->
                                        <div>
                                            <i class="fas fa-check bg-success"></i>
                                            <div class="timeline-item">
                                                <h3 class="timeline-header">Investigación laboral en Proceso</h3>
                                                <div class="timeline-body">
                                                    <ul>
                                                        <?php if (!$candidato_datos->Fecha_Entregado_INV): ?>
                                                            <?php if ($referencias && !$referencias_laborales && !$investigacion): ?>
                                                                <li>Obteniendo referencias personales</li>
                                                            <?php endif ?>
                                                            <?php if ($referencias_laborales && !$investigacion): ?>
                                                                <?php if ($referencias): ?>
                                                                    <li class="text-muted">Referencias personales obtenidas</li>
                                                                <?php endif ?>
                                                                <li>Obteniendo referencias laborales</li>
                                                            <?php endif ?>
                                                            <?php if ($investigacion): ?>
                                                                <?php if ($referencias): ?>
                                                                    <li class="text-muted">Referencias personales obtenidas</li>
                                                                <?php endif ?>
                                                                <?php if ($referencias_laborales): ?>
                                                                    <li class="text-muted">Referencias laborales obtenidas</li>
                                                                <?php endif ?>
                                                                <li>Obteniendo información laboral</li>
                                                            <?php endif ?>
                                                        <?php else: ?>
                                                            <?php if ($referencias): ?>
                                                                <li class="text-muted">Referencias personales obtenidas</li>
                                                            <?php endif ?>
                                                            <?php if ($referencias_laborales): ?>
                                                                <li class="text-muted">Referencias laborales obtenidas</li>
                                                            <?php endif ?>
                                                            <?php if ($investigacion): ?>
                                                                <li class="text-muted">Información laboral obtenida</li>
                                                            <?php endif ?>
                                                        <?php endif ?>

                                                    </ul>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END timeline item -->
                                        <!-- timeline item -->
                                        <div>
                                            <i class="fas <?=$candidato_datos->Fecha_Entregado_INV ? 'fa-check bg-success' : 'bg-secondary'?> "></i>
                                            <div class="timeline-item">
                                                <span class="time"><i class="fas fa-clock"></i> <?=$candidato_datos->Fecha_Entregado_INV ? Utils::getFullDate($candidato_datos->Fecha_Entregado_INV) : '' ?></span>
                                                <h3 class="timeline-header <?=!$candidato_datos->Fecha_Entregado_INV ? 'text-muted': '' ?>">Investigación laboral Finalizada</h3>
                                            </div>
                                        </div>
                                        <!-- END timeline item -->
                                    <?php endif ?>
                                <?php endif ?>
                                <?php if ($key == 'Fecha_Aplicacion' && !is_null($fecha)): ?>
                                    <?php if ($candidato_datos->Servicio == 299 || $candidato_datos->Servicio == 300 || $candidato_datos->Servicio == 230): ?>
                                        <!-- timeline item -->
                                        <div>
                                            <i class="fas fa-check bg-success"></i>
                                            <div class="timeline-item">
                                                <span class="time"><i class="fas fa-clock"></i> <?=Utils::getFullDate($candidato_datos->Fecha_Aplicacion)?></span>
                                                <h3 class="timeline-header">Realizando Verificación Domiciliaria</h3>
                                                <div class="timeline-body">
                                                    <ul>
                                                        <?php if (!$candidato_datos->Fecha_Entregado_ESE || !$candidato_datos->Fecha_Entregado): ?>
                                                            <?php if ($escolaridad && !$cohabitantes && !$ubicacion && !$vivienda && !$ingresos && !$egresos && !$creditos && !$cuentas && !$seguros && !$inmuebles && !$vehiculos): ?>
                                                                <li>Obteniendo escolaridad</li>
                                                            <?php endif ?>
                                                            <?php if ($cohabitantes && !$ubicacion && !$vivienda && !$ingresos && !$egresos && !$creditos && !$cuentas && !$seguros && !$inmuebles && !$vehiculos): ?>
                                                                <?php if ($escolaridad): ?>
                                                                    <li class="text-muted">Escolaridad obtenida</li>
                                                                <?php endif ?>
                                                                <li>Obteniendo cohabitantes</li>
                                                            <?php endif ?>
                                                            <?php if (($ubicacion || $vivienda) && !$ingresos && !$egresos && !$creditos && !$cuentas && !$seguros && !$inmuebles && !$vehiculos): ?>
                                                                <?php if ($escolaridad): ?>
                                                                    <li class="text-muted">Escolaridad obtenida</li>
                                                                <?php endif ?>
                                                                <?php if ($cohabitantes): ?>
                                                                    <li class="text-muted">Cohabitantes obtenidos</li>
                                                                <?php endif ?>
                                                                <li>Obteniendo ubicación</li>
                                                            <?php endif ?>
                                                            <?php if (($ingresos || $egresos) && !$creditos && !$cuentas && !$seguros && !$inmuebles && !$vehiculos): ?>
                                                                <?php if ($escolaridad): ?>
                                                                    <li class="text-muted">Escolaridad obtenida</li>
                                                                <?php endif ?>
                                                                <?php if ($cohabitantes): ?>
                                                                    <li class="text-muted">Cohabitantes obtenidos</li>
                                                                <?php endif ?>
                                                                <?php if ($ubicacion || $vivienda): ?>
                                                                    <li class="text-muted">Ubicación obtenida</li>
                                                                <?php endif ?>
                                                                <li>Obteniendo economía familiar</li>
                                                            <?php endif ?>
                                                            <?php if (($creditos || $cuentas || $seguros) && !$inmuebles && !$vehiculos): ?>
                                                                <?php if ($escolaridad): ?>
                                                                    <li class="text-muted">Escolaridad obtenida</li>
                                                                <?php endif ?>
                                                                <?php if ($cohabitantes): ?>
                                                                    <li class="text-muted">Cohabitantes obtenidos</li>
                                                                <?php endif ?>
                                                                <?php if ($ubicacion || $vivienda): ?>
                                                                    <li class="text-muted">Ubicación obtenida</li>
                                                                <?php endif ?>
                                                                <?php if ($ingresos && $egresos): ?>
                                                                    <li class="text-muted">Economía familiar obtenida</li>
                                                                <?php endif ?>
                                                                <li>Obteniendo información financiera</li>
                                                            <?php endif ?>
                                                            <?php if ($inmuebles || $vehiculos): ?>
                                                                <?php if ($escolaridad): ?>
                                                                    <li class="text-muted">Escolaridad obtenida</li>
                                                                <?php endif ?>
                                                                <?php if ($cohabitantes): ?>
                                                                    <li class="text-muted">Cohabitantes obtenidos</li>
                                                                <?php endif ?>
                                                                <?php if ($ubicacion || $vivienda): ?>
                                                                    <li class="text-muted">Ubicación obtenida</li>
                                                                <?php endif ?>
                                                                <?php if ($ingresos && $egresos): ?>
                                                                    <li class="text-muted">Economía familiar obtenida</li>
                                                                <?php endif ?>
                                                                <?php if ($creditos || $cuentas || $seguros): ?>
                                                                    <li class="text-muted">Obteniendo información financiera</li>
                                                                <?php endif ?>
                                                                <li>Obteniendo información patrimonial</li>
                                                            <?php endif ?>

                                                        <?php else: ?>
                                                            <?php if ($escolaridad): ?>
                                                                <li class="text-muted">Escolaridad obtenida</li>
                                                            <?php endif ?>
                                                            <?php if ($cohabitantes): ?>
                                                                <li class="text-muted">Cohabitantes obtenidos</li>
                                                            <?php endif ?>
                                                            <?php if ($ubicacion && $vivienda): ?>
                                                                <li class="text-muted">Ubicación obtenida</li>
                                                            <?php endif ?>
                                                            <?php if ($ingresos && $egresos): ?>
                                                                <li class="text-muted">Economía familiar obtenida</li>
                                                            <?php endif ?>
                                                            <?php if ($creditos || $cuentas || $seguros): ?>
                                                                <li class="text-muted">Información financiera obtenida</li>
                                                            <?php endif ?>
                                                            <?php if ($inmuebles || $vehiculos): ?>
                                                                <li class="text-muted">Información patrimonial obtenida</li>
                                                            <?php endif ?>
                                                        <?php endif ?>

                                                    </ul>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END timeline item -->
                                        <!-- timeline item -->
                                        <div>
                                            <i class="fas <?=$candidato_datos->Fecha_Entregado_ESE ? 'fa-check bg-success' : 'bg-secondary' ?>"></i>
                                            <div class="timeline-item">
                                                <span class="time"> <?= $candidato_datos->Fecha_Entregado_ESE ? '<i class="fas fa-clock"></i> '.Utils::getFullDate($candidato_datos->Fecha_Entregado_ESE) : ''?></span>
                                                <h3 class="timeline-header <?=!$candidato_datos->Fecha_Entregado_ESE ? 'text-muted' : '' ?>">Verificación Domiciliaria Finalizada</h3>
                                            </div>
                                        </div>
                                        <!-- END timeline item -->  
                                    <?php endif ?>  
                                <?php endif ?>
                            <?php endforeach ?>
                            <div>
                                <i class="fas <?=$candidato_datos->Estado == 252 || $candidato_datos->Estado == 254 ? 'fa-check bg-success' : 'bg-secondary' ?>"></i>
                                <div class="timeline-item">
                                    <span class="time"><i class="fas fa-clock"></i> <?=$candidato_datos->Fecha_Entregado ? Utils::getFullDate($candidato_datos->Fecha_Entregado) : '' ?></span>
                                    <h3 class="timeline-header <?=$candidato_datos->Estado != 252 && $candidato_datos->Estado != 254 ? 'text-muted' : '' ?>">Entregado</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-6">
                       
                            <div class="text-center ml-5 mr-5 mb-3">
                                <img src="<?=$perfil[0]?>" class="img-fluid img-circle user-image mt-3">      
                            </div>
                            <h3 class="profile-username text-center"><b><?=$candidato_datos->Nombres?></b><p><?=$candidato_datos->Apellido_Paterno.' '.$candidato_datos->Apellido_Materno?></p></h3>
                            <h6 class="text-muted text-center"><?=$candidato_datos->Puesto?></h6>
                         <a href="<?=base_url?>ServicioApoyo/ver&candidato=<?=$_GET['candidato']?>" target="_blank" style="text-decoration: none;"></a>
                            
                    </div>
                </div>
                        
            </div><!-- /.container-fluid -->
        </section>
    </div>
</div>