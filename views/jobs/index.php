    <div class="content-wrapper">
      <div class="container mt-5">
        <div class="row">
    
		<?php if (!isset($_SESSION['identity'])) : ?>
          <div class="col-md-12 mt-5">
            <div class="card card-primary card-outline">
              <div class="card-body">
                <p class="h6">Para poder aplicar a cualquiera de las vacantes que ofrecemos y dejar tu CV en nuestro sitio o futuras vacantes, es necesario que crees una cuenta en nuestra plataforma. Este proceso es rápido y sencillo, y solo te llevará unos pocos minutos completarlo.
                </p>
				  <div class="row">
				  	<div class="col-12 text-center">
    						<a href="<?= base_url ?>usuario/registrar?>" class="btn btn-info mb-2 h4">Registrate para postularte en nuestras vacantes</a>
    					</div>
				  </div>
              </div>
            </div>
          </div>
    	 <?php endif ?>

          <div class="col-md-4 mt-2">

            <div class="card card-primary card-outline">
              <div class="card-header">
                <h6 class="card-title">Áreas</h6>
              </div>
              <div class="card-body">
                <?php foreach ($areas as $a) : ?>
                  <?php if (isset($_GET['area'])) : ?>
                    <?php if (Encryption::decode($_GET['area']) == $a['id']) : ?>
                      <a href="<?= base_url ?>bolsa/vacantes" class="text-md"><?= $a['area'] . ' (' . $a['total'] . ')' ?> <i class="fas fa-times text-danger"></i></a>
                    <?php endif ?>
                  <?php else : ?>
                    <a href="<?= base_url ?>bolsa/vacantes&area=<?= Encryption::encode($a['id']) ?>"><?= $a['area'] . ' (' . $a['total'] . ')' ?></a><br>
                  <?php endif ?>

                <?php endforeach ?>
              </div>
            </div>
            <div class="card card-success card-outline">
              <div class="card-header">
                <h6 class="card-title">Subáreas</h6>
              </div>
              <div class="card-body">
                <?php foreach ($subareas as $sa) : ?>
                  <?php if (isset($_GET['subarea'])) : ?>
                    <?php if (Encryption::decode($_GET['subarea']) == $sa['id']) : ?>
                      <a href="<?= base_url ?>bolsa/vacantes" class="text-md"><?= $sa['subarea'] . ' (' . $sa['total'] . ')' ?> <i class="fas fa-times text-danger"></i></a>
                    <?php endif ?>
                  <?php else : ?>
                    <a href="<?= base_url ?>bolsa/vacantes&subarea=<?= Encryption::encode($sa['id']) ?>"><?= $sa['subarea'] . ' (' . $sa['total'] . ')' ?></a><br>
                  <?php endif ?>

                <?php endforeach ?>
              </div>
            </div>
            <div class="card card-danger card-outline">
              <div class="card-header">
                <h6 class="card-title">Estados</h6>
              </div>
              <div class="card-body">
                <?php foreach ($states as $s) : ?>
                  <?php if (isset($_GET['state'])) : ?>
                    <?php if (Encryption::decode($_GET['state']) == $s['id']) : ?>
                      <a href="<?= base_url ?>bolsa/vacantes" class="text-md"><?= $s['state'] . ' (' . $s['total'] . ')' ?> <i class="fas fa-times text-danger"></i></a>
                    <?php endif ?>
                  <?php else : ?>
                    <a href="<?= base_url ?>bolsa/vacantes&state=<?= Encryption::encode($s['id']) ?>"><?= $s['state'] . ' (' . $s['total'] . ')' ?></a><br>
                  <?php endif ?>

                <?php endforeach ?>
              </div>
            </div>
            <div class="card card-orange card-outline">
              <div class="card-header">
                <h6 class="card-title">Ciudades</h6>
              </div>
              <div class="card-body">
                <?php foreach ($cities as $ct) : ?>
                  <?php if (isset($_GET['city'])) : ?>
                    <?php if (Encryption::decode($_GET['city']) == $ct['id']) : ?>
                      <a href="<?= base_url ?>bolsa/vacantes" class="text-md"><?= $ct['city'] . ' (' . $ct['total'] . ')' ?> <i class="fas fa-times text-danger"></i></a>
                    <?php endif ?>
                  <?php else : ?>
                    <a href="<?= base_url ?>bolsa/vacantes&city=<?= Encryption::encode($ct['id']) ?>"><?= $ct['city'] . ' (' . $ct['total'] . ')' ?></a><br>
                  <?php endif ?>

                <?php endforeach ?>
              </div>
            </div>
          </div>
          <div class="col-md-8 mt-2">
            <?php if (count($vacancies) == 0) : ?>
              <p>Aún no hay vacantes disponibles</p>
            <?php endif ?>
            <?php foreach ($vacancies as $vacancy) : ?>
              <div class="callout callout-success">
                <h5><a href="<?= base_url ?>bolsa/ver&vacante=<?= Encryption::encode($vacancy['id']) ?>" class="text-primary" style="text-decoration: none;"><?= $vacancy['vacancy'] ?></a></h5>
                <i class="fas fa-map-marker-alt"></i> <b class="text-navy"><?= $vacancy['city'] . ', ' . $vacancy['abbreviation'] ?></b>
                <p><?= Utils::linebreak($vacancy['functions']) ?></p>
              </div>
            <?php endforeach ?>
          </div>
        </div>
      </div>
    </div>