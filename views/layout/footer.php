    <footer class="main-footer">
      <div class="container">
        <div class="row mx-auto">
          <div class="col-lg-4 col-md-4 col-sm-4 col-12 text-center mb-3">
            <?php if (isset($_SESSION['identity']) && $_SESSION['identity']->username == 'salmaperez'): ?>
               <img src="<?=base_url?>dist/img/RRHHIngenia-Website2020_LogoHeader.svg" alt="RRHH Ingenia" class="img-fluid logo">
            <?php else: ?>
              <img src="<?=base_url?>dist/img/RRHHIngenia-Website2020_LogoFooter.svg" alt="RRHH Ingenia" class="img-fluid logo">
            <?php endif ?>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-4 col-12 text-center mb-3">
            <p>&copy; <?=date('Y')?> - RRHH Ingenia</p>
            <p><a href="http://rrhh-ingenia.com/Aviso_de_Privacidad">Aviso de privacidad</a></p>
            <p>Todos los derechos reservados.</p>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-4 col-12 text-center mb-3">
            <a href="https://www.facebook.com/RRHHIngenia/" target="_blank">
              <img class="icon" src="<?=base_url?>dist/img/RRHHIngenia-Website2020_FacebookIcon.svg" alt="Facebook">
            </a>
            <a href="https://mx.linkedin.com/company/rrhh-ingenia" target="_blank">
              <img class="icon" src="<?=base_url?>dist/img/RRHHIngenia-Website2020_LinkedinIcon.svg" alt="Linkedin">
            </a>
              
          </div>
        </div>
      </div>
    </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<script src="<?=base_url?>plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- AdminLTE App -->
<script src="<?=base_url?>dist/js/adminlte.min.js?v=<?=rand()?>"></script>
<script src="<?=base_url?>plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
<script src="<?=base_url?>plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<script src="<?=base_url?>app/city.js?v=<?=rand()?>"></script>
<script src="<?=base_url?>app/subarea.js?v=<?=rand()?>"></script>
<script src="<?=base_url?>app/utils.js?v=<?=rand()?>"></script>
<script src="<?=base_url?>app/user.js?v=<?=rand()?>"></script>
<script src="<?=base_url?>app/image.js?v=<?=rand()?>"></script>
<script src="<?=base_url?>app/account.js?v=<?=rand()?>"></script>
<script>
  $(function(){
    $('.select2').select2();
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
    $('[data-mask]').inputmask()
    $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    });
    $('#dark-mode').change(function(){
      let a = new Account();
      if (this.checked) {
        $('body').addClass('dark-mode');
        $('.main-header').removeClass('navbar-light')
        $('.main-header').removeClass('navbar-white')
        $('.main-header').addClass('navbar-dark')

        a.dark_mode(1);
      }else{
        $('body').removeClass('dark-mode');
        $('.main-header').removeClass('navbar-dark')
        $('.main-header').addClass('navbar-light')
        $('.main-header').addClass('navbar-white')

        a.dark_mode(0);
      }
    });
  });
</script>
<?php if (!Utils::isCustomer() && !Utils::isCandidate() && $_GET['controller'] == 'usuario' && $_GET['action'] == 'index' && Utils::isAdmin() && $_SESSION['identity']->id == 1): ?>
  <!-- JQVMap -->
<script src="<?=base_url?>plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="<?=base_url?>plugins/jqvmap/maps/jquery.vmap.mexico.js?v=<?=rand()?>"></script>
<script type="text/javascript">
$(function () {
  $('#world-map').vectorMap({
    map              : 'mx_en',
    backgroundColor  : 'transparent',
    hoverColor: '#d8822d',
    selectedColor: '#a6c44a',
    regionStyle      : {
      initial: {
        fill            : 'rgba(255, 255, 255, 0.7)',
        'fill-opacity'  : 1,
        stroke          : 'rgba(216,0,0,.2)',
        'stroke-width'  : 1,
        'stroke-opacity': 1
      }
    },
    onRegionClick: function(element, code, region) {
      console.log(code);
    }
  })
});
</script>
<?php endif ?>
<?php if ($_GET['controller'] == 'usuario' && $_GET['action'] == 'index'): ?>
<script src="<?=base_url?>plugins/chart.js/Chart.min.js"></script>
<?php if (!Utils::isSAManager() && !Utils::isOperationsSupervisor() && !Utils::isLogisticsSupervisor() && !Utils::isAccount() && !Utils::isCustomerSA()): ?>
  <script type="text/javascript">
    // Sales graph chart
    var salesGraphChartCanvas = $('#line-chart').get(0).getContext('2d');
    //$('#revenue-chart').get(0).getContext('2d');

    let labels = new Array();
    let data = new Array();


    <?php foreach ($candidates_count as $count): ?>
      labels.push('<?=$count['dia_semana'].' '.$count['dia']?>');
      data.push(<?=$count['total']?>);
    <?php endforeach ?>

    
    var salesGraphChartData = {
      labels  : labels,
      datasets: [
        {
          label               : 'Candidatos registrados',
          fill                : false,
          borderWidth         : 4,
          //lineTension         : 0,
          spanGaps : true,
          borderColor         : '#efefef',
          pointRadius         : 5,
          pointHoverRadius    : 15,
          pointColor          : '#efefef',
          pointBackgroundColor: '#efefef',
          data                : data
        }
      ]
    }

    var salesGraphChartOptions = {
      maintainAspectRatio : false,
      responsive : true,
      legend: {
        display: false,
      },
      scales: {
        xAxes: [{
          ticks : {
            fontColor: '#efefef',
          },
          gridLines : {
            display : false,
            color: '#efefef',
            drawBorder: false,
          }
        }],
        yAxes: [{
          display: true,
          ticks : {
            stepSize: 2,
            fontColor: '#efefef',
            beginAtZero : true
          },
          gridLines : {
            display : true,
            color: '#efefef',
            drawBorder: false,
          }
        }]
      }
    }

    // This will get the first returned node in the jQuery collection.
    var salesGraphChart = new Chart(salesGraphChartCanvas, { 
        type: 'line', 
        data: salesGraphChartData, 
        options: salesGraphChartOptions
      }
    )
  </script>
<?php endif ?>
  
  <?php if (Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager()): ?>
    <script type="text/javascript">
      //-------------
      //- PIE CHART -
      //-------------
      // Get context with jQuery - using jQuery's .get() method.
      var pieChartCanvasHoy = $('#pieChartHoy').get(0).getContext('2d')
      var pieDataHoy        = 
      {
        labels: [
            'Estudio',
            'Investigación',
            'RAL',
        ],
        datasets: [
          {
            data: 
            [
              <?=!Utils::isAccount() ? Statistics::getTotalESESHoy() : Statistics::getTotalESESHoyPorEjecutivo()?>,
              <?=!Utils::isAccount() ? Statistics::getTotalInvHoy() : Statistics::getTotalInvHoyPorEjecutivo()?>,
              <?=!Utils::isAccount() ? Statistics::getTotalRALESHoy() : Statistics::getTotalRALESHoyPorEjecutivo()?>
            ],
            backgroundColor : ['#048abf', '#F28322', '#D948A6'],
          }
        ]
      };
      var pieOptions     = {
        maintainAspectRatio : false,
        responsive : true
      }
      //Create pie or douhnut chart
      // You can switch between pie and douhnut using the method below.
      var pieChartHoy = new Chart(pieChartCanvasHoy, {
        type: 'pie',
        data: pieDataHoy,
        options: pieOptions
      })

      var pieChartCanvasEnProceso = $('#pieChartEnProceso').get(0).getContext('2d')
      var pieDataEnProceso        = 
      {
        labels: [
            'Estudio',
            'Investigación',
            'RAL',
        ],
        datasets: [
          {
            data: 
            [
              <?=!Utils::isAccount() ? Statistics::getTotalESESEnProceso() : Statistics::getTotalESESEnProcesoPorEjecutivo()?>,
              <?=!Utils::isAccount() ? Statistics::getTotalInvEnProceso() : Statistics::getTotalInvEnProcesoPorEjecutivo()?>,
              <?=!Utils::isAccount() ? Statistics::getTotalRALESEnProceso() : Statistics::getTotalRALESEnProcesoPorEjecutivo()?>
            ],
            backgroundColor : ['#048abf', '#F28322', '#D948A6'],
          }
        ]
      };
      //Create pie or douhnut chart
      // You can switch between pie and douhnut using the method below.
      var pieChartEnProceso = new Chart(pieChartCanvasEnProceso, {
        type: 'pie',
        data: pieDataEnProceso,
        options: pieOptions
      })


      var pieChartCanvasSemana = $('#pieChartSemana').get(0).getContext('2d')
      var pieDataSemana        = 
      {
        labels: [
            'Estudio',
            'Investigación',
            'RAL',
        ],
        datasets: [
          {
            data: 
            [
              <?=!Utils::isAccount() ? Statistics::getTotalESESSemana() : Statistics::getTotalESESSemanaPorEjecutivo()?>,
              <?=!Utils::isAccount() ? Statistics::getTotalInvSemana() : Statistics::getTotalInvSemanaPorEjecutivo()?>,
              <?=!Utils::isAccount() ? Statistics::getTotalRALESSemana() : Statistics::getTotalRALESSemanaPorEjecutivo()?>
            ],
            backgroundColor : ['#048abf', '#F28322', '#D948A6'],
          }
        ]
      };
      //Create pie or douhnut chart
      // You can switch between pie and douhnut using the method below.
      var pieChartSemana = new Chart(pieChartCanvasSemana, {
        type: 'pie',
        data: pieDataSemana,
        options: pieOptions
      })


      var pieChartCanvasMes = $('#pieChartMes').get(0).getContext('2d')
      var pieDataMes        = 
      {
        labels: [
            'Estudio',
            'Investigación',
            'RAL',
        ],
        datasets: [
          {
            data: 
            [
              <?=!Utils::isAccount() ? Statistics::getTotalESESMes() : Statistics::getTotalESESMesPorEjecutivo()?>,
              <?=!Utils::isAccount() ? Statistics::getTotalInvMes() : Statistics::getTotalInvMesPorEjecutivo()?>,
              <?=!Utils::isAccount() ? Statistics::getTotalRALESMes() : Statistics::getTotalRALESMesPorEjecutivo()?>
            ],
            backgroundColor : ['#048abf', '#F28322', '#D948A6'],
          }
        ]
      };
      var pieOptions     = {
        maintainAspectRatio : false,
        responsive : true
      }
      //Create pie or douhnut chart
      // You can switch between pie and douhnut using the method below.
      var pieChartMes = new Chart(pieChartCanvasMes, {
        type: 'pie',
        data: pieDataMes,
        options: pieOptions
      })


      let dataa = new Array();
      <?php foreach ($serviciosxcchoy as $s): ?>
        dataa.push([<?=$s['No_RAL']?>, <?=$s['No_INV']?>, <?=$s['No_ESE']?>]);
      <?php endforeach ?>

      /*var areaChartData = {
      labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
      datasets: [
        {
          label               : 'Digital Goods',
          backgroundColor     : 'rgba(60,141,188,0.9)',
          borderColor         : 'rgba(60,141,188,0.8)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [28, 48, 40, 19, 86, 27, 90]
        },
        {
          label               : 'Electronics',
          backgroundColor     : 'rgba(210, 214, 222, 1)',
          borderColor         : 'rgba(210, 214, 222, 1)',
          pointRadius         : false,
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [65, 59, 80, 81, 56, 55, 40]
        },
      ]
    }

      console.log(data);
      var stackedBarChartCanvas = $('#stackedBarChart').get(0).getContext('2d')
      //var stackedBarChartData = $.extend(true, {}, barChartData)

      var stackedBarChartOptions = {
        responsive              : true,
        maintainAspectRatio     : false,
        scales: {
          xAxes: [{
            stacked: true,
          }],
          yAxes: [{
            stacked: true
          }]
        }
      }

      var stackedBarChart = new Chart(stackedBarChartCanvas, {
        type: 'bar',
        data: data,
        options: stackedBarChartOptions
      })*/
    </script>
  <?php endif ?>
<?php endif ?>
</body>
</html>


