 <!-- GABO 11 MAYO -->
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
                                 <?php if (Utils::isCustomerSA() && isset($_GET['id'])) : ?>
                                 <li class="breadcrumb-item"><a
                                         href="<?= base_url ?>evaluacionempleado/index2&id_group=<?= Encryption::encode($evaluation_employee->id_group_evaluation) ?>">Evaluaciones</a>
                                 </li>
                                 <?php endif ?>

                                 <li class="breadcrumb-item active title-empelado">
                                     <?= $employee->first_name . " " . $employee->surname . " " . $employee->last_name  ?>
                                 </li>
                             </ol>
                         </div>
                         <div class="col-sm-12">
                             <div class="alert alert-success">
                                 <h4>
                                     <b><?= $evaluation->name ?></b>
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
                                         <img src="<?= $avatar->image[0] ?>"
                                             class="img-fluid img-circle user-image mt-3">
                                     </div>
                                     <h3 class="profile-username text-center title-empelado">
                                         <?= $employee->first_name . " " . $employee->surname . " " . $employee->last_name  ?>
                                     </h3>

                                     <p class="text-muted text-center title-position"><?= $position->title ?></p>

                                     <ul class="list-group list-group-unbordered mb-3">
                                         <li class="list-group-item">
                                             <div class="row">
                                                 <div class="col-md-6">
                                                     <strong><i class="fas fa-user"></i> Edad</strong>
                                                     <p class="text-muted"><?= $employee->date_birth . ' Años'; ?></p>
                                                 </div>
                                                 <div class="col-md-6">
                                                     <strong><i class="fas fa-user-friends"></i> Estado Civíl</strong>
                                                     <p class="text-muted" id="civil_status">
                                                         <?= isset($employee->civil_status) ? $employee->civil_status : 'Sin definir' ?>
                                                     </p>
                                                 </div>
                                             </div>
                                         </li>

                                         <li class="list-group-item">
                                             <div class="row">
                                                 <div class="col-6">
                                                     <strong><i class="fas fa-trophy"></i> No. de empleado</strong>
                                                     <p class="text-muted" id="employee_number">
                                                         <?= isset($employee->employee_number) ? $employee->employee_number : 'Sin definir' ?>
                                                     </p>

                                                 </div>
                                                 <div class="col-6">

                                                     <strong><i class="fas fa-trophy"></i> Antiguedad</strong>

                                                     <p class="text-muted"><?= $employee->antiquity . ' Años'; ?></p>

                                                 </div>
                                             </div>
                                         </li>
                                     </ul>
                                 </div>

                             </div>
                         </div>

                         <div class="col-md-9">
                             <div class="card card-success">
                                 <div class="card-body">
                                     <div class="callout callout-info">
                                         <h5>Evaluación completada</h5>
                                         <p>Muchas gracias por haber realizado la evaluación de
                                             <?= $employee->first_name . " " . $employee->surname ?></p>
                                     </div>
                                 </div>

                                 <div id="accordion">

                                     <?php foreach ($evaluationCategory as $evaluacionCat) : ?>
                                     <div class="card">
                                         <div class="card-header">
                                             <h4 class="card-title w-100">
                                                 <div class="row">
                                                     <div class="col-md-11">
                                                         <a class="d-block w-100 collapsed" data-toggle="collapse"
                                                             href="#collapse_<?= $evaluacionCat['id'] ?>"
                                                             aria-expanded="true">

                                                             <?php
                                                                    if (isset($calificacion['category_value' . $evaluacionCat['id']])) {
                                                                        $total_score = $calificacion['category_value' . $evaluacionCat['id']];
                                                                    } else {
                                                                        $total_score = number_format(100 / count($evaluationCategory));
                                                                    }

                                                                    if ($evaluation_employee->score != '') {
                                                                        $score_category = " " . $calificacion[$evaluacionCat['id']] . "%   de ";
                                                                    } else {
                                                                        $score_category = '';
                                                                    }

                                                                    ?>
                                                             <?= $evaluacionCat['category'] . " " . $score_category . $total_score . '%' ?>


                                                         </a>
                                                     </div>
                                                 </div>
                                             </h4>
                                         </div>

                                         <div id="collapse_<?= $evaluacionCat['id'] ?>" class="collapse show"
                                             data-parent="#accordion">
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
                                                                     <h5 class="card-title"
                                                                         id="criterion_name_<?= $criterionCategory['id'] ?>">
                                                                         <?= isset($criterionCategory['criterion']) ? $criterionCategory['criterion'] : 'Criterio' ?>
                                                                     </h5>
                                                                 </div>

                                                                 <div class="card-body" style="display: block;"
                                                                     id="card_body_criterion_<?= $criterionCategory['id'] ?>">

                                                                     <div class="row">
                                                                         <div class="col-11">
                                                                             <table class="table table-hover mt-3">
                                                                                 <!-- id de categoria -->
                                                                                 <thead
                                                                                     id="thead_category_<?= $criterionCategory['id'] ?>">
                                                                                     <tr>

                                                                                         <th>
                                                                                             <!-- En la consulta de categoria sale este dato Si tiene categoria creada se ve sino se genera la palabra categoria -->
                                                                                             <?= isset($criterionCategory['criterion']) ? $criterionCategory['criterion'] : 'Criterio' ?>
                                                                                             <!-- id de categoria -->

                                                                                         </th>

                                                                                         <?php $criterionScoreColums = Utils::getCriterionScoreByIdCriterion($criterionCategory['id']); ?>
                                                                                         <?php
                                                                                                    foreach ($criterionScoreColums as $criterionscoreCol) : ?>
                                                                                         <th class="text-center">
                                                                                             <?= $criterionscoreCol['name']  ?>
                                                                                             <!-- id de criterion score -->
                                                                                         </th>
                                                                                         <?php endforeach; ?>
                                                                                     </tr>


                                                                                 </thead>
                                                                                 <!--  id de categoria -->
                                                                                 <tbody
                                                                                     id="tbody_category_<?= $criterionCategory['id'] ?>">

                                                                                     <?php $questionsRows = Utils::getQuestionsCriterionByIdCriterion($criterionCategory['id']);
                                                                                                foreach ($questionsRows as $questRow) : ?>

                                                                                     <tr>
                                                                                         <th>
                                                                                             <?= $questRow['question'] ?>
                                                                                             <?php if ($questRow['definition'] != '' || $questRow['definition'] != null) : ?>
                                                                                             <small
                                                                                                 class="badge badge-dark floa"
                                                                                                 data-toggle="tooltip"
                                                                                                 data-placement="top"
                                                                                                 title="<?= $questRow['definition'] ?>">
                                                                                                 <i
                                                                                                     class="fas fa-question"></i>
                                                                                             </small>
                                                                                             <?php endif; ?>
                                                                                         </th>
                                                                                         <?php $answer = $answers[array_search($questRow['id'], array_column($answers, 'id_question'))][2] ?>
                                                                                         <?php for ($i = 0; $i < count($criterionScoreColums); $i++) : ?>
                                                                                         <td
                                                                                             class="align-middle text-center">
                                                                                             <?= $criterionScoreColums[$i]['value'] == $answer ? "<i class='fas fa-circle text-info text-lg'></i>" : '' ?>
                                                                                         </td>
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
                                                     <!-- // ===[gabo 11 mayo calificaciones] ===-->
                                                     <!-- <?php


                                                                    if (isset($calificacion['category_value' . $evaluacionCat['id']])) {
                                                                        $calificaciones[$evaluacionCat['category']] = $calificacion[$evaluacionCat['id']] . ":" . $calificacion['category_value' . $evaluacionCat['id']];
                                                                    } else {
                                                                        $calificaciones[$evaluacionCat['category']] = $calificacion[$evaluacionCat['id']];
                                                                    }


                                                                    ?>
                                                            <!- ===[gabo 11 mayo calificaciones fin ]=== -->
                                                     <?php endforeach; ?>
                                                 </div><!-- div_category -->

                                             </div>
                                         </div>


                                     </div>
                                     <?php endforeach; ?>

                                 </div>

                                 <!-- 
                                                                                Como cualquier otro vicio, la obtención del control absoluto se convertirá en un apego difícil de eliminar. 
                                                                                uando algún hecho escape a la fiscalización y predicción del sujeto, sobrevendrán el pánico y los intentos 
                                                                                nmediatos de recuperar la sensación de control, generalmente a través de logros personales. La pérdida del control será percibida como una amenaza,
                                                                                y el sistema activará todos los recursos necesarios para defenderse como si se tratara de un peligro real. De esta manera, el sistema fisiológico 
                                                                                estará siempre listo para la lucha. Bajo esta presión no hay cuerpo que aguante.“
                                                                            -->
                                 <div class="card bg-transparent">
                                     <div class="card-body">
                                         <?php foreach ($open_questions_answered as $op) : ?>
                                         <b><?= $op['question'] ?></b>
                                         <p><?= $op['answer'] ?></p>
                                         <?php endforeach ?>
                                         <br>
                                         <?php foreach ($open_questions_feedback as $op) : ?>
                                         <b><?= $op['question'] ?></b>
                                         <p><?= $op['answer'] ?></p>
                                         <?php endforeach ?>
                                         <form id="form_open_questions">
                                             <?php foreach ($openQuestions as $openquestion) : ?>
                                             <div class="form-group">
                                                 <label for="knowledge"
                                                     class="col-form-label"><?= $openquestion['question'] ?></label>
                                                 <textarea class="form-control"
                                                     name="question<?= $openquestion['id']  ?>" maxlength="200" rows="4"
                                                     required></textarea>
                                             </div>
                                             <?php endforeach; ?>



                                             <!-- ==[gabo 11 mayo calificaciones]== -->
                                             <?php if ($evaluation_employee->score != '') : ?>
                                             <div class="card">
                                                 <div class="card-header border-transparent bg-success">
                                                     <h3 class="card-title">Resumen</h3>
                                                 </div>
                                                 <div class="card-body p-0">
                                                     <div class="table-responsive">
                                                         <table class="table m-0">
                                                             <thead>
                                                                 <tr>
                                                                     <th class="text-center">Categoria </th>
                                                                     <th class="text-center">Calificación Obtenida</th>
                                                                     <th class="text-center">Calificación Esperada</th>

                                                                 </tr>
                                                             </thead>
                                                             <tbody>
                                                                 <?php
                                                                        $total = 0;
                                                                        foreach ($calificaciones  as $categoria => $cal) :

                                                                            $cal = explode(":", $cal);

                                                                        ?>
                                                                 <tr>
                                                                     <td class="text-center"><a><?= $categoria  ?></a>
                                                                     </td>
                                                                     <?php if (($cal[0] * 100 / (number_format(100 / count($evaluationCategory)))) >= 70) : ?>
                                                                     <td class="text-center"><span> <?= $cal[0] . "%" ?>
                                                                         </span></td>
                                                                     <?php else : ?>
                                                                     <td class="text-center"><span> <?= $cal[0] . "%" ?>
                                                                         </span></td>
                                                                     <?php endif; ?>
                                                                     <td class="text-center">

                                                                         <?php
                                                                                    if (isset($cal[1])) {
                                                                                        $califican_esperada = $cal[1];
                                                                                    } else {
                                                                                        $califican_esperada = number_format(100 / count($evaluationCategory));
                                                                                    }
                                                                                    ?>

                                                                         <?= $califican_esperada . "%" ?>
                                                                     </td>

                                                                 </tr>
                                                                 <?php
                                                                            $total += $cal[0];
                                                                        endforeach;    ?>
                                                                 <tr>
                                                                     <td class="text-center"><b>Total </b></td>
                                                                     <?php
                                                                            if ($total >= 99) :   $total = 100;
                                                                            endif;

                                                                            if ($total >= 70) : ?>
                                                                     <td class="text-center"><b><span
                                                                                 class="badge badge-success">
                                                                                 <?= $total . "%" ?> </span></b></td>
                                                                     <?php else : ?>
                                                                     <td class="text-center"><b><span
                                                                                 class="badge badge-warning">
                                                                                 <?= $total . "%" ?> </span></b></td>
                                                                     <?php endif; ?>
                                                                     <td class="text-center">100%</td>

                                                                 </tr>



                                                             </tbody>
                                                         </table>
                                                     </div>

                                                 </div>
                                             </div>
                                             <?php endif; ?>
                                             <!-- ==[gabo 11 mayo calificaciones fin ]== -->



                                             <?php if ($evaluation_employee->status == 2) : ?>
                                             <div class="form-group">
                                                 <label class="col-form-label">Correo de envio</label>
                                                 <input type="email" class="form-control" name="email_input"
                                                     id="email_input" maxlength="100" hidden>
                                                 <select class="form-control" name="email_boss" id="email_employee"
                                                     required>
                                                     <option selected disabled value="">Selecciona correo correo
                                                     </option>
                                                     <option value="">Escribir email</option>
                                                     <option value="<?= Encryption::encode($email_Employee->email)  ?>"
                                                         <?= isset($email_Employee->email) && $email_Employee->email != '' ? '' : 'hidden' ?>>
                                                         <?= $email_Employee->email  ?></option>
                                                     <option
                                                         value="<?= Encryption::encode($email_Employee->institutional_email)  ?>"
                                                         <?= isset($email_Employee->institutional_email) && $email_Employee->institutional_email != '' ? '' : 'hidden' ?>>
                                                         <?= $email_Employee->institutional_email  ?></option>
                                                 </select>
                                             </div>
                                             <input type="hidden" name="id_evaluation_employee"
                                                 value="<?= Encryption::encode($id) ?>">
                                             <input type="submit" name="submit" class="btn btn-info float-right"
                                                 value="Retroalimentar">
                                             <?php endif ?>
                                         </form>
                                     </div>
                                 </div>
                             </div>
                         </div><!-- /.container-fluid -->
             </section>

         </div>

     </div>
 </div>


 <script src="<?= base_url ?>app/RH/openquestionsemployee.js?v=<?= rand() ?>"></script>

 <script type="text/javascript">
document.addEventListener('DOMContentLoaded', e => {
    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    })

    document.querySelector('#form_open_questions').addEventListener('submit', e => {
        e.preventDefault();
        let openquestionsemployee = new OpenquestionsEmployee();
        openquestionsemployee.save2();
    });

    document.querySelector('#email_employee').addEventListener('change', e => {
        console.log(document.querySelector('#email_employee').value == '');
        if (document.querySelector('#email_employee').value == '') {
            document.querySelector('#email_input').required = true
            document.querySelector('#email_input').hidden = false
            document.querySelector('#email_input').focus()
            document.querySelector('#email_employee').required = false
        } else {

            document.querySelector('#email_input').value = ''
            document.querySelector('#email_input').required = false
            document.querySelector('#email_input').hidden = true
            document.querySelector('#email_employee').required = true
        }
    })


})
 </script>