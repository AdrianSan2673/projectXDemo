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
                <h2 class="mb-5">Termina tu CV</h2>
                <div id="pdf-container">
                      <div id="pdf-page"></div>
                      <button id="prev-page" class="btn btn-sm btn-secondary"><i class="fas fa-chevron-left"></i></button>
                      <button id="next-page" class="btn btn-sm btn-secondary"><i class="fas fa-chevron-right"></i></button>
                      <p id="page-info">Página <span id="page-num">1</span> de <span id="page-count"></span></p>
                      <button id="show-templates">Cambiar Plantilla</button>
                    </div>
                    <div id="template-container" class="hidden">
                        <div class="template-scroll">
                            <img src="<?= base_url ?>dist/img/Curriculumplantilla-Ejemplo.jpg" alt="Resume">
                            <img src="<?= base_url ?>dist/img/Resume1.jpg" alt="Resume1">
                            <img src="<?= base_url ?>dist/img/Resume2.jpg" alt="Resume2">
                            <img src="<?= base_url ?>dist/img/Resume3.jpg" alt="Resume3">
                            <img src="<?= base_url ?>dist/img/Resume5.jpg" alt="Resume5">
                            <img src="<?= base_url ?>dist/img/Resume6.jpg" alt="Resume6">
                            <img src="<?= base_url ?>dist/img/Resume7.jpg" alt="Resume7">
                            <img src="<?= base_url ?>dist/img/Resume8.jpg" alt="Resume8">
                            <img src="<?= base_url ?>dist/img/Resume9.jpg" alt="Resume9">
                            <img src="<?= base_url ?>dist/img/Resume10.jpg" alt="Resume10">
                            <img src="<?= base_url ?>dist/img/Resume11.jpg" alt="Resume11">
                            <img src="<?= base_url ?>dist/img/Resume12.jpg" alt="Resume12">
                            <img src="<?= base_url ?>dist/img/Resume13.jpg" alt="Resume13">
                            <img src="<?= base_url ?>dist/img/Resume14.jpg" alt="Resume14">
                            <img src="<?= base_url ?>dist/img/Resume15.jpg" alt="Resume15">
                        </div>
                    </div>
                    <div id="colorOptions">
                        <div class="colorOption" style="background-color: #f28322;" data-red="242" data-green="131" data-blue="34"></div>
                        <div class="colorOption" style="background-color: #f8c630;" data-red="248" data-green="198" data-blue="48"></div>
                        <div class="colorOption" style="background-color: #95bf3b;" data-red="149" data-green="191" data-blue="59"></div>
                        <div class="colorOption" style="background-color: #005e32;" data-red="0" data-green="94" data-blue="50"></div>
                        <div class="colorOption" style="background-color: #048abf;" data-red="4" data-green="138" data-blue="191"></div>
                        <div class="colorOption" style="background-color: #101928;" data-red="16" data-green="25" data-blue="40"></div>
                        <div class="colorOption" style="background-color: #b80c09;" data-red="184" data-green="12" data-blue="9"></div>
                        <div class="colorOption" style="background-color: #d948a6;" data-red="217" data-green="72" data-blue="166"></div>
                    </div>
            </div>
        </div>
    </div>
</div>