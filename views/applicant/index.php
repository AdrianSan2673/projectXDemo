<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <div class="alert alert-success">
                <h1>Postulaciones</h1>
            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
      
    <section class="content-header">
      <div class="row">
        <div class="col-md-5">
          <div class="info-box mb-3 bg-navy">
            <span class="info-box-icon"><i class="fas fa-address-card"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total de candidatos postulados en Bolsa de Trabajo</span>
              <span class="info-box-number"><?=count($applicants)?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
        </div>
      </div>
    </section>
    <br>
    <!-- Main content -->
    <section class="content">
        <div class="card">
            <div class="card-header">
              <h3 class="card-title">Listado de candidatos</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="tb_candidates" class="table table-responsive table-striped" style="font-size: 0.55rem;">
                <thead>
                    <tr>
                      <th class="text-center">Foto</th>
                      <th>Nombre del candidato</th>
                      <th>Fecha de postulación</th>
                      <th>Vacante a la que se postuló</th>
                      <th>Cliente</th>
                      <th>Salario</th>
                      <th>Edad</th>
                      <th>Ciudad</th>
                      <th>Estado</th>
                      <th>Escolaridad</th>
                      <th>Título</th>
                      <th>Reseña de su experiencia</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($applicants as $candidate): ?>
                    <tr>
                      <?php 
                      if (isset($_GET['id'])) {
                        if ($candidate['id_status'] == 1){
                          $bg_status = 'bg-info';
                        } elseif ($candidate['id_status'] == 2){
                          $bg_status = 'bg-orange';
                        }elseif ($candidate['id_status'] == 3){
                          $bg_status = 'bg-success';
                        }else{
                          $bg_status = '';
                        }
                      }
                      /*if ($candidate['created_by'] == 'Janet Monserrat Gómez López') {
                        $recruiter_color = 'bg-success';
                      }elseif($candidate['created_by'] == 'Ernesto Iván Sánchez Vizcaya'){
                        $recruiter_color = 'bg-orange';
                      }elseif ($candidate['created_by'] == 'María Graciela López Rodríguez') {
                        $recruiter_color = 'bg-warning';
                      }elseif($candidate['created_by'] = 'Verónica Lizeth Hernández Zuviri'){
                        $recruiter_color = 'bg-danger';
                      }elseif ($candidate['created_by'] == 'Lorena Patricia De La Rosa González') {
                        $recruiter_color = 'bg-navy';
                      }else{
                        $recruiter_color = '';
                      }*/
                      
                      ?>
                        <td class="image"><img class="img-circle img-fluid img-responsive elevation-2" src="<?=$candidate['avatar']?>" style="width:60px; height:auto;"></td>
                        <td><?=$candidate['first_name'].' '.$candidate['surname'].' '.$candidate['last_name']?></td>
                        <td><?=Utils::getShortDate($candidate['applicant_date'])?></td>
                        <td><?=$candidate['vacancy']?></td>
                        <td><?=$candidate['customer']?></td>
                        <td class="align-middle text-center">$<?=$candidate['salary_min'] != $candidate['salary_max'] ? number_format($candidate['salary_min'])  .' - $'.number_format($candidate['salary_max']) : number_format($candidate['salary_min'])?></td>
                        <td><?=$candidate['age']?></td>
                        <td><?=$candidate['city']?></td>
                        <td><?=$candidate['state']?></td>
                        <td><?=$candidate['level']?></td>
                        <td><?=$candidate['job_title']?></td>
                        <td><?=Utils::lineBreak($candidate['description'])?></td>
                        
                <?php endforeach; ?>
                    
                </tbody>
                <tfoot>
                    <tr>
                      <th>Foto</th>
                      <?php if ($_GET['controller'] == 'postulaciones' && $_GET['action'] == 'buscar'): ?>
                        <th>Seleccionar</th>
                      <?php endif ?>
                      <th>Nombre del candidato</th>
                      <th>Fecha de postulación</th>
                      <th>Vacante a la que se postuló</th>
                      <th>Cliente</th>
                      <th>Salario</th>
                      <th>Edad</th>
                      <th>Ciudad</th>
                      <th>Estado</th>
                      <th>Escolaridad</th>
                      <th>Título</th>
                      <th>Reseña de su experiencia</th>
                    </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
        </div>
    </section>
</div>
<script>
  $(document).ready(function(){
    let table = document.querySelector('#tb_candidates');
    utils.dtTable(table, true, false);
  });
</script>
<?php if ($_GET['controller'] == 'postulaciones' && $_GET['action'] == 'enviados_a_reclutador' && isset($_GET['id']) && (Utils::isAdmin() || Utils::isSenior())): ?>
  <div class="modal fade" id="modal_edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="update-form">
                <div class="modal-header">
                    <h4 class="modal-title">Entrevista</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id_applicant" id="id_applicant">
                    <div class="form-group mb-3">
                        <label class="col-form-label" for="candidate">Candidato</label>
                        <input type="text" class="form-control" name="candidate" id="candidate" readonly>
                    </div>
                    <div class="form-group mb-3">
                        <label class="col-form-label" for="interview_comments">Comentarios de la entrevista</label>
                        <textarea class="form-control" name="interview_comments" rows="10" id="interview_comments"></textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label class="col-form-label" for="interview_date">Fecha de entrevista</label>
                        <input type="date" class="form-control" id="interview_date" name="interview_date" value="<?=date("Y-m-d")?>">
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <input type="submit" name="submit" id="submit" class="btn btn-orange" value="Guardar">
                </div>
            </form>
        </div>
    </div>              
</div>
<script src="<?=base_url?>app/applicant.js?v=<?=rand()?>"></script>
<script>
  $(document).ready(function(){


    $("#tb_candidates ").on('click','.btn-comments', function () { 
        let applicant = new Applicant();
        applicant.getApplicantInterview($(this).attr('id'));
    });

    document.querySelector("#update-form").onsubmit = function(e){
      e.preventDefault();
      let applicant = new Applicant();
      applicant.update_interview();
    };
  });
</script>

<?php endif ?>
<?php if ($_GET['controller'] == 'postulaciones' && $_GET['action'] == 'buscar'): ?>
  <script src="<?=base_url?>app/applicant.js?v=<?=rand()?>"></script>
  <script>
    function postulate(e){
      e.disabled=true;
      let applicant = new Applicant();
      applicant.postulate();
    }
  </script>
<?php endif ?>