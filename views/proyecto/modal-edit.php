<div class="modal fade" id="modal_edit_department">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Editar departamento</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="flag" id="flag" value="1">
                    <input type="hidden" name="id" value="<?=Encryption::encode($departamento->id) ?>">
                    <div class="form-group">
                        <label class="col-form-label" for="department">Nombre del Departamento</label>
                        <input type="text" class="form-control" name="department" id="department" maxlength="100" value="<?= $departamento->department ?>" required>
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

<script type="text/javascript">
    
    

    


</script>