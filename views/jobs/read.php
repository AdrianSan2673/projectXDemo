    <div class="content-wrapper">
    	<div class="container">
    		<div class="row mb-2">
    			<div class="col-sm-12">
    				<div class="alert alert-success mt-5">
    					<h4><?= $vacante->vacancy ?></h4>
    				</div>
    			</div>
    		</div>
    		<div class="row text-center">
    			<div class="col-md-3">
    				<p><?= $vacante->city . ', ' . $vacante->state ?></p>
    			</div>
    			<div class="col-md-3">
    				<p class="text-muted"><?= Utils::getFullDate($vacante->request_date) ?></p>
    			</div>
    			<?php if (Utils::isCandidate()) : ?>
    				<?php if ($postulacion && $postulacion->id_status == 1) : ?>
    					<div class="col-md-3">
    						<a href="<?= base_url ?>postulaciones/postulate&id_candidate=<?= Encryption::encode($_SESSION['identity']->id) ?>&id_vacancy=<?= $_GET['vacante'] ?>" class="btn btn-danger mb-2">Quitar postulación</a>
    					</div>
    				<?php else : ?>
    					<?php if (!$postulacion) : ?>
    						<div class="col-md-3">
    							<a href="<?= base_url ?>postulaciones/postulate&id_candidate=<?= Encryption::encode($_SESSION['identity']->id) ?>&id_vacancy=<?= $_GET['vacante'] ?>" class="btn btn-info mb-2">Postular </a>
    						</div>
    					<?php endif ?>

    				<?php endif ?>

    			<?php else : ?>
    				<?php if (!isset($_SESSION['identity'])) : ?>
    					<div class="col-md-6">
    						<a href="<?= base_url ?>usuario/registrar&vacante=<?= $_GET['vacante'] ?>" class="btn btn-info mb-2">Registrate para postularte en esta vacante</a>
    					</div>
    				<?php endif ?>

    			<?php endif ?>

    		</div>
    		<div class="row">
    			<div class="col-md-12">
    				<div class="card card-success">
    					<div class="card-header">
    						<h4 class="card-title">Perfil del Puesto</h4>
    					</div>
    					<!-- /.card-header -->

    					<div class="card-body">
    						<div class="row">
    							<div class="col-md-6">
    								<b>Puesto</b>
    								<p><?= $vacante->vacancy ?></p>
    							</div>
    							<div class="col-md-6">
    								<b>Departamento</b>
    								<p><?= $vacante->department ?></p>
    							</div>
    						</div>
    						<div class="row">
    							<div class="col-md-6">
    								<b>Puesto al que le reportará</b>
    								<p><?= $vacante->report_to ?></p>
    							</div>
    							<div class="col-md-6">
    								<b>¿Tendrá personal a cargo?</b>
    								<p><?= $in_charge = ($vacante->personal_in_charge == 1) ? 'Sí' : 'No' ?></p>
    							</div>
    						</div>
    						<div class="row">
    							<div class="col-md-6">
    								<b>Área</b>
    								<p><?= $vacante->area ?></p>
    							</div>
    							<div class="col-md-6">
    								<b>Subárea</b>
    								<p><?= $vacante->subarea ?></p>
    							</div>
    						</div>
    					</div>
    					<!-- /.card-body -->
    				</div>
    				<div class="card card-info">
    					<div class="card-header">
    						<h4 class="card-title">Descripción del Puesto</h4>
    					</div>
    					<div class="card-body">
    						<div class="row">
    							<div class="col-md-4">
    								<b>Escolaridad requerida</b>
    								<p><?= $vacante->level ?></p>
    							</div>
    							<div class="col-md-4">
    								<b>Número de posiciones requeridas</b>
    								<p><?= $vacante->position_number ?></p>
    							</div>
    							<div class="col-md-4">
    								<b>Años de experiencia</b>
    								<p><?= $years = ($vacante->experience_years == 0) ? 'Sin experiencia' : $vacante->experience_years ?></p>
    							</div>
    						</div>
    						<div class="row">
    							<div class="col-md-12">
    								<b>Experiencias</b>
    								<p><?= Utils::lineBreak($vacante->experience) ?></p>
    							</div>
    						</div>
    						<div class="row">
    							<div class="col-md-12">
    								<b>Requisitos</b>
    								<p><?= Utils::lineBreak($vacante->requirements) ?></p>
    							</div>
    						</div>
    						<div class="row">
    							<div class="col-md-12">
    								<b>Habilidades</b>
    								<p><?= Utils::lineBreak($vacante->skills) ?></p>
    							</div>
    						</div>
    						<div class="row">
    							<div class="col-md-12">
    								<b>Conocimientos técnicos</b>
    								<p><?= Utils::lineBreak($vacante->technical_knowledge) ?></p>
    							</div>
    						</div>
    						<div class="row">
    							<div class="col-md-4">
    								<b>Edad</b>
    								<p><?= 'entre ' . $vacante->age_min . ' y ' . $vacante->age_max . ' años' ?></p>
    							</div>
    							<div class="col-md-4">
    								<b>Sexo</b>
    								<p><?= $vacante->gender ?></p>
    							</div>
    							<div class="col-md-4">
    								<b>Estado civil</b>
    								<p><?= $vacante->status ?></p>
    							</div>
    						</div>
    						<div class="row">
    							<div class="col-md-4">
    								<b>Idioma y nivel</b>
    								<p><?= $vacante->language . ' ' . $vacante->language_level ?></p>
    							</div>
    						</div>
    						<div class="row">
    							<div class="col-md-12">
    								<b>Prestaciones</b>
    								<p><?= Utils::lineBreak($vacante->benefits) ?></p>
    							</div>
    						</div>
    						<div class="row">
    							<div class="col-md-4">
    								<b>Días de trabajo</b>
    								<p><?= $vacante->workdays ?></p>
    							</div>
    							<div class="col-md-4">
    								<b>Horarios</b>
    								<p><?= $vacante->schedule ?></p>
    							</div>
    							<div class="col-md-4">
    								<b>Ciudad y estado</b>
    								<p><?= $vacante->city . ', ' . $vacante->state ?></p>
    							</div>
    						</div>
    					</div>
    				</div>
    				<div class="card card-orange" <?= $vacante->functions != '' || $vacante->functions != null ? $vacante->functions : 'hidden' ?>>
    					<div class="card-header">
    						<h4 class="card-title">Descripción de funciones</h4>
    					</div>
    					<div class="card-body">
    						<div class="row">
    							<div class="col-md-12">
    								<p><?= Utils::linebreak($vacante->functions) ?></p>
    							</div>
    						</div>
    					</div>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>