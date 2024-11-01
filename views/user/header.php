<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= isset($page_title) ? $page_title : 'Reclutamiento' ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="<?= base_url ?>dist/img/SIGMALOGO2.png">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url ?>plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="<?= base_url ?>plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?= base_url ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url ?>dist/css/adminlte.css?v=<?= rand() ?>">
    <link rel="stylesheet" href="<?= base_url ?>dist/css/styles.css?v=<?= rand() ?>">
    <meta name="theme-color" content="#33364f">
</head>

<body class="hold-transition login-page login-bg">
    <div class="login-box">