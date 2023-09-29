<div class="modal fade" id="modal-agregar-area">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" id="agregar-area-form" name="formulario">
                <div class="modal-header">
                    <h5 class="modal-title">Agregar nueva Area</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <input placeholder='Ingresa el nombre del Area' type="text" onPaste="return false" class="form-control" name="area" id="area_input" autocomplete="off" required>
                    </div>
                    <div class="input-group mb-3">
                        <input placeholder='Ingresa una subarea (Opcional)' onPaste="return false" type="text" autocomplete="off" class="form-control" name="subarea" id="subarea_input">
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
   
    var area = new Area();

    document.querySelector('#modal-agregar-area').addEventListener('submit', e => {
        e.preventDefault();
        area.save();

    });

    document.getElementById("area_input").addEventListener("keydown", teclear);
    document.getElementById("subarea_input").addEventListener("keydown", teclear);
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