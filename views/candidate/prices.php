<style>
    .container {
        max-width: 960px;
    }

    .pricing-header {
        max-width: 700px;
    }

    .card-deck .card {
        min-width: 220px;
    }

    .border-top {
        border-top: 1px solid #e5e5e5;
    }

    .border-bottom {
        border-bottom: 1px solid #e5e5e5;
    }

    .box-shadow {
        box-shadow: 0 .25rem .75rem rgba(0, 0, 0, .05);
    }
</style>
<div class="content-wrapper">
    <div class="container mt-5">
        <div class="content pt-5">
            <div class="container-fluid">
                <h2 class="mb-5">Termina tu CV</h2>
                <div class="card-deck mb-3 text-center">
                    <div class="card mb-4 box-shadow">
                        <div class="card-header">
                            <h4 class="my-0 font-weight-normal">Gratis</h4>
                        </div>
                        <div class="card-body">
                            <h5 class="pricing-card-title">$0 </h5>
                            <ul class="list-unstyled mt-3 mb-4">
                                <li>Actualizar tu información de CV</li>
                                <li>Postularte en nuestras vacantes</li>
                                <li>currículum Ingenia</li>
                            </ul>
                            <a href="<?= base_url ?>Resume/generate&id=<?=Encryption::encode($_SESSION['data']->id_candidate)?>" target="_blank" class="btn btn-lg btn-block btn-outline-primary">Descargar</a>
                        </div>
                    </div>
                    <div class="card mb-4 box-shadow">
                        <div class="card-header">
                            <h4 class="my-0 font-weight-normal">CV Profesional</h4>
                        </div>
                        <div class="card-body">
                            <h5 class="pricing-card-title">$100 <small class="text-muted">/ CV</small></h5>
                            <ul class="list-unstyled mt-3 mb-4">
                                <li>Actualizar tu información de CV</li>
                                <li>Postularte en nuestras vacantes</li>
                                <li>Descargar CV por 14 días</li>
                            </ul>
                            <a href="<?=base_url?>candidato/pagar_cv" class="btn btn-lg btn-block btn-primary">Continuar</a>
                        </div>
                    </div>
                    <div class="card mb-4 box-shadow">
                        <div class="card-header">
                            <h4 class="my-0 font-weight-normal">Premium</h4>
                        </div>
                        <div class="card-body">
                            <h5 class="pricing-card-title">$270 <small class="text-muted">/ 3 CVs</small></h5>
                            <ul class="list-unstyled mt-3 mb-4">
                                <li>Actualizar tu información de CV</li>
                                <li>Postularte en nuestras vacantes</li>
                                <li>Currículum con 3 diseños profesionales</li>
                                <li>Descargar CV por 14 días</li>
                            </ul>
                            <a href="<?=base_url?>candidato/pagar_cv" class="btn btn-lg btn-block btn-primary">Continuar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>