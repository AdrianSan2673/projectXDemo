<div class="modal fade" id="modal-agregar-subarea">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" id="agregar-subarea-form" name="formulario">
                <div class="modal-header">
                    <h5 class="modal-title">Agregar nueva Subarea</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input onPaste="return false" type="hidden" name="id_area" id="input_id_area">

                    <div class="input-group mb-3">
                        <input placeholder='Ingresa el nombre de la subarea' onPaste="return false" type="text" autocomplete="off" class="form-control" name="subarea" id="input_subarea">
                    </div>
                    <div class="modal-footer">
                        <button id="guardar" name="guardar" type="submit" class="btn btn-primary">Guardar
                        </button>
                        <button id='close' type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    var subarea = new Subarea();
    document.querySelector('#agregar-subarea-form').addEventListener('submit', e => {
        e.preventDefault();
        subarea.save_subarea();

    });

    document.getElementById("input_subarea").addEventListener("keydown", teclear);
    var flag = false;
    var teclaAnterior = "";

    function teclear(event) {
        teclaAnterior = teclaAnterior + " " + event.keyCode;
        var arregloTA = teclaAnterior.split(" ");
        if (event.keyCode == 32 && arregloTA[arregloTA.length - 2] == 32) {
            event.preventDefault();
        }
    }
</script>