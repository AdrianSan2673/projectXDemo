<div class="modal fade" id="modal_afectar_facturas">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header bg-danger">
                    <h4 class="">Gestión de Factura</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label for="Empresa" class="col-form-label">Empresa:</label>
                        <select name="Empresa" class="form-control" required></select>
                    </div>

                    <div class="form-group">
                        <label for="Cliente" class="col-form-label">Cliente:</label>
                        <select name="ID_Cliente" class="form-control" required></select>
                    </div>

                    <div class="form-group" hidden>
                        <label for="Razon_Social" class="col-form-label">Razón social:</label>
                        <select name="Razon_Social" class="form-control" ></select>
                    </div>

                    <div class="form-group">
                        <label for="Prefactura" class="col-form-label">Prefacturas:</label>
                        <select name="Prefactura" class="form-control" required></select>
                    </div>

                    <div class="form-group">
                        <label for="Factura" class="col-form-label">Factura:</label>
                        <input type="text" name="Factura" class="form-control" required>
                    </div>

                    <input type="hidden" name="flag" value="1">

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
    let select_empresa = document.querySelector('#modal_afectar_facturas form [name="Empresa"]')
    select_empresa.addEventListener('change', e => {
        let administracion = new Administracion();
        administracion.getClientePorEmpresa(e.target.value, '#modal_afectar_facturas',1);

        document.querySelector('#modal_afectar_facturas form [name="ID_Cliente"]').innerHTML = ''
        document.querySelector('#modal_afectar_facturas form [name="Razon_Social"]').innerHTML = ''
        document.querySelector('#modal_afectar_facturas form [name="Prefactura"]').innerHTML = ''
    });

    let select_cliente = document.querySelector('#modal_afectar_facturas form [name="ID_Cliente"]')
    select_cliente.addEventListener('change', e => {
        let administracion = new Administracion();
        administracion.getRazonPorCliente(e.target.value, '#modal_afectar_facturas');
        administracion.getPrefacturaPorCliente(e.target.value, '#modal_afectar_facturas');
    });
</script>