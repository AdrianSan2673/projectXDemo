<div class="content-wrapper">
    <div class="container">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <div class="alert alert-success">
                            <h3 class="text-bold"><?= $evaluation->name ?></h3>
                        </div>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content-header">
            <div class="row">
                <div class="col-sm-2 ml-auto">
                    <button class="btn btn-orange float-right" id="btn_new_category">Agregar Categoría</button>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="card bg-transparent">
                <div class="card-body">

                    <div id="accordion">

                        <?php foreach ($evaluationCategory as $evaluacionCat) : ?>
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title w-100">
                                        <div class="row">
                                            <div class="col-md-11">
                                                <a class="d-block w-100 collapsed" data-toggle="collapse" href="#collapse_<?= $evaluacionCat['id'] ?>" aria-expanded="false">
                                                    <!-- nombre de cateogria  -->
                                                    <?= $evaluacionCat['category'] ?>
                                                </a>
                                            </div>

                                            <div class="col-md-1 float-right">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <!-- id de categoria -->
                                                        <button class="btn btn-info btn_update_category" value="<?= Encryption::encode($evaluacionCat['id']) ?>"><i class="fas fa-edit"></i></button>
                                                    </div>

                                                    <div class="col-6">
                                                        <!-- id de categoria -->
                                                        <button class="btn btn-danger text-bold btn_delete_category" value="<?= Encryption::encode($evaluacionCat['id']) ?>">X</button>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </h4>
                                </div>

                                <!-- id de categoria  -->
                                <div id="collapse_<?= $evaluacionCat['id'] ?>" class="collapse" data-parent="#accordion">
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
                                                                <h5 class="card-title" id="criterion_name_<?= $criterionCategory['id'] ?>">
                                                                    <?= isset($criterionCategory['criterion']) ? $criterionCategory['criterion'] : 'Criterio' ?>
                                                                </h5>
                                                                <div class="card-tools">
                                                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                                        <i class="fas fa-minus"></i>
                                                                    </button>

                                                                    <button type="button" class="btn btn-tool btn_delete_criterion" value="<?= Encryption::encode($criterionCategory['id'])  ?>">
                                                                        <i class="fas fa-times fa-times_delete_criterion "></i>
                                                                    </button>

                                                                </div>
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
                                                                                        <button class="btn btn-warning rounded-circle float-right btn_new_category_criterion" value="<?= Encryption::encode($criterionCategory['id']); ?>" name="<?= Encryption::encode($evaluacionCat['id']); ?>"><i class="fas fa-edit"></i></button>
                                                                                    </th>

                                                                                    <?php $criterionScoreColums = Utils::getCriterionScoreByIdCriterion($criterionCategory['id']); ?>
                                                                                    <?php
                                                                                    foreach ($criterionScoreColums as $criterionscoreCol) : ?>
                                                                                        <th>
                                                                                            <?= $criterionscoreCol['name']  ?>
                                                                                            <!-- id de criterion score -->
                                                                                            <div class="row float-right">
                                                                                                <div class="col-6">
                                                                                                    <button class="btn btn-info btn_update_criterion_score" value="<?= Encryption::encode($criterionscoreCol['id']) ?>"><i class="fas fa-edit"></i></button>
                                                                                                </div>

                                                                                                <div class="col-6">
                                                                                                    <!-- id de criterion score   -->
                                                                                                    <button class="btn btn-danger text-bold btn_delete_criterion_score" value="<?= Encryption::encode($criterionscoreCol['id']) ?>">X</button>
                                                                                                </div>
                                                                                            </div>
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

                                                                                            <div class="row float-right">
                                                                                                <div class="col-6">
                                                                                                    <!-- id de de la pregunta  -->
                                                                                                    <button class="btn btn-info   btn_update_question" value="<?= Encryption::encode($questRow['id']) ?>"><i class="fas fa-edit"></i></button>
                                                                                                </div>
                                                                                                <div class="col-6">
                                                                                                    <!-- id de de la pregunta  -->
                                                                                                    <button class=" btn btn-danger text-bold  btn_delete_question" value="<?= Encryption::encode($questRow['id']) ?>">X</button>
                                                                                                </div>
                                                                                            </div>
                                                                                        </th>

                                                                                        <?php for ($i = 0; $i < count($criterionScoreColums); $i++) : ?>
                                                                                            <td></td>
                                                                                        <?php endfor; ?>

                                                                                    </tr>
                                                                                <?php endforeach; ?>
                                                                            </tbody>

                                                                        </table>
                                                                    </div>

                                                                    <div class="col-1 text-center m-auto">
                                                                        <button class="btn btn-warning rounded-circle btn_new_criterionScore" value="<?= Encryption::encode($criterionCategory['id']) ?>"><i class="fas fa-plus"></i></button>
                                                                    </div>

                                                                    <div class="col-12 text-center">
                                                                        <button class="btn btn-success rounded-circle btn_new_question" value="<?= Encryption::encode($criterionCategory['id']) ?>"><i class="fas fa-plus"></i></button>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                            <?php endforeach; ?>
                                        </div><!-- div_category -->

                                        <div class="row">
                                            <div class="col-12">
                                                <button class="btn btn-orange creat_new_criterion" value="<?= Encryption::encode($evaluacionCat['id'])  ?>"> Crear nuevo
                                                    criterio</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>


                            </div>
                        <?php endforeach; ?>





                    </div>

                </div>
            </div>



            <!--===[ gabo 9 junio excel evaluaciones ]-->




            <div id="event_opent_questions">
                <div class="card bg-transparent">
                    <div class="card-body">

                        <div class="card-header">
                            <h5 class="card-title"></h5>
                            <div class="float-right">
                                <button class="btn btn-orange " id="btn_new_operquestion">Agregar pregunta
                                    abierta</button>
                            </div>
                        </div>

                        <div id="all_open_questions">

                            <?php foreach ($openQuestionsAll as $openquestion) : ?>

                                <div class="row pt-3">
                                    <div class="col-md-11">
                                        <label for="knowledge" class="col-form-label"><?= $openquestion['question'] ?></label>
                                    </div>

                                    <div class="col-md-1 float-right">
                                        <div class="row">
                                            <div class="col-6">
                                                <button class="btn btn-info btn_new_openquestion" value="<?= Encryption::encode($openquestion['id']) ?>"><i class="fas fa-edit"></i></button>
                                            </div>

                                            <div class="col-6">
                                                <button class="btn btn-danger text-bold btn_delete_openquestion" value="<?= Encryption::encode($openquestion['id']) ?>">X</button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 pt-3">
                                        <textarea class="form-control" maxlength="400" rows="3" disabled></textarea>
                                    </div>
                                </div>

                            <?php endforeach; ?>

                        </div>

                    </div>
                </div>

                <div class="card bg-transparent" <?= $evaluation->type != 0 ? '' : 'hidden' ?>>
                    <div class="card-body">

                        <div class="card-header">
                            <h5 class="card-title"></h5>
                            <div class="float-right">
                                <button class="btn btn-orange " id="btn_new_operquestion_feddback">Agregar pregunta de
                                    retroalimentacion</button>
                            </div>
                        </div>

                        <div id="all_open_questions_feedback">
                            <?php
                            $i = 0;
                            foreach ($openQuestionsFeedback as $openquestionfeedback) : ?>

                                <div class="row pt-3">
                                    <div class="col-md-11">
                                        <label for="knowledge" class="col-form-label"><?= $openquestionfeedback['question'] ?></label>
                                    </div>

                                    <div class="col-md-1 float-right">
                                        <div class="row">
                                            <div class="col-6">
                                                <button class="btn btn-info btn_new_openquestion" value="<?= Encryption::encode($openquestionfeedback['id']) ?>"><i class="fas fa-edit"></i></button>
                                            </div>
                                            <?php if ($i != 0) : ?>
                                                <div class="col-6">
                                                    <button class="btn btn-danger text-bold btn_delete_openquestion" value="<?= Encryption::encode($openquestionfeedback['id']) ?>">X</button>
                                                </div>
                                            <?php endif; ?>

                                        </div>
                                    </div>

                                    <div class="col-12 pt-3">
                                        <textarea class="form-control" maxlength="400" rows="3" disabled></textarea>
                                    </div>
                                </div>

                            <?php $i++;
                            endforeach; ?>

                        </div>

                    </div>
                </div>
            </div>





            <!--===[ gabo 9 junio excel evaluaciones fin ]-->
        </section>


    </div>
</div>

<script src="<?= base_url ?>app/RH/evaluationcategory.js?v=<?= rand() ?>"></script>
<script src="<?= base_url ?>app/RH/categorycriterion.js?v=<?= rand() ?>"></script>
<script src="<?= base_url ?>app/RH/questions.js?v=<?= rand() ?>"></script>
<script src="<?= base_url ?>app/RH/criterionscore.js?v=<?= rand() ?>"></script>
<script src="<?= base_url ?>app/RH/openquestion.js?v=<?= rand() ?>"></script>

<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', e => {

        //Esto es de boostrap para que se vea la definicion de las preguntas 
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        })

        document.querySelector('#btn_new_category').addEventListener('click', e => {
            e.preventDefault();
            document.querySelector("#modal_category form").reset()
            document.querySelectorAll('#modal_category input')[0].value = 1

            //gabo 8 nov
            document.querySelector("#div-porcentaje").hidden = true;

            $('#modal_category').modal({
                backdrop: 'static',
                keyboard: false
            });
        })



        let evaluationCategory = new EvaluationCategory();
        document.querySelector('#modal_category').addEventListener('submit', e => {
            e.preventDefault();
            evaluationCategory.save();
        });

        document.querySelector('#modal-categoryCriterion').addEventListener('submit', e => {
            e.preventDefault();
            let categoryCriterion = new CategoryCriterion();
            categoryCriterion.save();
        });

        document.querySelector('#modal_question').addEventListener('submit', e => {
            e.preventDefault();
            let questions = new Questions();
            questions.save();
        });

        document.querySelector('#modal-criterionScore').addEventListener('submit', e => {
            e.preventDefault();
            let criterionScore = new CriterionScore();
            criterionScore.save();
        });


        //Evento de todo el accordion
        document.querySelector('#accordion').addEventListener('click', function(e) {

            //===[gabo 9 junio  excel evaluaciones]===
            if (e.target.classList.contains('btn_update_category') || e.target.offsetParent.classList
                .contains('btn_update_category')) {
                //===[gabo 9 junio  excel evaluaciones fin]===


                if (e.target.offsetParent.classList.contains('btn-info'))
                    evaluationCategory.getEvaluationCategory(e.target.offsetParent.value)
                else
                    evaluationCategory.getEvaluationCategory(e.target.value)

                //gabo 8 nov
                document.querySelector("#div-porcentaje").hidden = false;

                $('#modal_category').modal({
                    backdrop: 'static',
                    keyboard: false
                });
            }

            if (e.target.classList.contains('btn_delete_category')) {
                Swal.fire({
                    title: '¿Quieres eliminar esta categoria?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    cancelButtonText: 'Cancelar',
                    confirmButtonText: 'Eliminar'
                }).then((result) => {
                    if (result.value == true) {
                        evaluationCategory.delete(e.target.value)
                    }
                })
            }

            //actualizar de criterios
            if (e.target.classList.contains('btn_new_category_criterion') || e.target.offsetParent.classList
                .contains('btn_new_category_criterion')) {

                let id_criterion;
                if (e.target.offsetParent.classList.contains('btn_new_category_criterion'))
                    value = e.target.parentElement.value
                else
                    value = e.target.value

                document.querySelector('#modal-categoryCriterion [name="id_criterion"]').value = value
                document.querySelector('#modal-categoryCriterion [name="flag"]').value = 2

                let categoryCriterion = new CategoryCriterion();
                categoryCriterion.getCategoryCriterion(value);

                $('#modal-categoryCriterion').modal({
                    backdrop: 'static',
                    keyboard: false
                });
            }

            //Creacion de criterios
            if (e.target.classList.contains('creat_new_criterion') || e.target.offsetParent.classList
                .contains('creat_new_criterion')) {
                let id_category;
                if (e.target.offsetParent.classList.contains('creat_new_criterion'))
                    id_category = e.target.parentElement.value
                else
                    id_category = e.target.value

                document.querySelector('#modal-categoryCriterion [name="id_category"]').value = id_category
                document.querySelector('#modal-categoryCriterion [name="id_criterion"]').value = ''
                document.querySelector('#modal-categoryCriterion [name="flag"]').value = 1

                $('#modal-categoryCriterion').modal({
                    backdrop: 'static',
                    keyboard: false
                });
            }

            //Eliminar  criterios 
            if (e.target.classList.contains('btn_delete_criterion') || e.target.parentNode.classList
                .contains('btn_delete_criterion')) {

                let id_criterion;

                if (e.target.parentNode.classList.contains('btn_delete_criterion'))
                    id_criterion = e.target.parentElement.value
                else
                    id_criterion = e.target.value



                Swal.fire({
                    title: '¿Quieres eliminar este criterio?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    cancelButtonText: 'Cancelar',
                    confirmButtonText: 'Eliminar'
                }).then((result) => {
                    if (result.value == true) {
                        let categoryCriterion = new CategoryCriterion();
                        categoryCriterion.delete(id_criterion);
                    }
                })
            }


            //Creacion de preguntas
            if (e.target.classList.contains('btn_new_question') || e.target.offsetParent.classList.contains(
                    'btn_new_question')) {
                let value;
                if (e.target.offsetParent.classList.contains('btn_new_question'))
                    value = e.target.parentElement.value
                else
                    value = e.target.value

                document.querySelector('#modal_question [name="id_criterion"]').value = value
                document.querySelector('#modal_question [name="flag"]').value = '1'
                //No se necesita id porque es cuando se va a crear 
                document.querySelector("#modal_question form").reset()

                $('#modal_question').modal({
                    backdrop: 'static',
                    keyboard: false
                });
            }

            //Actualizar pregunta 
            if (e.target.classList.contains('btn_update_question') || e.target.offsetParent.classList
                .contains('btn_update_question')) {
                let id_question;

                if (e.target.offsetParent.classList.contains('btn_update_question'))
                    id_question = e.target.parentElement.value
                else
                    id_question = e.target.value

                document.querySelector('#modal_question [name="flag"]').value = '2'
                document.querySelector('#modal_question [name="id_criterion"]').value = 0
                document.querySelector('#modal_question [name="id"]').value = id_question

                let questions = new Questions();
                questions.getQuestion(id_question);

                $('#modal_question').modal({
                    backdrop: 'static',
                    keyboard: false
                });
            }

            //Eliminar  pregunta 
            if (e.target.classList.contains('btn_delete_question') || e.target.offsetParent.classList
                .contains('btn_delete_question')) {
                let id_question;

                if (e.target.offsetParent.classList.contains('btn_delete_question'))
                    id_question = e.target.parentElement.value
                else
                    id_question = e.target.value

                Swal.fire({
                    title: '¿Quieres eliminar esta pregunta?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    cancelButtonText: 'Cancelar',
                    confirmButtonText: 'Eliminar'
                }).then((result) => {
                    if (result.value == true) {
                        let questions = new Questions();
                        questions.delete(id_question);
                    }
                })
            }


            //Creacion de ponderacion
            if (e.target.classList.contains('btn_new_criterionScore') || e.target.offsetParent.classList
                .contains('btn_new_criterionScore')) {
                let value;

                if (e.target.offsetParent.classList.contains('btn_new_criterionScore'))
                    value = e.target.parentElement.value
                else
                    value = e.target.value

                document.querySelector('#modal-criterionScore [name="id_criterion"]').value = value
                document.querySelector('#modal-criterionScore [name="flag"]').value = '1'
                //No se necesita id porque es cuando se va a crear 
                document.querySelector("#modal-criterionScore form").reset()

                $('#modal-criterionScore').modal({
                    backdrop: 'static',
                    keyboard: false
                });
            }

            //Actualizar ponderacion 
            if (e.target.classList.contains('btn_update_criterion_score') || e.target.offsetParent.classList
                .contains('btn_update_criterion_score')) {
                let id_criterion_score;

                if (e.target.offsetParent.classList.contains('btn_update_criterion_score'))
                    id_criterion_score = e.target.parentElement.value
                else
                    id_criterion_score = e.target.value

                document.querySelector('#modal-criterionScore [name="flag"]').value = '2'
                document.querySelector('#modal-criterionScore [name="id_criterion"]').value = 0
                document.querySelector('#modal-criterionScore [name="id"]').value = id_criterion_score

                let criterionScore = new CriterionScore();
                criterionScore.getCriterionScore(id_criterion_score);

                $('#modal-criterionScore').modal({
                    backdrop: 'static',
                    keyboard: false
                });
            }


            //Eliminar  ponderacion 
            if (e.target.classList.contains('btn_delete_criterion_score') || e.target.offsetParent.classList
                .contains('btn_delete_criterion_score')) {
                let id_question;

                if (e.target.offsetParent.classList.contains('btn_delete_criterion_score'))
                    id_question = e.target.parentElement.value
                else
                    id_question = e.target.value

                Swal.fire({
                    title: '¿Quieres eliminar esta columna?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    cancelButtonText: 'Cancelar',
                    confirmButtonText: 'Eliminar'
                }).then((result) => {
                    if (result.value == true) {
                        let criterionScore = new CriterionScore();
                        criterionScore.delete(id_question);
                    }
                })
            }

        })



        // === [gabo 8 junio excel evaluaciones]

        document.querySelector('#btn_new_operquestion').addEventListener('click', e => {
            e.preventDefault();
            document.querySelector("#modal_question_open form").reset()
            document.querySelector('#modal_question_open [name="flag"]').value = 1
            document.querySelector('#modal_question_open [name="status"]').value = 1
            $('#modal_question_open').modal({
                backdrop: 'static',
                keyboard: false
            });
        })

        document.querySelector('#btn_new_operquestion_feddback').addEventListener('click', e => {
            e.preventDefault();
            document.querySelector("#modal_question_open form").reset()
            document.querySelector('#modal_question_open [name="flag"]').value = 1
            document.querySelector('#modal_question_open [name="status"]').value = 2


            $('#modal_question_open').modal({
                backdrop: 'static',
                keyboard: false
            });
        })

        document.querySelector('#modal_question_open').addEventListener('submit', e => {
            e.preventDefault();

            document.querySelector('#modal_question [name="flag"]').value = '1'
            document.querySelector('#modal_question [name="id"]').value = ''

            let openquestion = new OpenQuestion();
            openquestion.save();
        });



        document.querySelector('#event_opent_questions').addEventListener('click', function(e) {

            //Actualizar pregunta abierta
            if (e.target.classList.contains('btn_new_openquestion') || e.target.offsetParent.classList
                .contains('btn_new_openquestion')) {
                let id_question;

                if (e.target.offsetParent.classList.contains('btn_new_openquestion'))
                    id_question = e.target.parentElement.value
                else
                    id_question = e.target.value

                document.querySelector('#modal_question_open [name="flag"]').value = '2'
                document.querySelector('#modal_question_open [name="id"]').value = id_question

                let openquestion = new OpenQuestion();
                openquestion.getOpenQuestion(id_question);

                $('#modal_question_open').modal({
                    backdrop: 'static',
                    keyboard: false
                });
            }

            //Eliminar  pregunta abierta
            if (e.target.classList.contains('btn_delete_openquestion') || e.target.offsetParent.classList
                .contains('btn_delete_openquestion')) {
                let id_question;

                if (e.target.offsetParent.classList.contains('btn_delete_openquestion'))
                    id_question = e.target.parentElement.value
                else
                    id_question = e.target.value

                Swal.fire({
                    title: '¿Quieres eliminar esta pregunta?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    cancelButtonText: 'Cancelar',
                    confirmButtonText: 'Eliminar'
                }).then((result) => {
                    if (result.value == true) {
                        let openquestion = new OpenQuestion();
                        openquestion.delete(id_question);
                    }
                })
            }


        })


        // === [gabo 8 junio excel evaluaciones fin]



    })
</script>