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
    <div style="margin-top: 3%;">

        <style>
            body {
                display: flex;
                align-items: center;
                justify-content: center;
                height: 100vh;
                margin: 0;
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                background-color: #e6f7ff;
                /* Color de fondo */
            }

            .container {
                text-align: center;
                background-color: #ffffff;
                /* Color de fondo del contenedor */
                padding: 27px;
                width: 800px;
                border-radius: 15px;
                box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            }

            h1 {
                color: #007bff;
                /* Color del encabezado */
            }

            img {
                max-width: 70%;
                height: auto;
                margin-top: 20px;
                border-radius: 15px;
                margin-bottom: 20px;
            }

            p {
                color: #555;
                font-size: 18px;
                margin-top: 15px;
            }

            a {
                color: #28a745;
                /* Color del enlace */
                text-decoration: none;
                font-weight: bold;
            }

            a:hover {
                text-decoration: underline;
            }
        </style>
        </head>

        <body>
            <div class="container">
                <h1>Contenido No Disponible</h1>
                <img src="<?= base_url ?>dist/img/gatitoerror.jpg?v=<?= rand() ?>" alt="Gatito adorable">
                <h2>Si requiere de este apartado por favor comuniquese con nosotros.</h2>
                <p><a href="<?= base_url . "usuario/index"; ?> " style="color: #28a745;">Volver a la página
                        principal</a></p>
            </div>
        </body>

</html>