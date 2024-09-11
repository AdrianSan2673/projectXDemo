<div class="modal fade" id="modal_create">
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
                        <label class="col-form-label" for="department">Nombre del Departamento</label>
                        <input type="text" class="form-control" name="department" id="department" maxlength="100" required>
                    </div>
                    <!-- ===[gabo 6 junio departamento]=== -->


                   
                    <!-- ===[gabo 6 junio departamento fin]=== -->
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
window.onload = function() {
    document.querySelector('#btn_new_department').addEventListener('click', e => {
        e.preventDefault();
        document.querySelector('#modal_create form').reset();
        $('#modal_create').modal({
            backdrop: 'static',
            keyboard: false
        });
    })

    document.querySelector('#modal_create form').onsubmit = function(e) {
        e.preventDefault();
        let departamento = new Department();
            departamento.save();

        }
    }


</script>