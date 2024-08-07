<style>
    .emoji-radio {
        display: inline-block;
    }

    .emoji-radio input[type="radio"] {
        display: none;
    }

    .emoji-radio label {
        font-size: 80px;
        cursor: pointer;
        padding: 70px;
    }

    .emoji-radio input[type="radio"]:checked+label {
        background-color: #ffeeba;
    }
</style>
<div class="modal fade" id="modal_encuesta">
    <div class="modal-dialog modal-lg" style="max-width: 800px;">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Encuesta de Satisfacción</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="ID_Empresa" value="<?= isset($_SESSION['Encuesta']) ? $_SESSION['Encuesta']->ID_Empresa : NULL ?>">
                    <input type="hidden" name="ID_Cliente" value="<?= isset($_SESSION['Encuesta']) ? $_SESSION['Encuesta']->ID_Cliente : NULL ?>">
                    <input type="hidden" name="ID_Cliente_Reclu" value="<?= isset($_SESSION['Encuesta']) ? $_SESSION['Encuesta']->ID_Cliente_Reclu : NULL ?>">
                    <input type="hidden" name="Usuario" value="<?= isset($_SESSION['Encuesta']) ? $_SESSION['Encuesta']->Usuario : NULL ?>">
                    <div class="form-group text-center">
                        <label class="col-form-label" style="font-size: 0.8rem;">¿Cómo te has sentido con nuestro servicio?</label>
                        <br>
                        <div class="emoji-radio">
                            <input type="radio" id="Experiencia1" name="Experiencia" value="1" required>
                            <label for="Experiencia1">&#128542;</label>

                            <input type="radio" id="Experiencia2" name="Experiencia" value="2">
                            <label for="Experiencia2">&#128528;</label>

                            <input type="radio" id="Experiencia3" name="Experiencia" value="3">
                            <label for="Experiencia3">&#129321;</label>
                        </div>
                    </div>
                    <!--<div class="form-group">
                        <label class="col-form-label" style="font-size: 0.8rem;">¿Qué tan agradable es tu experiencia con nosotros?</label>
                        <div class="cc-selector-2">
                            <input id="experiencia1" type="radio" name="Experiencia" value="1" required />
                            <label class="drinkcard-cc tdesacuerdo" for="experiencia1"></label>
                            <input id="experiencia2" type="radio" name="Experiencia" value="2" />
                            <label class="drinkcard-cc ldesacuerdo"for="experiencia2"></label>
                            <input id="experiencia3" type="radio" name="Experiencia" value="3" />
                            <label class="drinkcard-cc neutral" for="experiencia3"></label>
                            <input id="experiencia4" type="radio" name="Experiencia" value="4" />
                            <label class="drinkcard-cc lacuerdo" for="experiencia4"></label>
                            <input id="experiencia5" type="radio" name="Experiencia" value="5" />
                            <label class="drinkcard-cc tacuerdo" for="experiencia5"></label>  
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" style="font-size: 0.8rem;">¿Nuestro servicio te ayuda a lograr tus objetivos de Recursos Humanos?</label>
                        <div class="cc-selector-2">
                            <input id="objetivos1" type="radio" name="Objetivos" value="1" required />
                            <label class="drinkcard-cc tdesacuerdo" for="objetivos1"></label>
                            <input id="objetivos2" type="radio" name="Objetivos" value="2" />
                            <label class="drinkcard-cc ldesacuerdo"for="objetivos2"></label>
                            <input id="objetivos3" type="radio" name="Objetivos" value="3" />
                            <label class="drinkcard-cc neutral" for="objetivos3"></label>
                            <input id="objetivos4" type="radio" name="Objetivos" value="4" />
                            <label class="drinkcard-cc lacuerdo" for="objetivos4"></label>
                            <input id="objetivos5" type="radio" name="Objetivos" value="5" />
                            <label class="drinkcard-cc tacuerdo" for="objetivos5"></label>  
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" style="font-size: 0.8rem;">¿Todo nuestro personal te asesora y atiende de manera profesional?</label>
                        <div class="cc-selector-2">
                            <input id="asesoria1" type="radio" name="Asesoria" value="1" required />
                            <label class="drinkcard-cc tdesacuerdo" for="asesoria1"></label>
                            <input id="asesoria2" type="radio" name="Asesoria" value="2" />
                            <label class="drinkcard-cc ldesacuerdo"for="asesoria2"></label>
                            <input id="asesoria3" type="radio" name="Asesoria" value="3" />
                            <label class="drinkcard-cc neutral" for="asesoria3"></label>
                            <input id="asesoria4" type="radio" name="Asesoria" value="4" />
                            <label class="drinkcard-cc lacuerdo" for="asesoria4"></label>
                            <input id="asesoria5" type="radio" name="Asesoria" value="5" />
                            <label class="drinkcard-cc tacuerdo" for="asesoria5"></label>  
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" style="font-size: 0.8rem;">Cuando tienes alguna inconformidad u observación, ¿la atendemos de forma rápida y resolutiva?</label>
                        <div class="cc-selector-2">
                            <input id="resolucion1" type="radio" name="Resolucion" value="1" required />
                            <label class="drinkcard-cc tdesacuerdo" for="resolucion1"></label>
                            <input id="resolucion2" type="radio" name="Resolucion" value="2" />
                            <label class="drinkcard-cc ldesacuerdo"for="resolucion2"></label>
                            <input id="resolucion3" type="radio" name="Resolucion" value="3" />
                            <label class="drinkcard-cc neutral" for="resolucion3"></label>
                            <input id="resolucion4" type="radio" name="Resolucion" value="4" />
                            <label class="drinkcard-cc lacuerdo" for="resolucion4"></label>
                            <input id="resolucion5" type="radio" name="Resolucion" value="5" />
                            <label class="drinkcard-cc tacuerdo" for="resolucion5"></label>  
                        </div>
                    </div> -->
                    <div class="form-group text-center">
                        <label class="col-form-label" style="font-size: 0.8rem;">Escríbenos tus comentarios</label>
                        <!-- <label class="col-form-label" style="font-size: 0.8rem;">¿Qué nos sugieres mejorar de nuestro servicio en general?</label> -->
                        <textarea class="form-control" name="Comentarios" rows="5"></textarea>
                    </div>
					<div class="form-group text-center">
                        <label class="col-form-label" style="font-size: 0.8rem;">¿Tiene alguna duda o sugerencia sobre nuestra plataforma?</label>
                        <textarea class="form-control" name="Plataforma_Comentarios" rows="5"></textarea>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <input type="submit" name="submit" class="btn btn-orange" value="Guardar">
                </div>
            </form>
        </div>
    </div>
</div>
<?php if ($_GET['controller'] != 'ServicioApoyo' && $_GET['action'] != 'crear') : ?>
    <script type="text/javascript" src="<?= base_url ?>app/cliente.js?v=<?= rand() ?>"></script>
<?php endif ?>
<?php if (isset($_SESSION['Encuesta']) && $_SESSION['Encuesta']->status == 1) : ?>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', e => {
            $('#modal_encuesta').modal({
                backdrop: 'static',
                keyboard: false
            });
            document.querySelector('#modal_encuesta form').onsubmit = function(e) {
                e.preventDefault();
                let cliente = new Cliente();
                cliente.save_encuesta();
            }
        })
    </script>
    <?php $_SESSION['Encuesta']->status = 0 ?>
<?php endif ?>