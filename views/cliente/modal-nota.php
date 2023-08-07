<div class="modal fade" id="modal_nota">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Escribe una nota acerca de este cliente</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-form-label" for="Comentarios">Comentarios</label>
                        <textarea name="Comentarios" rows="10" class="form-control"></textarea>
                    </div>
                    <input type="hidden" name="ID_Cliente" value="<?=$_GET['controller'] == 'cliente_SA' ? $_GET['id'] : 0?>">
                    <input type="hidden" name="ID_Cliente_Reclu" value="<?=$_GET['controller'] == 'cliente' ? $_GET['id'] : 0?>">
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <input type="submit" name="submit" class="btn btn-orange" value="Guardar">
                </div>
            </form>
        </div>
    </div>              
</div>