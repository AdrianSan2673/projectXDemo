<!-- gabo 20/02/2022 -->
<div class="modal fade" id="modal_perfil_postulante">
    <div class="modal-dialog modal-lg" style="max-width:  1200px!important;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Perfil del Postulante</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="save_perfil-form" action="post">
                <input type="hidden" name="id_candidate" id="id_candidate">
                <input type="hidden" name="vacancy_id" id="vacancy_id">

                <div class="modal-body">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="card card-success">
                            <div class="card-header" style="text-align: center;">
                                <h4 class="card-title">
                                    Descripción
                                </h4>
                            </div>
                            <div class="card-body" style="margin:auto">
                                <div class="card-deck">
                                    <div class="card" style="min-width: 10rem;align-items:center">
                                        <img src="" style="max-width: 10rem;" id="photo" class="card-img-top" alt="...">
                                    </div>

                                    <div class="card" style="min-width: 18rem;">
                                        <div class="card-body">
                                            <p class="card-text" id="candidate_name"><b>Nombre del Candidato:</b></p>
                                            <p class="card-text" id="vacancy"><b>Nombre del puesto:</b></p>
                                            <p class="card-text" id="ubication"><b>Ubicación del puesto:</b></p>
                                            <p class="card-text" id="salary"><b>Sueldo Ofrecido:</b></p>
                                            <!-- <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p> -->
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="card card-red">
                            <div class="card-header" style="text-align: center;">
                                <h4 class="card-title">
                                    Perfil
                                </h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group" style="text-align: center">
                                            <label for="" class="col-form-label" style="margin-top:34px">Sexo:</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group" style="text-align: center">
                                            <label class="col-form-label">Requerido</label>
                                            <input type="" name="gender" id="gender" style="text-align:center""  class="
                                                form-control" value="" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group" style="text-align: center">
                                            <label class="col-form-label">Candidato</label>
                                            <input type="" name="gender_c" id="gender_c"
                                                style="text-align:center""  class=" form-control" value="" required
                                                <?= Utils::isCustomer() ? 'disabled' : '' ?> maxlength="20">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group" style="text-align: center">
                                            <label class="col-form-label">Estado</label>
                                            <select name="status_gender" id="status_gender" class="form-control"
                                                required <?= Utils::isCustomer() ? 'disabled' : '' ?>>
                                                <option value="" selected disabled>Seleciona Estado</option>
                                                <option value="si"> Cumple</option>
                                                <option value="no">No cumple</option>
                                                <option value="no aplica">No aplica</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group" style="text-align: center">
                                            <label for="" class="col-form-label" style="margin-top:5px">Edad:</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group" style="text-align: center">
                                            <input type="" name="age" id="age" style="text-align:center""  class="
                                                form-control" value="" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group" style="text-align: center">
                                            <input type="number" name="age_c" id="age_c"
                                                style="text-align:center""  class=" form-control" value="" min="18"
                                                required <?= Utils::isCustomer() ? 'disabled' : '' ?> maxlength="3">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group" style="text-align: center">
                                            <select name="status_age" id="status_age" class="form-control" required
                                                <?= Utils::isCustomer() ? 'disabled' : '' ?>>
                                                <option value="" selected disabled>Seleciona Estado</option>
                                                <option value="si"> Cumple</option>
                                                <option value="no">No cumple</option>
                                                <option value="no aplica">No aplica</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group" style="text-align: center">
                                            <label for="" class="col-form-label" style="margin-top:5px">Estado
                                                Civil:</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group" style="text-align: center">
                                            <input type="" name="civil_status" id="civil_status"
                                                style="text-align:center""  class=" form-control" value="" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group" style="text-align: center">
                                            <input type="" name="civil_status_c" id="civil_status_c"
                                                style="text-align:center""  class=" form-control" value="" required
                                                <?= Utils::isCustomer() ? 'disabled' : '' ?> maxlength="20">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group" style="text-align: center">
                                            <select name="status_civil_status" id="status_civil_status"
                                                class="form-control" required
                                                <?= Utils::isCustomer() ? 'disabled' : '' ?>>
                                                <option value="" selected disabled>Seleciona Estado</option>
                                                <option value="si"> Cumple</option>
                                                <option value="no">No cumple</option>
                                                <option value="no aplica">No aplica</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card card-purple">
                            <div class="card-header" style="text-align: center;">
                                <h4 class="card-title">
                                    Escolaridad
                                </h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group" style="text-align: center">
                                            <label for="" class="col-form-label"
                                                style="margin-top:30px">Estudios:</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group" style="text-align: center">
                                            <label class="col-form-label">Requerido</label>
                                            <input type="" name="level" id="level" class="form-control"
                                                style="text-align:center""  value="" readonly>
                    </div>
                  </div>

                  <div class=" col-md-3">
                                            <div class="form-group" style="text-align: center">
                                                <label class="col-form-label">Candidato</label>
                                                <input type="" name="level_c" id="level_c" class="form-control"
                                                    style="text-align:center""  value="" required <?= Utils::isCustomer() ? 'disabled' : '' ?> maxlength="
                                                    50">
                                            </div>
                                        </div>
                                        <div class=" col-md-3">
                                            <div class="form-group" style="text-align: center">
                                                <label class="col-form-label">Estado</label>
                                                <select name="status_level" id="status_level" class="form-control"
                                                    required <?= Utils::isCustomer() ? 'disabled' : '' ?>>
                                                    <option value="" selected disabled>Seleciona Estado</option>
                                                    <option value="si"> Cumple</option>
                                                    <option value="no">No cumple</option>
                                                    <option value="no aplica">No aplica</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card card-info div_language">
                                <div class="card-header" style="text-align: center;">
                                    <h4 class="card-title">
                                        Idiomas
                                    </h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group" style="text-align: center">
                                                <label for="" class="col-form-label"
                                                    style="margin-top:30px">Idioma:</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group" style="text-align: center">
                                                <label class="col-form-label">Requerido</label>
                                                <input type="" name="language" id="language" class="form-control"
                                                    style="text-align:center""  value="" readonly>
                    </div>
                  </div>

                  <div class=" col-md-3">
                                                <div class="form-group" style="text-align: center">
                                                    <label class="col-form-label">Candidato</label>
                                                    <input type="" name="language_c" id="language_c"
                                                        style="text-align:center""  class=" form-control" value=""
                                                        <?= Utils::isCustomer() ? 'disabled' : '' ?> maxlength="50">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group" style="text-align: center">
                                                    <label class="col-form-label">Estado</label>
                                                    <select name="status_language" id="status_language"
                                                        class="form-control"
                                                        <?= Utils::isCustomer() ? 'disabled' : '' ?>>
                                                        <option value="" selected disabled>Seleciona Estado</option>
                                                        <option value="si"> Cumple</option>
                                                        <option value="no">No cumple</option>
                                                        <option value="no aplica">No aplica</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group" style="text-align: center">
                                                    <label for="" class="col-form-label"
                                                        style="margin-top:10px">Dominio:</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group" style="text-align: center">
                                                    <input type="" name="language_level" id="language_level"
                                                        class="form-control" value=""
                                                        style="text-align:center""  readonly maxlength=" 50">
                                                </div>
                                            </div>

                                            <div class=" col-md-3">
                                                <div class="form-group" style="text-align: center">
                                                    <input type="" name="language_level_c" id="language_level_c"
                                                        style="text-align:center""  class=" form-control" value=""
                                                        <?= Utils::isCustomer() ? 'disabled' : '' ?>>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group" style="text-align: center">
                                                    <select name="status_language_level" id="status_language_level"
                                                        class="form-control"
                                                        <?= Utils::isCustomer() ? 'disabled' : '' ?>>
                                                        <option value="" selected disabled>Seleciona Estado</option>
                                                        <option value="si"> Cumple</option>
                                                        <option value="no">No cumple</option>
                                                        <option value="no aplica">No aplica</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card card-orange">
                                    <div class="card-header" style="text-align: center;">
                                        <h4 class="card-title">
                                            Experiencia
                                        </h4>
                                    </div>
                                    <div class="card-body">

                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group" style="text-align: center">
                                                    <label for="" class="col-form-label" style="margin-top:30px">Años o meses de
                                                        Experiencia:</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group" style="text-align: center">
                                                    <label class="col-form-label">Requerido</label>
                                                    <input type="text" name="experience_years" id="experience_years"
                                                        style="text-align:center"" class=" form-control" value=""
                                                        readonly>
                                                </div>
                                            </div>

                                            <!-- ===[gabo 27 junio perfil]=== -->
                                            <div class="col-md-2">
                                                <div class="form-group" style="text-align: center">
                                                    <label class="col-form-label">Candidato</label>
                                                    <input type="number" name="experience_years_c"
                                                        id="experience_years_c" style="text-align:center""  class="
                                                        form-control" value="" required
                                                        <?= Utils::isCustomer() ? 'disabled' : '' ?>>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group" style="text-align: center">
                                                    <label class="col-form-label">Tiempo</label>
                                                    <select name="tiempo" id="tiempo" class="form-control" required
                                                        <?= Utils::isCustomer() ? 'disabled' : '' ?>>
                                                        <option value="" selected disabled>Seleciona</option>
                                                        <option value="meses">Meses</option>
                                                        <option value="años">Años</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group" style="text-align: center">
                                                    <label class="col-form-label">Estado</label>
                                                    <select name="status_experience_years" id="status_experience_years"
                                                        class="form-control" required
                                                        <?= Utils::isCustomer() ? 'disabled' : '' ?>>
                                                        <option value="" selected disabled>Seleciona Estado</option>
                                                        <option value="si"> Cumple</option>
                                                        <option value="no">No cumple</option>
                                                        <option value="no aplica">No aplica</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- ===[gabo 27 junio perfil]=== -->

                                        <!-- Act gabo  -->
                                        <div class="row">
                                            <div class="col-md-3" style="text-align: center;margin:auto  ">
                                                <div class="form-group " style="text-align: center; ">
                                                    <label class="col-form-label"
                                                        style="text-align: center;margin:auto">Comentarios sobre la
                                                        experiencia:</label>
                                                </div>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-group" style="text-align: center">
                                                    <textarea class="form-control" name="experiencia_comments"
                                                        id="experiencia_comments" cols="25" rows="3" required
                                                        <?= Utils::isCustomer() ? 'disabled' : '' ?>></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group" style="text-align: center">
                                                    <label for="" class="col-form-label" style="margin-top:30px">Puestos
                                                        que pudo haber ocupado:</label>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group" style="text-align: center">
                                                    <label class="col-form-label">Requerido</label>
                                                    <textarea class="form-control" name="functions" id="functions"
                                                        rows="4" readonly>  </textarea>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group" style="text-align: center">
                                                    <label class="col-form-label">Candidato</label>
                                                    <textarea class="form-control" name="functions_c" id="functions_c"
                                                        rows="4"
                                                        <?= Utils::isCustomer() ? 'disabled' : '' ?>></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group" style="text-align: center">
                                                    <label class="col-form-label">Estado</label>
                                                    <select name="status_functions" id="status_functions"
                                                        class="form-control" required
                                                        <?= Utils::isCustomer() ? 'disabled' : '' ?>>
                                                        <option value="" selected disabled>Seleciona Estado</option>
                                                        <option value="si"> Cumple</option>
                                                        <option value="no">No cumple</option>
                                                        <option value="no aplica">No aplica</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-3" style="text-align: center;margin:auto  ">
                                                <div class="form-group " style="text-align: center; ">
                                                    <label class="col-form-label"
                                                        style="text-align: center;margin:auto">Comentarios sobre los
                                                        puestos:</label>
                                                </div>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-group" style="text-align: center">
                                                    <textarea class="form-control" name="functions_comments"
                                                        id="functions_comments" cols="25" rows="3" required
                                                        <?= Utils::isCustomer() ? 'disabled' : '' ?>></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-3" style="text-align: center;margin:auto  ">
                                                <div class="form-group " style="text-align: center; ">
                                                    <label class="col-form-label"
                                                        style="text-align: center;margin:auto">Comentarios
                                                        generales:</label>
                                                </div>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-group" style="text-align: center">
                                                    <textarea class="form-control" name="general_comments"
                                                        id="general_comments" cols="25" rows="5" required
                                                        <?= Utils::isCustomer() ? 'disabled' : '' ?>></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- fin gabo mod -->
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                <?php if (Utils::isAdmin() || Utils::isSenior() || Utils::isRecruitmentManager()) : ?>
                                <input type="submit" name="submit" id="submit" class="btn btn-orange" value="Guardar">
                                <?php endif; ?>
                            </div>
                        </div>
            </form>

        </div>
    </div>
</div>

<script>
document.querySelector("#modal_perfil_postulante").onsubmit = function(e) {

    e.preventDefault();
    document.querySelector("#modal_perfil_postulante #submit").disabled = true;
    let candidato = new Candidate();
    candidato.save_perfil();

};

function delete_row(objeto) {
    objeto.parentElement.parentElement.parentElement.remove();
}
</script>