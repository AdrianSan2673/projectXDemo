<!--    //  ===[gabo 28 abril modal vacantes]=== -->
<div class="modal fade" id="modal_vacantes">
    <div class="modal-dialog modal-lg" style="max-width:  700px!important;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="">Agregar a vacante</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- form start -->
            <form id="add-candidate-form" name="add-candidate-form"  action="post">
                <div class="modal-body">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                
                                    <input type="hidden" value="" name="id_candidate" id="id_candidato_v">
                                    <div class="card card-info ">
                                        <div class="card-header">
                                            <h4 class="card-title" id="nombre_candidato"></h4>
                                        </div>
                                        <div class="card-body ">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="vacantes" class="col-form-label">Vacantes disponibles:</label>
                                                        <select multiple  name="id_vacancies[]"  id="id_vacancy_v" class="form-control select2" required>
                                                            <option disabled selected>Selecciona una vacante</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button class="btn btn-orange float-right" id="add_candidate_submit">Enviar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="<?=base_url?>app/vacancy.js?v=<?=rand()?>"></script>

<script>
    document.querySelector('#add-candidate-form').addEventListener('submit', e => {
        e.preventDefault();
        let vacancy = new Vacancy();
        vacancy.agregar_candidato();
    });
</script>