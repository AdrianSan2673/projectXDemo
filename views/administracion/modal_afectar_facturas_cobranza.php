<div class="modal fade" id="modal_afectar_facturas">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header bg-danger">
                    <h4 class="modal-title">Grupo de facturas</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="Empresa" class="col-form-label">Empresa:</label>
                        <select name="Empresa" class="form-control select2">
                            <option value="" selected disabled>Selecciona una empresa</option>
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

                    <div class="form-group">
                        <label for="Estado" class="col-form-label">Estado:</label>
                        <select name="Estado" class="form-control" required>
                            <option value="Pendiente de pago">Pendiente de pago</option>
                            <option value="Pagada">Pagada</option>
                            <option value="Cancelada">Cancelada</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="Fecha_de_Pago" class="col-form-label">Fecha de pago:</label>
                        <input name="Fecha_de_Pago" type="date" class="form-control" required>
                    </div>


                    <div class="form-group ">
                        <label class="col-form-label">Facturas</label>
                        <select name="facturas[]" multiple="multiple" class="form-control select2bs4" required></select>
                    </div>

                    <div class="form-group">
                        <label class="col-form-label">Suma del monto:</label>
                        <input type="text" class="form-control" name="monto" value="0" disabled>
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
    //============================[Ulises Febrero 17]=========================================
    let form_afectar_facturas=document.querySelector('#modal_afectar_facturas form')

    $('#modal_afectar_facturas form [name="Empresa"]').on('select2:select', function(e) {
        form_afectar_facturas.querySelector('.div_todas_facturas').hidden=false
        form_afectar_facturas.querySelector('[name="todaas_facturas"]').checked=false

        form_afectar_facturas.querySelector('[name="ID_Cliente"]').innerHTML = ''
        form_afectar_facturas.querySelector('[name="Razon_Social"]').innerHTML = ''
        form_afectar_facturas.querySelector('[name="Estado"]').value = 'Pendiente de pago'
        form_afectar_facturas.querySelector('[name="Fecha_de_Pago"]').value = ''
        $('[name="facturas[]"]').empty();
        form_afectar_facturas.querySelector('[name="monto"]').value = '0'

        var data = e.params.data;
        let administracion = new Administracion();
        administracion.getClientePorEmpresa(data.id, '#modal_afectar_facturas', 3);
    });

    let select_cliente = form_afectar_facturas.querySelector('[name="ID_Cliente"]')
    select_cliente.addEventListener('change', e => {
        let administracion = new Administracion();
        administracion.getFacturasRazonPorCliente(e.target.value, '#modal_afectar_facturas');
    });

    $('#modal_afectar_facturas [name="facturas[]"]').on("select2:select", function(e) {
        let aux = 0
        let arrayFactura
        $("#modal_afectar_facturas [name='facturas[]'] option:selected").each(function() {
            arrayFactura = $(this).text().split('$')
            arrayFactura = arrayFactura[1].replace(/,/g, '')
            arrayFactura = parseFloat(arrayFactura);
            aux += arrayFactura
        });
        form_afectar_facturas.querySelectorAll('input')[2].value = aux
    });

    $("#modal_afectar_facturas [name='facturas[]']").on("select2:unselect", function(e) {
        let aux = 0
        let arrayFactura
        $("#modal_afectar_facturas [name='facturas[]'] option:selected").each(function() {
            arrayFactura = $(this).text().split('$')
            arrayFactura = arrayFactura[1].replace(/,/g, '')
            arrayFactura = parseFloat(arrayFactura);
            aux += arrayFactura
        });
        form_afectar_facturas.querySelectorAll('input')[2].value = aux
    });

    document.querySelector('#modal_afectar_facturas').addEventListener('submit', e => {
        let administracion = new Administracion();
        administracion.updateEstadoFacturas();
        e.preventDefault();
    })
    //==========================================================================================

    //==========================================================================================

    let todaas_facturas = form_afectar_facturas.querySelector('[name="todaas_facturas"]')
    todaas_facturas.addEventListener('change', function() {
        if (todaas_facturas.checked) {
            form_afectar_facturas.querySelector('[name="ID_Cliente"]').value = ''
            form_afectar_facturas.querySelector('[name="ID_Cliente"]').required = false

            form_afectar_facturas.querySelector('[name="Razon_Social"]').innerHTML = ''
            form_afectar_facturas.querySelector('.div_ID_Cliente').hidden = true
            $('[name="facturas[]"]').empty();

            let administracion = new Administracion();
            administracion.getFacturaPendienteEmpresaPorEstatus('#modal_afectar_facturas')
        } else {
            form_afectar_facturas.querySelector('.div_ID_Cliente').hidden = false
            form_afectar_facturas.querySelector('[name="ID_Cliente"]').required=true
            $('[name="facturas[]"]').empty();

        }
    })
</script>