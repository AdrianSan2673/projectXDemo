    <div class="modal fade" id="modal_ral">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="update-ral-form">
                <div class="modal-header">
                    <h4 class="modal-title">Registro de Antecedentes Legales</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="Folio" name="Folio">
                    <input type="hidden" name="ral_flag" id="ral_flag">
                    <input type="hidden" name="Nombre">
                    <div class="form-group">
                        <label class="col-form-label" for="Demandas">Demandas</label>
                        <select name="Demandas" id="Demandas" class="form-control">
                          <option disabled selected="selected">Sin asignar</option>
                          <option value="1">Sin demandas</option>
                          <option value="2">Con demandas</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="Estado_RAL">Estado o Nacional</label>
                        <input type="text" class="form-control" name="Estado_RAL" id="Estado_RAL" maxlength="60">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="Total_Demandas">Total de Demandas</label>
                        <input type="number" class="form-control" name="Total_Demandas" id="Total_Demandas" min="0">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="Total_Acuerdos">Total de Acuerdos</label>
                        <input type="number" class="form-control" name="Total_Acuerdos" id="Total_Acuerdos" min="0">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="Tipo_Juicio">Tipo de Juicio</label>
                        <input type="text" class="form-control" name="Tipo_Juicio" id="Tipo_Juicio" maxlength="100">
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <input type="submit" class="btn btn-orange" value="Guardar">
                </div>
            </form>
        </div>
    </div>              
</div>
<script type="text/javascript">
    let ral_form = document.querySelector('#update-ral-form')
    ral_form.querySelector('select').addEventListener('change', () => {
        display_ral();
    })
    ral_form.querySelector('select').addEventListener('DOMContentLoaded', () => {display_ral();})
    const display_ral = () => {
        if (ral_form.querySelector('select').value == 2) {
            ral_form.querySelectorAll('.form-group')[2].style.display = "block";
            ral_form.querySelectorAll('.form-group')[3].style.display = "block";
            ral_form.querySelectorAll('.form-group')[4].style.display = "block";
        }else{
            ral_form.querySelectorAll('.form-group')[2].style.display = "none";
            ral_form.querySelectorAll('.form-group')[3].style.display = "none";
            ral_form.querySelectorAll('.form-group')[4].style.display = "none";
        }
    }
</script>
<div class="modal fade" id="modal_buscar_ral">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Buscar RAL</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="Nombres">
                    <input type="hidden" name="Apellidos">
                    <input type="hidden" name="CURP">
                    <input type="hidden" name="Candidato">
                    <p></p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <input type="submit" name="submit" class="btn btn-success" value="Buscar">
                </div>
            </form>
        </div>
    </div>              
</div>
<div class="modal fade" id="modal_comentarios_ral">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Escribe tus comentarios</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="Folio">
                    <input type="hidden" name="flag">
                    <div class="form-group">
                        <label class="col-form-label" for="Comentarios">Comentarios</label>
                        <textarea name="Comentarios" rows="20" class="form-control" ></textarea>
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