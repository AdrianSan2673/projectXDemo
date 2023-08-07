<div class="modal fade" id="modal_afectar_Prefacturas">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header bg-info">
                    <h4 class="">Gestión Prefactura</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label for="Empresa" class="col-form-label">Empresa:</label>
                        <select name="Empresa" class="form-control  select2" required></select>
                    </div>

                    <div class="form-group">
                        <label for="Cliente" class="col-form-label">Cliente:</label>
                        <select name="ID_Cliente" class="form-control" required></select>
                    </div>

                    <div class="form-group" hidden>
                        <label for="Razon_Social" class="col-form-label">Razón social:</label>
                        <select name="Razon_Social" class="form-control"></select>
                    </div>

                    <div class="form-group ">
                        <label class="col-form-label">Candidatos</label>
                        <select name="Candidatos[]" multiple="multiple" class="form-control select2bs4" required></select>
                    </div>

                    <div class="form-group">
                        <label for="Prefactura" class="col-form-label">Prefactura:</label>
                        <input type="text" name="Prefactura" class="form-control" required>
                    </div>

                    <input type="hidden" name="flag" value="2">

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <input type="submit" name="submit" class="btn btn-orange" value="Guardar">
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $('#modal_afectar_Prefacturas form [name="Empresa"]').on('select2:select', function(e) {
        var data = e.params.data;

        let administracion = new Administracion();
        administracion.getClientePorEmpresa(data.id, '#modal_afectar_Prefacturas', 2);

        document.querySelector('#modal_afectar_Prefacturas form [name="ID_Cliente"]').innerHTML = ''
        $("#modal_afectar_Prefacturas form [name='Candidatos[]']").val(null).trigger('change');
        document.querySelector('#modal_afectar_Prefacturas form [name="Prefactura"]').innerHTML = ''
    });

    let select_cliente_prefactura = document.querySelector('#modal_afectar_Prefacturas form [name="ID_Cliente"]')
    select_cliente_prefactura.addEventListener('change', e => {
        $("#modal_afectar_Prefacturas form [name='Candidatos[]']").val(null).trigger('change');

        let administracion = new Administracion();
        administracion.getRazonPorCliente(e.target.value, '#modal_afectar_Prefacturas');
        administracion.getCandidatosSinPrefacturaPorCliente(e.target.value, '#modal_afectar_Prefacturas');


    });
</script>