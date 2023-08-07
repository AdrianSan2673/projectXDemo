<div class="modal fade" id="modal-contract">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">

                <div class="modal-header">
                    <h4 class="modal-title">Crear contrato</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    <div class="form-group ">
                        <label class="col-form-label">Fecha de inicio</label>
                        <input type="date" name="contract_start" id="contract_start" class="form-control" value="" required>
                    </div>

                    <div class="form-group">
                        <label for="contract" class="col-form-label">Tipo de contratacion</label>
                        <select class="form-control" name="contract" id="selectContract" required>
                            <option disabled selected value="">Selecciona tipo de contrato</option>
                            <option value="<?= Encryption::encode(1)  ?>">Periodo de prueba</option>
                            <option value="<?= Encryption::encode(2)  ?>">Capacitación</option>
                            <option value="<?= Encryption::encode(3)  ?>" hidden>Laborales temporal</option>
                            <option value="<?= Encryption::encode(4)  ?>">Tiempo determinado</option>
                            <option value="<?= Encryption::encode(5)  ?>">Tiempo indeterminado</option>
                        </select>
                    </div>


                    <div class="row">
                        <div class="col-md-6" id="divNumber" hidden >
                            <div class="form-group">
                                <label for="" class="col-form-label">Numero</label>
                                <input type="number" name="number" id="number" class="form-control" min="0" maxlength="2">
                            </div>
                        </div>

                        <div class="col-md-6" id="divPeriodo" hidden>
                            <div class="form-group">
                                <label for="rfc" class="col-form-label">Periodo</label>
                                <select class="form-control" name="period" id="period">
                                    <option disabled selected value="">Selecciona el periodo</option>
                                    <option value="days">Dias</option>
                                    <option value="month">Meses</option>
                                    <option value="year">Años</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <input type="submit" name="submit" class="btn btn-orange" value="Guardar">
                </div>

                <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
            </form>
        </div>
    </div>
</div>


<script>
var select = document.getElementById('selectContract');
  select.addEventListener('change', function() {
    let number = document.querySelector('#number'),
      period = document.querySelector('#period')

    if (select.selectedIndex == 5) {
      document.querySelector('#divNumber').hidden = true
      document.querySelector('#divPeriodo').hidden = true
      number.required = false
      period.required = false
    } else {
      document.querySelector('#divNumber').hidden = false
      document.querySelector('#divPeriodo').hidden = false
      number.required = true
      period.required = true
    }
  });
</script>