<style>
    .image-container {
        position: relative;
        overflow: hidden;
    }

    .image-container img {
        transition: transform 0.3s ease;
    }

    .image-container .overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .image-container .overlay button {
        display: none;
    }

    .image-container:hover img {
        transform: scale(1.05);
    }

    .image-container:hover .overlay {
        opacity: 1;
    }

    .image-container:hover .overlay button {
        display: block;
    }
</style>
<div class="content-wrapper">
    <div class="container mt-5">
        <div class="content pt-5">
            <div class="container-fluid">
                <h2 class="mb-5">Selecciona una Plantilla de CV</h2>
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <div class="image-container">
                            <img src="<?= base_url ?>dist/img/Curriculumplantilla-Ejemplo.jpg" class="img-fluid" alt="Plantilla 1">
                            <div class="overlay">
                                <a href="<?=base_url?>candidato/datos_cv&template=<?=Encryption::encode('Resume')?>" class="btn btn-primary btn-lg btn-select">Seleccionar</a>
                            </div>
                        </div>
                    </div>
                    <!-- Plantilla 1 -->
                    <div class="col-md-4 mb-4">
                        <div class="image-container">
                            <img src="<?= base_url ?>dist/img/Resume1.jpg" class="img-fluid" alt="Plantilla 1">
                            <div class="overlay">
                                <a href="<?=base_url?>candidato/datos_cv&template=<?=Encryption::encode('Resume1')?>" class="btn btn-primary btn-lg btn-select">Seleccionar</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 mb-4">
                        <div class="image-container">
                            <img src="<?= base_url ?>dist/img/Resume2.jpg" class="img-fluid" alt="Plantilla 2">
                            <div class="overlay">
                                <a href="<?=base_url?>candidato/datos_cv&template=<?=Encryption::encode('Resume1')?>" class="btn btn-primary btn-lg btn-select">Seleccionar</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="image-container">
                            <img src="<?= base_url ?>dist/img/Resume3.jpg" class="img-fluid" alt="Plantilla 2">
                            <div class="overlay">
                                <a href="<?=base_url?>candidato/datos_cv&template=<?=Encryption::encode('Resume2')?>" class="btn btn-primary btn-lg btn-select">Seleccionar</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="image-container">
                            <img src="<?= base_url ?>dist/img/Resume5.jpg" class="img-fluid" alt="Plantilla 2">
                            <div class="overlay">
                                <a href="<?=base_url?>candidato/datos_cv&template=<?=Encryption::encode('Resume3')?>" class="btn btn-primary btn-lg btn-select">Seleccionar</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="image-container">
                            <img src="<?= base_url ?>dist/img/Resume6.jpg" class="img-fluid" alt="Plantilla 2">
                            <div class="overlay">
                                <a href="<?=base_url?>candidato/datos_cv&template=<?=Encryption::encode('Resume5')?>" class="btn btn-primary btn-lg btn-select">Seleccionar</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="image-container">
                            <img src="<?= base_url ?>dist/img/Resume7.jpg" class="img-fluid" alt="Plantilla 2">
                            <div class="overlay">
                                <a href="<?=base_url?>candidato/datos_cv&template=<?=Encryption::encode('Resume6')?>" class="btn btn-primary btn-lg btn-select">Seleccionar</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="image-container">
                            <img src="<?= base_url ?>dist/img/Resume8.jpg" class="img-fluid" alt="Plantilla 2">
                            <div class="overlay">
                                <a href="<?=base_url?>candidato/datos_cv&template=<?=Encryption::encode('Resume7')?>" class="btn btn-primary btn-lg btn-select">Seleccionar</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="image-container">
                            <img src="<?= base_url ?>dist/img/Resume9.jpg" class="img-fluid" alt="Plantilla 2">
                            <div class="overlay">
                                <a href="<?=base_url?>candidato/datos_cv&template=<?=Encryption::encode('Resume8')?>" class="btn btn-primary btn-lg btn-select">Seleccionar</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="image-container">
                            <img src="<?= base_url ?>dist/img/Resume10.jpg" class="img-fluid" alt="Plantilla 2">
                            <div class="overlay">
                                <a href="<?=base_url?>candidato/datos_cv&template=<?=Encryption::encode('Resume9')?>" class="btn btn-primary btn-lg btn-select">Seleccionar</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="image-container">
                            <img src="<?= base_url ?>dist/img/Resume11.jpg" class="img-fluid" alt="Plantilla 2">
                            <div class="overlay">
                                <a href="<?=base_url?>candidato/datos_cv&template=<?=Encryption::encode('Resume10')?>" class="btn btn-primary btn-lg btn-select">Seleccionar</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="image-container">
                            <img src="<?= base_url ?>dist/img/Resume12.jpg" class="img-fluid" alt="Plantilla 2">
                            <div class="overlay">
                                <a href="<?=base_url?>candidato/datos_cv&template=<?=Encryption::encode('Resume11')?>" class="btn btn-primary btn-lg btn-select">Seleccionar</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="image-container">
                            <img src="<?= base_url ?>dist/img/Resume13.jpg" class="img-fluid" alt="Plantilla 2">
                            <div class="overlay">
                                <a href="<?=base_url?>candidato/datos_cv&template=<?=Encryption::encode('Resume12')?>" class="btn btn-primary btn-lg btn-select">Seleccionar</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="image-container">
                            <img src="<?= base_url ?>dist/img/Resume14.jpg" class="img-fluid" alt="Plantilla 2">
                            <div class="overlay">
                                <a href="<?=base_url?>candidato/datos_cv&template=<?=Encryption::encode('Resume13')?>" class="btn btn-primary btn-lg btn-select">Seleccionar</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="image-container">
                            <img src="<?= base_url ?>dist/img/Resume15.jpg" class="img-fluid" alt="Plantilla 2">
                            <div class="overlay">
                                <a href="<?=base_url?>candidato/datos_cv&template=<?=Encryption::encode('Resume14')?>" class="btn btn-primary btn-lg btn-select">Seleccionar</a>
                            </div>
                        </div>
                    </div>
                    <!-- Agrega más plantillas aquí -->
                </div>
            </div>
        </div>
    </div>
</div>