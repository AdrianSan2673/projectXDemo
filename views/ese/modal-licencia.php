<div class="modal fade" id="modal_licencia">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Licencia Federal</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="Folio">
                    <input type="hidden" name="flag">
                    <div class="form-group">
                        <label class="col-form-label" for="Tipo_Licencia">Tipo de Licencia</label>
                        <select name="Tipo_Licencia" class="form-control">
                            <option value="1">Federal</option>
                            <option value="2">Estatal</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="Numero_Licencia">Número de Licencia</label>
                        <input type="text" class="form-control" name="Numero_Licencia" maxlength="40" required>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="checkbox" name="CategoriaA" class="form-check-input" value="1">
                        <label class="form-check-label" for="CategoriaA">Categoría A</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="checkbox" name="CategoriaB" class="form-check-input" value="1">
                        <label class="form-check-label" for="CategoriaB">Categoría B</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="checkbox" name="CategoriaC" class="form-check-input" value="1">
                        <label class="form-check-label" for="CategoriaC">Categoría C</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="checkbox" name="CategoriaD" class="form-check-input" value="1">
                        <label class="form-check-label" for="CategoriaD">Categoría D</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="checkbox" name="CategoriaE" class="form-check-input" value="1">
                        <label class="form-check-label" for="CategoriaE">Categoría E</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="checkbox" name="CategoriaF" class="form-check-input" value="1">
                        <label class="form-check-label" for="CategoriaF">Categoría F</label>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="Licencia_Vigente_Del">Vigente del</label>
                        <input type="text" class="form-control" name="Licencia_Vigente_Del" placeholder="dd/mm/yyyy" pattern="(0[1-9]|1[0-9]|2[0-9]|3[01])/(0[1-9]|1[012])/[0-9]{4}">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="Licencia_Vigente_Hasta">Hasta</label>
                        <input type="text" class="form-control" name="Licencia_Vigente_Hasta" placeholder="dd/mm/yyyy" pattern="(0[1-9]|1[0-9]|2[0-9]|3[01])/(0[1-9]|1[012])/[0-9]{4}">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="Estatus">Estatus</label>
                        <input type="text" name="Estatus" class="form-control" maxlength="100">
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
    var Tipo_Licencia = document.querySelectorAll('#modal_licencia select')[0];
    Tipo_Licencia.addEventListener('change', e => {
        if (Tipo_Licencia.value == 1) {
            document.querySelectorAll('#modal_licencia .form-group')[2].style.display = 'block';
            document.querySelectorAll('#modal_licencia .form-group')[4].style.display = 'none';
            document.querySelectorAll('#modal_licencia .form-group')[3].querySelector('label').textContent = 'Hasta';
        }else {
            document.querySelectorAll('#modal_licencia .form-group')[2].style.display = 'none';
            document.querySelectorAll('#modal_licencia .form-group')[4].style.display = 'block';
            document.querySelectorAll('#modal_licencia .form-group')[3].querySelector('label').textContent = 'Vencimiento';
        }
    })
</script>