<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title><?=isset($page_title) ? $page_title : 'Reclutamiento'?></title>
    <link rel="icon" type="image/png" href="<?=base_url?>dist/img/SIGMALOGO2.png">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?=base_url?>plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- jQuery -->
    <script src="<?=base_url?>plugins/jquery/jquery.min.js"></script>
    <script src="<?=base_url?>plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- daterange picker -->
    <link rel="stylesheet" href="<?=base_url?>plugins/daterangepicker/daterangepicker.css">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="<?=base_url?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="<?=base_url?>plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="<?=base_url?>plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="<?=base_url?>plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="<?=base_url?>plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <link rel="stylesheet" href="<?=base_url?>plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?=base_url?>plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?=base_url?>plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css">
	<link rel="stylesheet" href="<?=base_url?>plugins/bs-stepper/css/bs-steppermin.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?=base_url?>dist/css/adminlte.min.css?v=2021">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="<?=base_url?>dist/css/styles.css?v=12">
    <!-- Bootstrap 4 -->
    <link rel="stylesheet" href="<?=base_url?>plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <script src="<?=base_url?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?=base_url?>plugins/select2/js/select2.full.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="<?=base_url?>plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <script src="<?=base_url?>plugins/datatables/jquery.dataTables.min.js?v=<?=rand()?>"></script>
    <script src="<?=base_url?>plugins/datatables-bs4/js/dataTables.bootstrap4.min.js?v=<?=rand()?>"></script>
    <script src="<?=base_url?>plugins/datatables-responsive/js/dataTables.responsive.min.js?v=<?=rand()?>"></script>
    <script src="<?=base_url?>plugins/datatables-responsive/js/responsive.bootstrap4.min.js?v=<?=rand()?>"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>

    <script src="https://cdn.jsdelivr.net/gh/jamesssooi/Croppr.js@2.3.0/dist/croppr.min.js"></script>
    <link href="https://cdn.jsdelivr.net/gh/jamesssooi/Croppr.js@2.3.0/dist/croppr.min.css" rel="stylesheet"/>
    <script src="<?=base_url?>dist/js/fabric.min.js"></script>
      <!-- JQVMap -->
    <link rel="stylesheet" href="<?=base_url?>plugins/jqvmap/jqvmap.min.css">
    <link rel="stylesheet" href="<?=base_url?>plugins/ekko-lightbox/ekko-lightbox.css">
    
    <script src="<?=base_url?>plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="<?=base_url?>plugins/jquery-validation/additional-methods.min.js"></script>
    <link href="<?=base_url?>plugins/unpkg/cropper.css" rel="stylesheet"/>
    <script src="<?=base_url?>plugins/unpkg/cropper.js"></script>
	<link rel="stylesheet" href="<?=base_url?>plugins/summernote/summernote-bs4.min.css">
	<link href="https://vjs.zencdn.net/8.10.0/video-js.css" rel="stylesheet" />
	<link href="https://unpkg.com/@videojs/themes@1/dist/sea/index.css" rel="stylesheet" />
	
	<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-MLF9ZBQL');</script>
<!-- End Google Tag Manager -->
	
</head>
