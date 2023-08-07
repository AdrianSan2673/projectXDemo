    <div class="content-wrapper">
      <div class="container mt-5">
        <div class="row">
          <div class="col-md-12 mt-5">
            <div class="card card-default">
              <div class="card-body">
                <?php if (count($vacancies) == 0): ?>
                  <p>Sin vacantes</p>
                <?php endif ?>
                <?php foreach ($vacancies as $vacancy): ?>                  
                  <div class="callout callout-success">
                    <h5><a href="<?=base_url?>bolsa/ver&vacante=<?=Encryption::encode($vacancy['id'])?>" class="text-primary"><?=$vacancy['vacancy']?></a></h5>
                    <small><?=$vacancy['city'].', '.$vacancy['abbreviation']?></small>
                    <p><?=Utils::linebreak($vacancy['functions'])?></p>
                  </div>
                <?php endforeach ?>    
              </div>
              <!-- /.card-body -->
            </div>
          </div>
        </div>
      </div>
    </div>