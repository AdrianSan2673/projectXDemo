<div class="modal fade" id="modal_afectar_factura_gestion">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header bg-warning">
                    <h4 class="modal-title">Gestión de Factura</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label for="Empresa" class="col-form-label">Empresa:</label>
                        <select name="Empresa" class="form-control select2">
                            <option value="" selected disabled>Selecciona una empresa
                                <?php $Empresas = Utils::showEmpresas(); ?>
                                <?php foreach ($Empresas as $empresa) : ?>
                            <option value="<?= $empresa['Empresa']  ?>"><?= $empresa['Nombre_Empresa']  ?></option>
                        <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group div_todas_facturas" hidden>
                        <input type="checkbox" class="col-form-label" name="todaas_facturas">
                        <label for="todaas_facturas" class="col-form-label">Todas las Facturas</label>
                    </div>

                    <div class="form-group div_ID_Cliente">
                        <label for="Cliente" class="col-form-label">Cliente:</label>
                        <select name="ID_Cliente" class="form-control" required></select>
                    </div>


                    <div class="form-group">
                        <label for="Razon_Social" class="col-form-label">Razón social:</label>
                        <select name="Razon_Social" class="form-control" required></select>
                    </div>

                    <div class="form-group ">
                        <label class="col-form-label">Facturas</label>
                        <select name="facturas[]" multiple="multiple" class="form-control select2bs4" required></select>
                    </div>

                    <div class="form-group">
                        <label for="Estado" class="col-form-label">Estado:</label>
                        <select name="Estado" class="form-control" required>
                            <option value="Pendiente de pago">Pendiente de pago</option>
                            <option value="Pagada">Pagada</option>
                            <option value="Cancelada">Cancelada</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="Promesa_Pago" class="col-form-label">Fecha de promesa de pago:</label>
                        <input name="Promesa_Pago" type="date" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="Contacto_Con" class="col-form-label">Persona con la que se contactó:</label>
                        <input type="text" name="Contacto_Con" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="Comentarios" class="col-form-label">Comentarios:</label>
                        <textarea name="Comentarios" class="form-control" rows="10"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="Proxima_Gestion" class="col-form-label">Fecha de próxima gestión:</label>
                        <input name="Proxima_Gestion" type="date" class="form-control" required>
                    </div>

                    <input type="hidden" name="flag" value="3">

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
    //============================[Ulises Febrero 22]=========================================
    $('#modal_afectar_factura_gestion form [name="Empresa"]').on('select2:select', function(e) {
        document.querySelector('#modal_afectar_factura_gestion form .div_todas_facturas').hidden = false
        document.querySelector('#modal_afectar_factura_gestion form [name="todaas_facturas"]').checked = false
        document.querySelector('#modal_afectar_factura_gestion form [name="ID_Cliente"]').innerHTML = ''
        document.querySelector('#modal_afectar_factura_gestion form [name="Razon_Social"]').innerHTML = ''
        $('#modal_afectar_factura_gestion form [name="facturas[]"]').empty();
        document.querySelector('#modal_afectar_factura_gestion form [name="Estado"]').value = 'Pendiente de pago'
        document.querySelector('#modal_afectar_factura_gestion form [name="Promesa_Pago"]').value = ''
        document.querySelector('#modal_afectar_factura_gestion form [name="Contacto_Con"]').value = ''
        document.querySelector('#modal_afectar_factura_gestion form [name="Comentarios"]').value = ''
        document.querySelector('#modal_afectar_factura_gestion form [name="Proxima_Gestion"]').value = ''

        var data = e.params.data;
        let administracion = new Administracion();
        administracion.getClientePorEmpresa(data.id, '#modal_afectar_factura_gestion', 3);
    });


    let select_cliente_gestion = document.querySelector('#modal_afectar_factura_gestion form [name="ID_Cliente"]')
    select_cliente_gestion.addEventListener('change', e => {
        let administracion = new Administracion();
        administracion.getFacturasRazonPorCliente(e.target.value, '#modal_afectar_factura_gestion');
    });


    document.querySelector('#modal_afectar_factura_gestion').addEventListener('submit', e => {
        let administracion = new Administracion();
        administracion.updateProximaGestionFacturas();
        e.preventDefault();
    })

    //==========================================================================================

    let todaas_facturas_gestion = document.querySelector('#modal_afectar_factura_gestion form [name="todaas_facturas"]')
    todaas_facturas_gestion.addEventListener('change', function() {
        if (todaas_facturas_gestion.checked) {
            console.log('hola');
            document.querySelector('#modal_afectar_factura_gestion form [name="ID_Cliente"]').value = ''
            document.querySelector('#modal_afectar_factura_gestion form [name="ID_Cliente"]').required = false
            document.querySelector('#modal_afectar_factura_gestion form [name="Razon_Social"]').innerHTML = ''
            document.querySelector('#modal_afectar_factura_gestion form .div_ID_Cliente').hidden = true
            $('#modal_afectar_factura_gestion form [name="facturas[]"]').empty();

            let administracion = new Administracion();
            administracion.getFacturaPendienteEmpresaPorEstatus('#modal_afectar_factura_gestion')
        } else {
            document.querySelector('#modal_afectar_factura_gestion form .div_ID_Cliente').hidden = false
            document.querySelector('#modal_afectar_factura_gestion form [name="ID_Cliente"]').required = true
            $('#modal_afectar_factura_gestion form [name="facturas[]"]').empty();
        }
    })
</script>