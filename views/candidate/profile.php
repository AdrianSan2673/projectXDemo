<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <div class="alert alert-success">
                        <h4>
                            <?= $candidato->first_name . ' ' . $candidato->surname . ' ' . $candidato->last_name ?>

                        </h4>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <!-- form start -->
                    <form id="profile-candidate-form" method="POST">
                        <!-- general form elements -->
                        <input type="hidden" name="id_candidate" value="<?= Encryption::encode($candidato->id) ?>">
                        <input type="hidden" name="vacancy_id" value="<?= Encryption::encode($vacante->id_vacancy) ?>">
                        <?php if (!Utils::isCandidate()  && isset($_GET['id_vacancy']) && $_GET['id_vacancy'] != '') :  ?>

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
                                                <input type="" name="" id="" style="text-align:center" class=" form-control" value="<?= isset($vacante) && $vacante->gender != '' ? $vacante->gender : ''; ?>" maxlength="20" readonly>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group" style="text-align: center">
                                                <label class="col-form-label">Candidato</label>
                                                <input type="" name="gender_c" id="gender_c" value="<?= $candidato->gender ?>" style="text-align:center" class=" form-control" maxlength="20">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group" style="text-align: center">
                                                <label class="col-form-label">Estado</label>
                                                <select name="status_gender" id="status_gender" class="form-control" <?= Utils::isCustomer() ? 'disabled' : '' ?> required>
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
                                                <input type="" name="" id="" style="text-align:center" class=" form-control" readonly value="<?= isset($vacante) && $vacante->age_min != '' && $vacante->age_max != '' ? $vacante->age_min . "-" . $vacante->age_max : ''; ?>">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group" style="text-align: center">
                                                <input type="number" name="age_c" id="age_c" style="text-align:center" class=" form-control" value="<?= ($candidato->age_cal!=0)? $candidato->age_cal : ''?>" min="18" maxlength="3" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength)" <?= Utils::isCustomer() ? 'disabled' : '' ?>>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group" style="text-align: center">
                                                <select name="status_age" id="status_age" required class="form-control" <?= Utils::isCustomer() ? 'disabled' : '' ?>>
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
                                                <label for="" class="col-form-label" style="margin-top:5px">Estado Civil:</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group" style="text-align: center">
                                                <input type="" name="" id="" style="text-align:center" class=" form-control" readonly value="<?= isset($vacante) && $vacante->id_civil_status != '' ? $vacante->id_civil_status : ''; ?>">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group" style="text-align: center">
                                                <input type="" name="civil_status_c" id="civil_status_c" style="text-align:center" class=" form-control" value="<?= $candidato->status ?>" <?= Utils::isCustomer() ? 'disabled' : '' ?> maxlength="20">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group" style="text-align: center">
                                                <select name="status_civil_status" id="status_civil_status"  class="form-control" <?= Utils::isCustomer() ? 'disabled' : '' ?> required>
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
                                                <label for="" class="col-form-label" style="margin-top:30px">Estudios:</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group" style="text-align: center">
                                                <label class="col-form-label">Requerido</label>
                                                <input type="" name="" id="" class="form-control" style="text-align:center" readonly value="<?= isset($vacante) && $vacante->level != '' ? $vacante->level : ''; ?>">
                                            </div>
                                        </div>

                                        <div class=" col-md-3">
                                            <div class="form-group" style="text-align: center">
                                                <label class="col-form-label">Candidato</label>
                                                <input type="" name="level_c" id="level_c" class="form-control" style="text-align:center" value="<?= $candidato->level ?>" <?= Utils::isCustomer() ? 'disabled' : '' ?> maxlength="50">
                                            </div>
                                        </div>
                                        <div class=" col-md-3">
                                            <div class="form-group" style="text-align: center">
                                                <label class="col-form-label">Estado</label>
                                                <select name="status_level" id="status_level" class="form-control"  <?= Utils::isCustomer() ? 'disabled' : '' ?> required>
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

                            <?php if (isset($vacante->language) && $vacante->language != '') :  ?>

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
                                                    <label for="" class="col-form-label" style="margin-top:30px">Idioma:</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group" style="text-align: center">
                                                    <label class="col-form-label">Requerido</label>
                                                    <input type="" name="" id="" class="form-control" style="text-align:center" readonly value="<?= isset($vacante) && $vacante->language != '' ? $vacante->language : ''; ?>">
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group" style="text-align: center">
                                                    <label class="col-form-label">Candidato</label>
                                                    <input type="" name="language_c" id="language_c" style="text-align:center" class="form-control" value="<?= $language->language ?>" <?= Utils::isCustomer() ? 'disabled' : '' ?> maxlength="50">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group" style="text-align: center">
                                                    <label class="col-form-label">Estado</label>
                                                    <select name="status_language" id="status_language" required class="form-control" <?= Utils::isCustomer() ? 'disabled' : '' ?>>
                                                        <option value="" selected disabled>Seleciona Estado</option>
                                                        <option value="si"> Cumple</option>
                                                        <option value="no">No cumple</option>
                                                        <option value="no aplica">No aplica</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <?php if (isset($vacante->language_level) && $vacante->language_level != '') :   ?>

                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group" style="text-align: center">
                                                        <label for="" class="col-form-label" style="margin-top:10px">Dominio:</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group" style="text-align: center">
                                                        <input type="" name="" id="" class="form-control" value="" style="text-align:center" readonly value="<?= isset($vacante) && $vacante->language_level != '' ? $vacante->language_level : ''; ?>">
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group" style="text-align: center">
                                                        <input type="" name="language_level_c" id="language_level_c" style="text-align:center" class="form-control" value="<?= $language->level ?>" <?= Utils::isCustomer() ? 'disabled' : '' ?> maxlength="50">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group" style="text-align: center">
                                                        <select name="status_language_level" id="status_language_level" required class="form-control" <?= Utils::isCustomer() ? 'disabled' : '' ?>>
                                                            <option value="" selected disabled>Seleciona Estado</option>
                                                            <option value="si"> Cumple</option>
                                                            <option value="no">No cumple</option>
                                                            <option value="no aplica">No aplica</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif  ?>

                                    </div>
                                </div>

                            <?php endif ?>

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
                                                <input type="number" name="" id="" style="text-align:center" class=" form-control" readonly value="<?= isset($vacante) && $vacante->experience_years != '' ? $vacante->experience_years : ''; ?>">
                                            </div>
                                        </div>


                                        <div class="col-md-2">
                                            <div class="form-group" style="text-align: center">
                                                <label class="col-form-label">Candidato</label>
                                                <input type="number" name="experience_years_c" id="experience_years_c" maxlength="3" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength)" style="text-align:center" class=" form-control" value="" <?= Utils::isCustomer() ? 'disabled' : '' ?>>
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group" style="text-align: center">
                                                <label class="col-form-label">Tiempo</label>
                                                <select name="tiempo" id="tiempo" class="form-control" required <?= Utils::isCustomer() ? 'disabled' : '' ?>>
                                                    <option value="" selected disabled>Seleciona</option>
                                                    <option value="meses">Meses</option>
                                                    <option value="años">Años</option>
                                                </select>
                                            </div>
                                        </div>



                                        <div class="col-md-2">
                                            <div class="form-group" style="text-align: center">
                                                <label class="col-form-label">Estado</label>
                                                <select name="status_experience_years" id="status_experience_years" required class="form-control" <?= Utils::isCustomer() ? 'disabled' : '' ?>>
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
                                                <label class="col-form-label" style="text-align: center;margin:auto">Comentarios sobre la
                                                    experiencia:</label>
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="form-group" style="text-align: center">
                                                <textarea class="form-control" name="experiencia_comments" id="experiencia_comments" cols="25" rows="3" <?= Utils::isCustomer() ? 'disabled' : '' ?>><?= $candidato->description ?> </textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group" style="text-align: center">
                                                <label for="" class="col-form-label" style="margin-top:30px">Puestos que
                                                    pudo haber ocupado:</label>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group" style="text-align: center">
                                                <label class="col-form-label">Requerido</label>
                                                <textarea class="form-control" name="" id="" rows="4" readonly> <?= isset($vacante) && $vacante->functions != '' ? $vacante->functions : ''; ?>  </textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group" style="text-align: center">
                                                <label class="col-form-label">Candidato</label>
                                                <textarea class="form-control" name="functions_c" id="functions_c" rows="4" <?= Utils::isCustomer() ? 'disabled' : '' ?>></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group" style="text-align: center">
                                                <label class="col-form-label">Estado</label>
                                                <select name="status_functions" id="status_functions" required class="form-control" <?= Utils::isCustomer() ? 'disabled' : '' ?>>
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
                                                <label class="col-form-label" style="text-align: center;margin:auto">Comentarios sobre los
                                                    puestos:</label>
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="form-group" style="text-align: center">
                                                <textarea class="form-control" name="functions_comments" id="functions_comments" cols="25" rows="3" <?= Utils::isCustomer() ? 'disabled' : '' ?>></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3" style="text-align: center;margin:auto  ">
                                            <div class="form-group " style="text-align: center; ">
                                                <label class="col-form-label" style="text-align: center;margin:auto">Comentarios generales:</label>
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="form-group" style="text-align: center">
                                                <textarea class="form-control" name="general_comments" id="general_comments" cols="25" rows="5" <?= Utils::isCustomer() ? 'disabled' : '' ?>></textarea>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        <?php endif ?>

                        <div class="card-footer">
                            <button class="btn btn-orange float-right" type="submit" name="submit" id="candidate_profile_submit">Crear</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
</div>
<script src="<?= base_url ?>app/candidate.js?v=<?= rand() ?>"></script>

<script>
    document.addEventListener("DOMContentLoaded", function(event) {

        document.querySelector("#profile-candidate-form").onsubmit = function(e) {
            e.preventDefault();
            let candidate = new Candidate();
            candidate.save_profile();
        };

    });
</script>