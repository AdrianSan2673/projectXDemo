<div class="content-wrapper">
    <div class="container mt-5">
        <div class="content pt-5">
            <div class="container-fluid">
                <div class="logo">
                    <img src="https://rrhh-ingenia.com.mx/dist/img/rrhh-ingenia.png" alt="Logo de la Empresa">
                </div>
                <div class="content">
                    <h2>Confirmación de Compra de CV</h2>
                    <p>Estimado/a <?=$_SESSION['data']->first_name.' '.$_SESSION['data']->surname ?>,</p>
                    <p>Has adquirido el diseño de CV llamado "Plantilla 1". Aquí están los detalles de tu compra:</p>
                    <ul>
                        <li><strong>Fecha y Hora de Compra:</strong> <?= Utils::getFullDate($sale->createdat) ?></li>
                        <li><strong>Precio:</strong> </li>
                        <li><strong>ID de Compra:</strong> [ID de Compra]</li>
                        <li><strong>Vigencia de Descarga del CV:</strong> [Vigencia]</li>
                    </ul>
                    <p>Gracias por tu compra. Puedes acceder a tu diseño de CV en cualquier momento antes de que expire la vigencia.</p>
                </div>
            </div>
        </div>
    </div>
</div>