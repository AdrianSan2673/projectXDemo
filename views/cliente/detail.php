<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left mb-2">
              <li class="breadcrumb-item"><a href="<?=base_url?>">Inicio</a></li>
              <li class="breadcrumb-item"><a href="<?=base_url?>cliente_SA/index">Clientes</a></li>
              <li class="breadcrumb-item active">Detallado</li>
            </ol>
          </div>
          <div class="col-sm-12">
            <div class="alert alert-success">
                <h3>Detallado anual de operaciones finalizadas por cliente (<?=$Anio?>)</h3>
            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
      <div class="row">
        <?php $anios = Utils::getAniosSA() ?>
        <?php foreach ($anios as $anio): ?>
        <div class="col">
          <a href="<?=base_url?>cliente_SA/detallado&anio=<?=$anio['Anio']?>" class="btn btn-block btn-info btn-lg <?=$_GET['anio'] == $anio['Anio'] ? 'disabled' : ''?>"><?=$anio['Anio']?></a>
        </div>  
        <?php endforeach ?>
      </div>
      <div class="content text-center mt-5">
        <a class="btn btn-app bg-success" href="<?=base_url?>reporte/detallado_anual&anio=<?=$Anio?>">
          <i class="far fa-file-excel"></i> Descargar
        </a>
      </div>
    </section>
    <!-- Main content -->
    <section class="content mt-4">
        <div class="card car-success">
            <div class="card-header">
              <h3 class="card-title">Servicios de apoyo por cliente del <?=$_GET['anio']?></h3>
              <div class="card-tools">
                <button type="button" class="btn btn-sm" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive table-bordered p-0" style="height: 800px;">
              <table id="tb_customers" class="table table-striped table-head-fixed text-nowrap">
                <thead>
                    <tr>
                      <th class="align-middle text-center static" rowspan="2">Cliente</th>
                      <th class="align-middle text-center first-col" rowspan="2">Plaza</th>
                      <th class="align-middle text-center" rowspan="2">$ RAL</th>
                      <th class="align-middle text-center" rowspan="2">$ IL</th>
                      <th class="align-middle text-center" rowspan="2">$ ESE</th>
                      <?php if ($_GET['anio'].'-01' <= date('Y-m')): ?>
                      <th class="align-middle text-center" rowspan="1" colspan="6">Enero</th>  
                      <?php endif ?>
                      <?php if ($_GET['anio'].'-02' <= date('Y-m')): ?>
                      <th class="align-middle text-center divider" rowspan="1" colspan="6">Febrero</th>  
                      <?php endif ?>
                      <?php if ($_GET['anio'].'-03' <= date('Y-m')): ?>
                      <th class="align-middle text-center" rowspan="1" colspan="6">Marzo</th>  
                      <?php endif ?>
                      <?php if ($_GET['anio'].'-04' <= date('Y-m')): ?>
                      <th class="align-middle text-center" rowspan="1" colspan="6">Abril</th>  
                      <?php endif ?>
                      <?php if ($_GET['anio'].'-05' <= date('Y-m')): ?>
                      <th class="align-middle text-center" rowspan="1" colspan="6">Mayo</th>  
                      <?php endif ?>
                      <?php if ($_GET['anio'].'-06' <= date('Y-m')): ?>
                      <th class="align-middle text-center" rowspan="1" colspan="6">Junio</th>  
                      <?php endif ?>
                      <?php if ($_GET['anio'].'-07' <= date('Y-m')): ?>
                      <th class="align-middle text-center" rowspan="1" colspan="6">Julio</th>  
                      <?php endif ?>
                      <?php if ($_GET['anio'].'-08' <= date('Y-m')): ?>
                      <th class="align-middle text-center" rowspan="1" colspan="6">Agosto</th>  
                      <?php endif ?>
                      <?php if ($_GET['anio'].'-09' <= date('Y-m')): ?>
                      <th class="align-middle text-center" rowspan="1" colspan="6">Septiembre</th>  
                      <?php endif ?>
                      <?php if ($_GET['anio'].'-10' <= date('Y-m')): ?>
                      <th class="align-middle text-center" rowspan="1" colspan="6">Octubre</th>  
                      <?php endif ?>
                      <?php if ($_GET['anio'].'-11' <= date('Y-m')): ?>
                      <th class="align-middle text-center" rowspan="1" colspan="6">Noviembre</th>  
                      <?php endif ?>
                      <?php if ($_GET['anio'].'-12' <= date('Y-m')): ?>
                      <th class="align-middle text-center" rowspan="1" colspan="6">Diciembre</th>  
                      <?php endif ?>
                      <th class="align-middle text-center" rowspan="1" colspan="6"><?=$Anio?></th>
                    </tr>
                    <tr>
                      <?php if ($_GET['anio'].'-01' <= date('Y-m')): ?>
                      <!-- Enero -->
                      <th class="align-middle text-center">RS</th>
                      <th class="align-middle text-center">RA</th>
                      <th class="align-middle text-center">RN</th>
                      <th class="align-middle text-center">IL</th>
                      <th class="align-middle text-center">ESE</th>
                      <th class="align-middle text-center">TOTAL</th>  
                      <?php endif ?>
                      <?php if ($_GET['anio'].'-02' <= date('Y-m')): ?>
                      <!-- Febrero -->
                      <th class="align-middle text-center">RS</th>
                      <th class="align-middle text-center">RA</th>
                      <th class="align-middle text-center">RN</th>
                      <th class="align-middle text-center">IL</th>
                      <th class="align-middle text-center">ESE</th>
                      <th class="align-middle text-center">TOTAL</th> 
                      <?php endif ?>
                      <?php if ($_GET['anio'].'-03' <= date('Y-m')): ?>
                       <!-- Marzo -->
                      <th class="align-middle text-center">RS</th>
                      <th class="align-middle text-center">RA</th>
                      <th class="align-middle text-center">RN</th>
                      <th class="align-middle text-center">IL</th>
                      <th class="align-middle text-center">ESE</th>
                      <th class="align-middle text-center">TOTAL</th> 
                      <?php endif ?>
                      <?php if ($_GET['anio'].'-04' <= date('Y-m')): ?>
                      <!-- Abril -->
                      <th class="align-middle text-center">RS</th>
                      <th class="align-middle text-center">RA</th>
                      <th class="align-middle text-center">RN</th>
                      <th class="align-middle text-center">IL</th>
                      <th class="align-middle text-center">ESE</th>
                      <th class="align-middle text-center">TOTAL</th> 
                      <?php endif ?>
                      <?php if ($_GET['anio'].'-05' <= date('Y-m')): ?>
                      <!-- Mayo -->
                      <th class="align-middle text-center">RS</th>
                      <th class="align-middle text-center">RA</th>
                      <th class="align-middle text-center">RN</th>
                      <th class="align-middle text-center">IL</th>
                      <th class="align-middle text-center">ESE</th>
                      <th class="align-middle text-center">TOTAL</th>  
                      <?php endif ?>
                      <?php if ($_GET['anio'].'-06' <= date('Y-m')): ?>
                      <!-- Junio -->
                      <th class="align-middle text-center">RS</th>
                      <th class="align-middle text-center">RA</th>
                      <th class="align-middle text-center">RN</th>
                      <th class="align-middle text-center">IL</th>
                      <th class="align-middle text-center">ESE</th>
                      <th class="align-middle text-center">TOTAL</th>  
                      <?php endif ?>
                      <?php if ($_GET['anio'].'-07' <= date('Y-m')): ?>
                      <!-- Julio -->
                      <th class="align-middle text-center">RS</th>
                      <th class="align-middle text-center">RA</th>
                      <th class="align-middle text-center">RN</th>
                      <th class="align-middle text-center">IL</th>
                      <th class="align-middle text-center">ESE</th>
                      <th class="align-middle text-center">TOTAL</th>  
                      <?php endif ?>
                      <?php if ($_GET['anio'].'-08' <= date('Y-m')): ?>
                      <!-- Agosto -->
                      <th class="align-middle text-center">RS</th>
                      <th class="align-middle text-center">RA</th>
                      <th class="align-middle text-center">RN</th>
                      <th class="align-middle text-center">IL</th>
                      <th class="align-middle text-center">ESE</th>
                      <th class="align-middle text-center">TOTAL</th>  
                      <?php endif ?>
                      <?php if ($_GET['anio'].'-09' <= date('Y-m')): ?>
                      <!-- Septiembre -->
                      <th class="align-middle text-center">RS</th>
                      <th class="align-middle text-center">RA</th>
                      <th class="align-middle text-center">RN</th>
                      <th class="align-middle text-center">IL</th>
                      <th class="align-middle text-center">ESE</th>
                      <th class="align-middle text-center">TOTAL</th>  
                      <?php endif ?>
                      <?php if ($_GET['anio'].'-10' <= date('Y-m')): ?>
                      <!-- Octubre -->
                      <th class="align-middle text-center">RS</th>
                      <th class="align-middle text-center">RA</th>
                      <th class="align-middle text-center">RN</th>
                      <th class="align-middle text-center">IL</th>
                      <th class="align-middle text-center">ESE</th>
                      <th class="align-middle text-center">TOTAL</th>  
                      <?php endif ?>
                      <?php if ($_GET['anio'].'-11' <= date('Y-m')): ?>
                      <!-- Noviembre -->
                      <th class="align-middle text-center">RS</th>
                      <th class="align-middle text-center">RA</th>
                      <th class="align-middle text-center">RN</th>
                      <th class="align-middle text-center">IL</th>
                      <th class="align-middle text-center">ESE</th>
                      <th class="align-middle text-center">TOTAL</th>  
                      <?php endif ?>
                      <?php if ($_GET['anio'].'-12' <= date('Y-m')): ?>
                      <!-- Diciembre -->
                      <th class="align-middle text-center">RS</th>
                      <th class="align-middle text-center">RA</th>
                      <th class="align-middle text-center">RN</th>
                      <th class="align-middle text-center">IL</th>
                      <th class="align-middle text-center">ESE</th>
                      <th class="align-middle text-center">TOTAL</th>  
                      <?php endif ?>
                      <th class="align-middle text-center">RS</th>
                      <th class="align-middle text-center">RA</th>
                      <th class="align-middle text-center">RN</th>
                      <th class="align-middle text-center">IL</th>
                      <th class="align-middle text-center">ESE</th>
                      <th class="align-middle text-center">TOTAL</th> 
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($clientes as $cliente): ?>
                      <tr>
                        <td class="align-middle static"><?=$cliente['Nombre_Cliente']?></td>
                        <td class="align-middle text-center first-col"><?=$cliente['Centro_Costos']?></td>
                        <td class="align-middle text-right">$ <?=number_format($cliente['RAL'])?></td>
                        <td class="align-middle text-right">$ <?=number_format($cliente['Investigacion_L'])?></td>
                        <td class="align-middle text-right">$ <?=number_format($cliente['ESE'])?></td>
                        <?php if ($_GET['anio'].'-01' <= date('Y-m')): ?>
                        <td class="align-middle text-center"><?=$cliente['No_RAL_Brutos_Ene']?></td>
                        <td class="align-middle text-center"><?=$cliente['No_RAL_Avanzados_Ene']?></td>
                        <td class="align-middle text-center"><?=$cliente['No_RAL_Netos_Ene']?></td>
                        <td class="align-middle text-center"><?=$cliente['No_INV_FIN_Ene']?></td>
                        <td class="align-middle text-center"><?=$cliente['No_ESE_FIN_Ene']?></td>
                        <td class="align-middle text-center"><b><?=$cliente['No_FIN_Ene']?></b></td>
                        <?php $total_RAL['Ene'] = $total_RAL['Ene'] + $cliente['No_RAL_Netos_Ene'] ?>
                        <?php $total_IL['Ene'] = $total_IL['Ene'] + $cliente['No_INV_FIN_Ene'] ?>
                        <?php $total_ESE['Ene'] = $total_ESE['Ene'] + $cliente['No_ESE_FIN_Ene'] ?>
                        <?php endif ?>
                        <?php if ($_GET['anio'].'-02' <= date('Y-m')): ?>
                        <td class="align-middle text-center"><?=$cliente['No_RAL_Brutos_Feb']?></td>
                        <td class="align-middle text-center"><?=$cliente['No_RAL_Avanzados_Feb']?></td>
                        <td class="align-middle text-center"><?=$cliente['No_RAL_Netos_Feb']?></td>
                        <td class="align-middle text-center"><?=$cliente['No_INV_FIN_Feb']?></td>
                        <td class="align-middle text-center"><?=$cliente['No_ESE_FIN_Feb']?></td>
                        <td class="align-middle text-center"><b><?=$cliente['No_FIN_Feb']?></b></td>
                        <?php $total_RAL['Feb'] = $total_RAL['Feb'] + $cliente['No_RAL_Netos_Feb'] ?>
                        <?php $total_IL['Feb'] = $total_IL['Feb'] + $cliente['No_INV_FIN_Feb'] ?>
                        <?php $total_ESE['Feb'] = $total_ESE['Feb'] + $cliente['No_ESE_FIN_Feb'] ?>  
                        <?php endif ?>
                        <?php if ($_GET['anio'].'-03' <= date('Y-m')): ?>
                        <td class="align-middle text-center"><?=$cliente['No_RAL_Brutos_Mar']?></td>
                        <td class="align-middle text-center"><?=$cliente['No_RAL_Avanzados_Mar']?></td>
                        <td class="align-middle text-center"><?=$cliente['No_RAL_Netos_Mar']?></td>
                        <td class="align-middle text-center"><?=$cliente['No_INV_FIN_Mar']?></td>
                        <td class="align-middle text-center"><?=$cliente['No_ESE_FIN_Mar']?></td>
                        <td class="align-middle text-center"><b><?=$cliente['No_FIN_Mar']?></b></td>
                        <?php $total_RAL['Mar'] = $total_RAL['Mar'] + $cliente['No_RAL_Netos_Mar'] ?>
                        <?php $total_IL['Mar'] = $total_IL['Mar'] + $cliente['No_INV_FIN_Mar'] ?>
                        <?php $total_ESE['Mar'] = $total_ESE['Mar'] + $cliente['No_ESE_FIN_Mar'] ?>  
                        <?php endif ?>
                        <?php if ($_GET['anio'].'-04' <= date('Y-m')): ?>
                        <td class="align-middle text-center"><?=$cliente['No_RAL_Brutos_Abr']?></td>
                        <td class="align-middle text-center"><?=$cliente['No_RAL_Avanzados_Abr']?></td>
                        <td class="align-middle text-center"><?=$cliente['No_RAL_Netos_Abr']?></td>
                        <td class="align-middle text-center"><?=$cliente['No_INV_FIN_Abr']?></td>
                        <td class="align-middle text-center"><?=$cliente['No_ESE_FIN_Abr']?></td>
                        <td class="align-middle text-center"><b><?=$cliente['No_FIN_Abr']?></b></td>
                        <?php $total_RAL['Abr'] = $total_RAL['Abr'] + $cliente['No_RAL_Netos_Abr'] ?>
                        <?php $total_IL['Abr'] = $total_IL['Abr'] + $cliente['No_INV_FIN_Abr'] ?>
                        <?php $total_ESE['Abr'] = $total_ESE['Abr'] + $cliente['No_ESE_FIN_Abr'] ?>  
                        <?php endif ?>
                        <?php if ($_GET['anio'].'-05' <= date('Y-m')): ?>
                        <td class="align-middle text-center"><?=$cliente['No_RAL_Brutos_May']?></td>
                        <td class="align-middle text-center"><?=$cliente['No_RAL_Avanzados_May']?></td>
                        <td class="align-middle text-center"><?=$cliente['No_RAL_Netos_May']?></td>
                        <td class="align-middle text-center"><?=$cliente['No_INV_FIN_May']?></td>
                        <td class="align-middle text-center"><?=$cliente['No_ESE_FIN_May']?></td>
                        <td class="align-middle text-center"><b><?=$cliente['No_FIN_May']?></b></td>
                        <?php $total_RAL['May'] = $total_RAL['May'] + $cliente['No_RAL_Netos_May'] ?>
                        <?php $total_IL['May'] = $total_IL['May'] + $cliente['No_INV_FIN_May'] ?>
                        <?php $total_ESE['May'] = $total_ESE['May'] + $cliente['No_ESE_FIN_May'] ?>  
                        <?php endif ?>
                        <?php if ($_GET['anio'].'-06' <= date('Y-m')): ?>
                        <td class="align-middle text-center"><?=$cliente['No_RAL_Brutos_Jun']?></td>
                        <td class="align-middle text-center"><?=$cliente['No_RAL_Avanzados_Jun']?></td>
                        <td class="align-middle text-center"><?=$cliente['No_RAL_Netos_Jun']?></td>
                        <td class="align-middle text-center"><?=$cliente['No_INV_FIN_Jun']?></td>
                        <td class="align-middle text-center"><?=$cliente['No_ESE_FIN_Jun']?></td>
                        <td class="align-middle text-center"><b><?=$cliente['No_FIN_Jun']?></b></td>
                        <?php $total_RAL['Jun'] = $total_RAL['Jun'] + $cliente['No_RAL_Netos_Jun'] ?>
                        <?php $total_IL['Jun'] = $total_IL['Jun'] + $cliente['No_INV_FIN_Jun'] ?>
                        <?php $total_ESE['Jun'] = $total_ESE['Jun'] + $cliente['No_ESE_FIN_Jun'] ?>  
                        <?php endif ?>
                        <?php if ($_GET['anio'].'-07' <= date('Y-m')): ?>
                        <td class="align-middle text-center"><?=$cliente['No_RAL_Brutos_Jul']?></td>
                        <td class="align-middle text-center"><?=$cliente['No_RAL_Avanzados_Jul']?></td>
                        <td class="align-middle text-center"><?=$cliente['No_RAL_Netos_Jul']?></td>
                        <td class="align-middle text-center"><?=$cliente['No_INV_FIN_Jul']?></td>
                        <td class="align-middle text-center"><?=$cliente['No_ESE_FIN_Jul']?></td>
                        <td class="align-middle text-center"><b><?=$cliente['No_FIN_Jul']?></b></td>
                        <?php $total_RAL['Jul'] = $total_RAL['Jul'] + $cliente['No_RAL_Netos_Jul'] ?>
                        <?php $total_IL['Jul'] = $total_IL['Jul'] + $cliente['No_INV_FIN_Jul'] ?>
                        <?php $total_ESE['Jul'] = $total_ESE['Jul'] + $cliente['No_ESE_FIN_Jul'] ?>  
                        <?php endif ?>
                        <?php if ($_GET['anio'].'-08' <= date('Y-m')): ?>
                        <td class="align-middle text-center"><?=$cliente['No_RAL_Brutos_Ago']?></td>
                        <td class="align-middle text-center"><?=$cliente['No_RAL_Avanzados_Ago']?></td>
                        <td class="align-middle text-center"><?=$cliente['No_RAL_Netos_Ago']?></td>
                        <td class="align-middle text-center"><?=$cliente['No_INV_FIN_Ago']?></td>
                        <td class="align-middle text-center"><?=$cliente['No_ESE_FIN_Ago']?></td>
                        <td class="align-middle text-center"><b><?=$cliente['No_FIN_Ago']?></b></td>
                        <?php $total_RAL['Ago'] = $total_RAL['Ago'] + $cliente['No_RAL_Netos_Ago'] ?>
                        <?php $total_IL['Ago'] = $total_IL['Ago'] + $cliente['No_INV_FIN_Ago'] ?>
                        <?php $total_ESE['Ago'] = $total_ESE['Ago'] + $cliente['No_ESE_FIN_Ago'] ?>  
                        <?php endif ?>
                        <?php if ($_GET['anio'].'-09' <= date('Y-m')): ?>
                        <td class="align-middle text-center"><?=$cliente['No_RAL_Brutos_Sep']?></td>
                        <td class="align-middle text-center"><?=$cliente['No_RAL_Avanzados_Sep']?></td>
                        <td class="align-middle text-center"><?=$cliente['No_RAL_Netos_Sep']?></td>
                        <td class="align-middle text-center"><?=$cliente['No_INV_FIN_Sep']?></td>
                        <td class="align-middle text-center"><?=$cliente['No_ESE_FIN_Sep']?></td>
                        <td class="align-middle text-center"><b><?=$cliente['No_FIN_Sep']?></b></td>
                        <?php $total_RAL['Sep'] = $total_RAL['Sep'] + $cliente['No_RAL_Netos_Sep'] ?>
                        <?php $total_IL['Sep'] = $total_IL['Sep'] + $cliente['No_INV_FIN_Sep'] ?>
                        <?php $total_ESE['Sep'] = $total_ESE['Sep'] + $cliente['No_ESE_FIN_Sep'] ?>  
                        <?php endif ?>
                        <?php if ($_GET['anio'].'-10' <= date('Y-m')): ?>
                        <td class="align-middle text-center"><?=$cliente['No_RAL_Brutos_Oct']?></td>
                        <td class="align-middle text-center"><?=$cliente['No_RAL_Avanzados_Oct']?></td>
                        <td class="align-middle text-center"><?=$cliente['No_RAL_Netos_Oct']?></td>
                        <td class="align-middle text-center"><?=$cliente['No_INV_FIN_Oct']?></td>
                        <td class="align-middle text-center"><?=$cliente['No_ESE_FIN_Oct']?></td>
                        <td class="align-middle text-center"><b><?=$cliente['No_FIN_Oct']?></b></td>
                        <?php $total_RAL['Oct'] = $total_RAL['Oct'] + $cliente['No_RAL_Netos_Oct'] ?>
                        <?php $total_IL['Oct'] = $total_IL['Oct'] + $cliente['No_INV_FIN_Oct'] ?>
                        <?php $total_ESE['Oct'] = $total_ESE['Oct'] + $cliente['No_ESE_FIN_Oct'] ?>  
                        <?php endif ?>
                        <?php if ($_GET['anio'].'-11' <= date('Y-m')): ?>
                        <td class="align-middle text-center"><?=$cliente['No_RAL_Brutos_Nov']?></td>
                        <td class="align-middle text-center"><?=$cliente['No_RAL_Avanzados_Nov']?></td>
                        <td class="align-middle text-center"><?=$cliente['No_RAL_Netos_Nov']?></td>
                        <td class="align-middle text-center"><?=$cliente['No_INV_FIN_Nov']?></td>
                        <td class="align-middle text-center"><?=$cliente['No_ESE_FIN_Nov']?></td>
                        <td class="align-middle text-center"><b><?=$cliente['No_FIN_Nov']?></b></td>
                        <?php $total_RAL['Nov'] = $total_RAL['Nov'] + $cliente['No_RAL_Netos_Nov'] ?>
                        <?php $total_IL['Nov'] = $total_IL['Nov'] + $cliente['No_INV_FIN_Nov'] ?>
                        <?php $total_ESE['Nov'] = $total_ESE['Nov'] + $cliente['No_ESE_FIN_Nov'] ?>  
                        <?php endif ?>
                        <?php if ($_GET['anio'].'-12' <= date('Y-m')): ?>
                        <td class="align-middle text-center"><?=$cliente['No_RAL_Brutos_Dic']?></td>
                        <td class="align-middle text-center"><?=$cliente['No_RAL_Avanzados_Dic']?></td>
                        <td class="align-middle text-center"><?=$cliente['No_RAL_Netos_Dic']?></td>
                        <td class="align-middle text-center"><?=$cliente['No_INV_FIN_Dic']?></td>
                        <td class="align-middle text-center"><?=$cliente['No_ESE_FIN_Dic']?></td>
                        <td class="align-middle text-center"><b><?=$cliente['No_FIN_Dic']?></b></td>
                        <?php $total_RAL['Dic'] = $total_RAL['Dic'] + $cliente['No_RAL_Netos_Dic'] ?>
                        <?php $total_IL['Dic'] = $total_IL['Dic'] + $cliente['No_INV_FIN_Dic'] ?>
                        <?php $total_ESE['Dic'] = $total_ESE['Dic'] + $cliente['No_ESE_FIN_Dic'] ?>  
                        <?php endif ?>
                        <td class="align-middle text-center"><?=$cliente['No_RAL_Brutos']?></td>
                        <td class="align-middle text-center"><?=$cliente['No_RAL_Avanzados']?></td>
                        <td class="align-middle text-center"><?=$cliente['No_RAL_Netos']?></td>
                        <td class="align-middle text-center"><?=$cliente['No_INV_FIN']?></td>
                        <td class="align-middle text-center"><?=$cliente['No_ESE_FIN']?></td>
                        <td class="align-middle text-center"><b><?=$cliente['No_FIN']?></b></td>
                      </tr>
                    <?php endforeach ?>
                </tbody>
              </table>
            </div>
        </div>
        <div class="card mt-3">
          <div class="card-header">
            <h4 class="card-title">Gráfica servicios de apoyo por mes</h4>
            <div class="card-tools">
              <button type="button" class="btn btn-sm" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <div class="chart">
              <canvas id="stackedBarChart" style="min-height: 250px; height: 600px; max-height: 600px; max-width: 100%;"></canvas>
            </div>
          </div>
        </div>
    </section>      
</div>
<!-- ChartJS -->
<script src="<?=base_url?>plugins/chart.js/Chart.min.js"></script>
<script>
  $(document).ready(function(){

    var areaChartData = {
      labels  : ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
      datasets: [
        {
          label               : 'Estudios Socioeconómicos',
          backgroundColor     : 'rgba(51, 54, 79, 1)',
          borderColor         : 'rgba(51, 54, 79, 1)',
          pointRadius         : false,
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [<?=$total_ESE['Ene'].', '.$total_ESE['Feb'].', '.$total_ESE['Mar'].', '.$total_ESE['Abr'].', '.$total_ESE['May'].', '.$total_ESE['Jun'].', '.$total_ESE['Jul'].', '.$total_ESE['Ago'].', '.$total_ESE['Sep'].', '.$total_ESE['Oct'].', '.$total_ESE['Nov'].', '.$total_ESE['Dic']?>]
        },
        {
          label               : 'Investigación Laboral',
          backgroundColor     : 'rgba(184, 12, 9, 1)',
          borderColor         : 'rgba(184, 12, 9, 1)',
          pointRadius         : false,
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [<?=$total_IL['Ene'].', '.$total_IL['Feb'].', '.$total_IL['Mar'].', '.$total_IL['Abr'].', '.$total_IL['May'].', '.$total_IL['Jun'].', '.$total_IL['Jul'].', '.$total_IL['Ago'].', '.$total_IL['Sep'].', '.$total_IL['Oct'].', '.$total_IL['Nov'].', '.$total_IL['Dic']?>]
        },
        {
          label               : 'RAL',
          backgroundColor     : 'rgba(242, 131, 34, 1)',
          borderColor         : 'rgba(242, 131, 34, 1)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [<?=$total_RAL['Ene'].', '.$total_RAL['Feb'].', '.$total_RAL['Mar'].', '.$total_RAL['Abr'].', '.$total_RAL['May'].', '.$total_RAL['Jun'].', '.$total_RAL['Jul'].', '.$total_RAL['Ago'].', '.$total_RAL['Sep'].', '.$total_RAL['Oct'].', '.$total_RAL['Nov'].', '.$total_RAL['Dic']?>]
        }
        
      ]
    }
    var barChartData = $.extend(true, {}, areaChartData)
    var stackedBarChartCanvas = $('#stackedBarChart').get(0).getContext('2d')
    var stackedBarChartData = $.extend(true, {}, barChartData)

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
    console.log(stackedBarChartData);
    var stackedBarChart = new Chart(stackedBarChartCanvas, {
      type: 'bar',
      data: stackedBarChartData,
      options: stackedBarChartOptions
    })
  });
</script>