<div class="content-wrapper">
    <div class="content">
        <div class="container-fluid">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-left mb-2">
                                <li class="breadcrumb-item"><a href="<?= base_url ?>">Inicio</a></li>
                                <?php if (Utils::isCustomerSA()): ?>
                                    <li class="breadcrumb-item"><a href="<?= base_url ?>evaluacionempleado/index&start_date=<?= Encryption::encode($evaluation_employee->start_date) ?>&end_date=<?= Encryption::encode($evaluation_employee->end_date) ?>">Período <?=$evaluation_employee->start_date.' - '.$evaluation_employee->end_date?> </a></li>
                                <?php endif ?>
                                <?php if (isset($_GET['id_boss'])): ?>
                                    <li class="breadcrumb-item"><a href="<?= base_url ?>evaluacionempleado/index&id_boss=<?= Encryption::encode($evaluation_employee->id_boss) ?>">Jefe inmediato</a></li>
                                <?php endif ?>
                            </ol>
                        </div>
                        <div class="col-sm-12">
                            <div class="alert alert-success">
                                <h4>
                                    <b><?=$evaluation->name?></b>
                                </h4>
                            </div>
                        </div>

                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card card-primary card-outline">
                                <div class="card-body box-profile">
                                    <div class="text-center ml-5 mr-5 mb-3">
                                        <img src="<?= $avatar->image[0] ?>" class="img-fluid img-circle user-image mt-3">
                                    </div>
                                    <h3 class="profile-username text-center title-empelado"><?= $employee->first_name . " " . $employee->surname . " " . $employee->last_name  ?></h3>

                                    <p class="text-muted text-center title-position"><?= $position->title ?></p>

                                    <ul class="list-group list-group-unbordered mb-3">
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <strong><i class="fas fa-user"></i> Edad</strong>
                                                    <p class="text-muted"><?= date("Y") - date("Y", strtotime($employee->date_birth)) . ' Años'; ?></p>
                                                </div>
                                                <div class="col-md-6">
                                                    <strong><i class="fas fa-user-friends"></i> Estado Civíl</strong>
                                                    <p class="text-muted" id="civil_status"> <?= isset($employee->civil_status) ? $employee->civil_status : 'Sin definir' ?></p>
                                                </div>
                                            </div>
                                        </li>

                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-6">
                                                    <strong><i class="fas fa-trophy"></i> No. de empleado</strong>
                                                    <p class="text-muted" id="employee_number"><?= isset($employee->employee_number) ? $employee->employee_number : 'Sin definir' ?></p>

                                                </div>
                                                <div class="col-6">

                                                    <strong><i class="fas fa-trophy"></i> Antiguedad</strong>
                                                    <p class="text-muted"><?= date('Y', time()) - date("Y", strtotime($employee->start_date)) . ' Años'; ?></p>

                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                            </div>
                        </div>

                        <div class="col-md-9">
                            <div class="card card-info">
                                <form action="post" id="evaluate_form">
                                    <input type="hidden" name="id_employee" value="<?=$employee->id?>">
                                    <input type="hidden" name="id_evaluation_employee" value="<?=$id?>">
                                    <div class="card-body">
                                        <div id="accordion">

                                        <?php foreach ($evaluationCategory as $evaluacionCat) : ?>
                                          <div class="card">
                                            <div class="card-header">
                                              <h4 class="card-title w-100">
                                                <div class="row">
                                                  <div class="col-md-11">
                                                    <a class="d-block w-100 collapsed" data-toggle="collapse" href="#collapse_<?= $evaluacionCat['id'] ?>" aria-expanded="true">
                                                      <!-- nombre de cateogria  -->
                                                      <?= $evaluacionCat['category'] ?>
                                                    </a>
                                                  </div>

                                                </div>
                                              </h4>
                                            </div>

                                            <!-- id de categoria  -->
                                            <div id="collapse_<?= $evaluacionCat['id'] ?>" class="collapse show" data-parent="#accordion">
                                              <div class="card-body">
                                                <!-- description de categoria -->
                                                <p><?= $evaluacionCat['description'] ?></p>

                                                <div id="div_category_cirterion_<?= $evaluacionCat['id'] ?>">

                                                  <?php $getCriterionsCategory = Utils::getAllCriterionsByIdCategory($evaluacionCat['id']); ?>
                                                  <?php foreach ($getCriterionsCategory as $criterionCategory) : ?>

                                                    <div class="row">
                                                      <div class="col-md-12">
                                                        <div class="card">
                                                          <div class="card-header bg-cyan">
                                                            <h5 class="card-title" id="criterion_name_<?= $criterionCategory['id'] ?>"><?= isset($criterionCategory['criterion']) ? $criterionCategory['criterion'] : 'Criterio' ?></h5>
                                                          </div>

                                                          <div class="card-body" style="display: block;" id="card_body_criterion_<?= $criterionCategory['id'] ?>">

                                                            <div class="row">
                                                              <div class="col-11">
                                                                <table class="table table-bordered table-hover mt-3">
                                                                  <!-- id de categoria -->
                                                                  <thead id="thead_category_<?= $criterionCategory['id'] ?>">
                                                                    <tr>

                                                                      <th>
                                                                        <!-- En la consulta de categoria sale este dato Si tiene categoria creada se ve sino se genera la palabra categoria -->
                                                                        <?= isset($criterionCategory['criterion']) ? $criterionCategory['criterion'] : 'Criterio' ?>
                                                                        <!-- id de categoria -->
                                                                        
                                                                      </th>

                                                                      <?php $criterionScoreColums = Utils::getCriterionScoreByIdCriterion($criterionCategory['id']); ?>
                                                                      <?php
                                                                      foreach ($criterionScoreColums as $criterionscoreCol) : ?>
                                                                        <th>
                                                                          <?= $criterionscoreCol['name']  ?>
                                                                          <!-- id de criterion score -->
                                                                        </th>
                                                                      <?php endforeach; ?>
                                                                    </tr>


                                                                  </thead>
                                                                  <!--  id de categoria -->
                                                                  <tbody id="tbody_category_<?= $criterionCategory['id'] ?>">

                                                                    <?php $questionsRows = Utils::getQuestionsCriterionByIdCriterion($criterionCategory['id']);
                                                                    foreach ($questionsRows as $questRow) : ?>

                                                                      <tr>
                                                                        <th>
                                                                          <?= $questRow['question'] ?>
                                                                          <?php if ($questRow['definition'] != '' || $questRow['definition'] != null) : ?>
                                                                            <small class="badge badge-dark floa" data-toggle="tooltip" data-placement="top" title="<?= $questRow['definition'] ?>">
                                                                              <i class="fas fa-question"></i>
                                                                            </small>
                                                                          <?php endif; ?>
                                                                        </th>

                                                                        <?php for ($i = 0; $i < count($criterionScoreColums); $i++) : ?>
                                                                          <td class="align-middle"><input type="radio" name="question<?=$questRow['id']?>" class="form-control" value="<?=$criterionScoreColums[$i]['value']?>" required></td>
                                                                        <?php endfor; ?>

                                                                      </tr>
                                                                    <?php endforeach; ?>
                                                                  </tbody>

                                                                </table>
                                                              </div>
                                                            </div>

                                                          </div>
                                                        </div>

                                                      </div>
                                                    </div>

                                                  <?php endforeach; ?>
                                                </div><!-- div_category -->

                                              </div>
                                            </div>


                                          </div>
                                        <?php endforeach; ?>

                                        </div>
                                        <?php foreach ($openQuestions as $op): ?>
                                            <div class="form-group">
                                                <label class="col-form-label"><?=$op['question']?></label>
                                                <textarea class="form-control" rows="7" name="open<?=$op['id']?>" required></textarea>
                                            </div>
                                        <?php endforeach ?>
                                    </div>
                                    <div class="card-footer">
                                        <div class="text-right">
                                            <input type="submit" class="btn btn-orange btn-lg" value="Enviar evaluación">
                                        </div>
                                    </div>
                                </form>
                                    
                            </div>
                        </div><!-- /.container-fluid -->
            </section>

        </div>

    </div>
</div>
<script type="text/javascript" src="<?= base_url ?>app/RH/employee.js?v=<?= rand() ?>"></script>
<script type="text/javascript" src="<?=base_url?>app/RH/evaluations.js?v=<?=rand()?>"></script>
<script type="text/javascript" src="<?= base_url ?>app/RH/historyposition.js?v=<?= rand() ?>"></script>
<script type="text/javascript" src="<?= base_url ?>app/RH/incidence.js?v=<?= rand() ?>"></script>
<script type="text/javascript" src="<?= base_url ?>app/RH/training.js?v=<?= rand() ?>"></script>
<script type="text/javascript" src="<?= base_url ?>app/RH/contract.js?v=<?= rand() ?>"></script>
<script type="text/javascript">
  document.addEventListener('DOMContentLoaded', e => {
    document.querySelector('#evaluate_form').addEventListener('submit', e => {
        let evaluation = new Evaluations();
        evaluation.evaluate();
        e.preventDefault();

    })

    $(function() {
      $('[data-toggle="tooltip"]').tooltip()
    })
  })
</script>