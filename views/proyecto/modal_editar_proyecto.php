
<div class="modal fade" id="modal_editar_proyecto">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Departamento</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="flag" id="flag" value="1">
                    <input type="hidden" name="id" value="0">
                    <input type="hidden" name="id_cliente_create" value="<?= $_SESSION['id_cliente'] ?>">
                    <div class="form-group">
                        <label class="col-form-label" for="department">Direccion</label>
                        <input type="text" class="form-control" name="direccion" id="department" maxlength="100" value = <?= $proyecto->direccion ?> required>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="department">Fase</label>
                        <input type="text" class="form-control" name="fase" id="department" maxlength="100" value = <?= $proyecto->status ?> required>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="department">Telefono</label>
                        <input type="text" class="form-control" name="Telefono" id="department" maxlength="100" value = <?= $proyecto->Telefono ?> required>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="department">Area Encargada</label>
                        <input type="text" class="form-control" name="id_tipo_usuario" id="department" maxlength="100" value = <?= $proyecto->id_tipo_usuario ?> required>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <input type="submit" name="submit" class="btn btn-primary" value="Guardar" id="btn_update_project">
                </div>
            </form>
        </div>
    </div>
</div>



<!-- 
    document.querySelector('#modal_editar_proyecto form').onsubmit = function(e) {
        e.preventDefault();
        
        let proyecto = new Proyecto();
        proyecto.id = document.querySelector('#project_id').value;
        proyecto.direccion = document.querySelector('#direccion').value;
        proyecto.status = document.querySelector('#fase').value;
        proyecto.Telefono = document.querySelector('#Telefono').value;
        proyecto.id_tipo_usuario = document.querySelector('#id_tipo_usuario').value;
        
        if (proyecto.update()) {
            alert('Proyecto actualizado con éxito');
            location.reload(); // Recargar la página o actualizar la tabla de proyectos
        } else {
            alert('Error al actualizar el proyecto');
        }
    }
-->