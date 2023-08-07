<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <div class="alert alert-success">
            <h4 id="titulo"><?= $titulo ?> </h4>
          </div>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <section class="content-header">
    <div class="row">

    </div>
  </section>

  <section class="content">
    <div class="card bg-transparent">
      <div class="card-header">
      </div>

      <div class="card-body">
        <table id="tb_excel_evaluations" style="width:100%" class="table table-responsive-lg  table-striped table-responsive ">

          <thead>
            <tr>
              <th class="text-center">Nombre del colaborador</th>
              <th class="text-center">Puesto</th>
              <th class="text-center">Jefe inmediato</th>

              <?php foreach ($categories as $category) :  ?>
                <th class="text-center"> <?= $category['category'] ?></th>
                <?php
                for ($j = 0; $j < $columnas_por_categoria[$i] - 1; $j++) :
                ?>
                  <th class="text-center">-</th>
                <?php endfor; ?>
              <?php
                $i++;
              endforeach;   ?>

              <th class="text-center"> Preguntas </th>

              <?php for ($i = 0; $i < $total_openQuestions - 1; $i++) : ?>
                <th class="text-center">-</th>
              <?php endfor;   ?>

              <th class="text-center"> Retroalimentación </th>

              <?php for ($i = 0; $i < $total_feedback - 1; $i++) : ?>
                <th class="text-center">-</th>
              <?php endfor;  ?>

              <th class="text-center">Calificación</th>

            </tr>

          </thead>

          <tbody>

            <tr>
              <td class="text-center">-</td>
              <td class="text-center">-</th>
              <td class="text-center">-</td>

              <?php foreach ($questions as $question) :     ?>
                <td class="text-center"> <b><?= $question['question'] ?> </b></td>
              <?php endforeach;   ?>

              <?php foreach ($openQuestions as $openquestion) :
              ?>
                <td class="text-center"><b> <?= $openquestion['question'] ?></b></td>
              <?php endforeach;   ?>

              <?php foreach ($feedback as $feed) :
              ?>
                <td class="text-center"><b> <?= $feed['question'] ?> </b></td>
              <?php endforeach;   ?>
              <td class="text-center">-</td>
            </tr>
            <?php foreach ($arryaEvaluationEmployee as $evalua) : ?>
              <tr>
                <td class="text-center"><?= $evalua['employeeName']  ?></td>
                <td class="text-center"><?= $evalua['title']  ?></td>
                <td class="text-center"><?= $evalua['BossName']  ?></td>

                <?php
                $evaluationEmployeeObj->setId($evalua['id']);
                $valore = $evaluationEmployeeObj->getValuequestionByIdEmployee();
                $total_answers_employee = count($valore);
                ?>


                <?php for ($i = 0; $i < $total_answers_employee; $i++) : ?>
                  <td class="text-center"><?= $valore[$i]['value_question_employee'] ?></td>
                  <?php $id = $valore[$i]['id_evaluation_employe']; ?>
                <?php endfor; ?>

                <?php for ($i = 0; $i < ($total_questions - $total_answers_employee); $i++) : ?>
                  <td class="text-center">-</td>
                <?php endfor; ?>


                <?php
                $EvaluationOpenQuestionsEmployeeObj->setId_evaluation_employee($evalua['id']);
                $EvaluationOpenQuestionsEmployee = $EvaluationOpenQuestionsEmployeeObj->getAllByIdEvvalautionEmployee();
                $total_questions_employee = count($EvaluationOpenQuestionsEmployee);
                ?>


                <?php foreach ($EvaluationOpenQuestionsEmployee as $evaquestion) : ?>
                  <td class="text-center"> <?= $evaquestion['answer'] ?></td>
                <?php endforeach; ?>

                <?php for ($i = 0; $i < ($total_open_questionsfeedback - $total_questions_employee); $i++) : ?>
                  <td class="text-center">-</td>
                <?php endfor; ?>

                <?php
                $parts = explode("/", $evalua['score']);
                $total = 0;
                if (count($parts) == 1) {
                  $total = "-";
                } else {

                  foreach ($parts as $part) {
                    $partes = explode(":", $part);

                    $total += $partes[1];
                  }
                  $total = ceil($total);
                }

                ?>
                <td class="text-center"> <?= $total ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>

        </table>

      </div>
      <!-- /.card-body -->
    </div>
  </section>
</div>

<script src="<?= base_url ?>app/RH/evaluations.js?v=<?= rand() ?>"></script>

<script>
  document.addEventListener('DOMContentLoaded', e => {
    var titulo = document.getElementById("titulo").textContent;
    $("#tb_excel_evaluations").DataTable({

      dom: "Bfrtip",
      buttons: [{
          extend: "excel", // Extend the excel button
          title: titulo,

          excelStyles: [{
              template: [
                "stripes_gray",
                "rowlines_black",
                "outline_black"
              ],
            },

            {
              rowref: "smart",
              cells: "0",
              style: { // The style block
                font: { // Style the font
                  name: "Arial", // Font name
                  size: "12", // Font size
                  color: "FFFFFF", // Font Color
                  b: false, // Remove bolding from header row
                },
                fill: { // Style the cell fill (background)
                  pattern: { // Type of fill (pattern or gradient)
                    color: "1F618D", // Fill color
                  }
                },
                alignment: {
                  vertical: "center",
                  horizontal: "center",
                  wrapText: true,
                }

              },

            },
            {
              rowref: "smart",
              cells: "1",
              style: { // The style block
                font: { // Style the font
                  name: "Arial", // Font name
                  size: "11", // Font size
                  b: false, // Remove bolding from header row
                },
                alignment: {
                  vertical: "center",
                  horizontal: "center",
                  wrapText: true,
                },
                fill: { // Style the cell fill (background)
                  pattern: { // Type of fill (pattern or gradient)
                    color: "1F618D", // Fill color
                  }
                },

              },

            },
            {
              rowref: "smart",
              cells: "A:",
              style: { // The style block
                font: { // Style the font
                  size: "10", // Font size
                  b: false, // Remove bolding from header row
                },
                alignment: {
                  vertical: "center",
                  horizontal: "center",
                  wrapText: true,
                },
              },

            },
          ]
        },
        {
          extend: 'pdfHtml5',
          //text: '<i class="fas fa-file-pdf"></i>',
          //titleAttr: 'Exportar a PDF',
          className: 'btn btn-danger',
          orientation: 'landscape',
        }
      ],
    });

  });
</script>